<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;
use RuntimeException;
use Throwable;

class ImportSqliteToMysql extends Command
{
    protected $signature = 'automobilli:import-sqlite
        {--source= : Path to the existing SQLite database (defaults to database/database.sqlite)}
        {--dry-run : Inspect the databases and show row counts without writing data}';

    protected $description = 'Safely copy Automobilli catalog and account data from SQLite into a freshly migrated, empty MySQL database.';

    private const TABLES = [
        'users',
        'brands',
        'car_categories',
        'memberships',
        'cars',
        'user_memberships',
        'favorites',
        'wishlists',
    ];

    public function handle(): int
    {
        if (DB::getDefaultConnection() !== 'mysql' || DB::connection('mysql')->getDatabaseName() !== 'automobilli') {
            $this->error('Safety check failed: the default connection must be mysql and DB_DATABASE must be automobilli.');
            return self::FAILURE;
        }

        $source = $this->option('source') ?: database_path('database.sqlite');
        $realPath = realpath($source);

        if (! $realPath || ! is_file($realPath) || ! is_readable($realPath)) {
            $this->error("SQLite database not found or unreadable: {$source}");
            return self::FAILURE;
        }

        try {
            $sqlite = new PDO('sqlite:' . $realPath, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $sqlite->exec('PRAGMA query_only = ON');

            $counts = [];
            foreach (self::TABLES as $table) {
                $sourceExists = (bool) $sqlite->query(
                    "SELECT name FROM sqlite_master WHERE type = 'table' AND name = " . $sqlite->quote($table)
                )->fetchColumn();
                if (! $sourceExists || ! Schema::connection('mysql')->hasTable($table)) {
                    throw new RuntimeException("Table {$table} is missing from SQLite or MySQL. Run Laravel migrations first.");
                }

                $counts[$table] = (int) $sqlite->query('SELECT COUNT(*) FROM "' . $table . '"')->fetchColumn();
                if (DB::connection('mysql')->table($table)->count() !== 0) {
                    throw new RuntimeException("MySQL table {$table} is not empty. Import aborted to prevent overwrites or duplicates.");
                }
            }

            $this->table(['Table', 'Rows in SQLite'], collect($counts)
                ->map(fn (int $count, string $table) => [$table, $count])->values()->all());

            if ($this->option('dry-run')) {
                $this->info('Dry run complete. No MySQL rows were inserted.');
                return self::SUCCESS;
            }

            if (! $this->confirm('Copy these rows to empty MySQL automobilli tables?', false)) {
                $this->warn('Import cancelled; no data changed.');
                return self::SUCCESS;
            }

            DB::connection('mysql')->transaction(function () use ($sqlite, $counts) {
                foreach (self::TABLES as $table) {
                    if ($counts[$table] === 0) {
                        continue;
                    }

                    $targetColumns = Schema::connection('mysql')->getColumnListing($table);
                    $sourceColumns = $sqlite->query('PRAGMA table_info("' . $table . '")')
                        ->fetchAll(PDO::FETCH_ASSOC);
                    $sourceNames = array_column($sourceColumns, 'name');
                    $missing = array_diff($sourceNames, $targetColumns);
                    if ($missing) {
                        throw new RuntimeException("Unmapped SQLite columns in {$table}: " . implode(', ', $missing));
                    }

                    $rows = $sqlite->query('SELECT * FROM "' . $table . '" ORDER BY rowid')
                        ->fetchAll(PDO::FETCH_ASSOC);

                    foreach (array_chunk($rows, 50) as $chunk) {
                        DB::connection('mysql')->table($table)->insert($chunk);
                    }

                    $copied = DB::connection('mysql')->table($table)->count();
                    if ($copied !== $counts[$table]) {
                        throw new RuntimeException("Row count mismatch for {$table}: expected {$counts[$table]}, got {$copied}.");
                    }

                    $this->line("Copied {$table}: {$copied} rows");
                }
            });

            $this->info('Import complete. Existing IDs, password hashes, and JSON strings were retained.');
            $this->warn('Verify the user accounts, car details, favorites and wishlists in the browser before retiring SQLite.');
            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Import failed: ' . $e->getMessage());
            $this->warn('No existing SQLite data was modified. If a MySQL transaction failed, inserted rows were rolled back.');
            return self::FAILURE;
        }
    }
}
