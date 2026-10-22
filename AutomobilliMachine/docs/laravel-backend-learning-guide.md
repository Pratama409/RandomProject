# AutomobilliMachine — Laravel Backend Learning Guide

This guide explains the backend flow implemented for the car catalog. It is written as a learning aid: understand the request flow first, then trace one CRUD operation from route to database.

## Current project foundation

The project declares PHP `^8.3` and Laravel `^13.0` in `composer.json`.

Existing backend building blocks include:

- **Models / PHP OOP:** `User`, `Brand`, `Car`, `Category`, `Membership`, and `UserMembership`.
- **Migrations:** versioned schema definitions for users, brands, car categories, cars, memberships, favorites, wishlists, and related metadata.
- **Authentication:** login, register, logout, session regeneration, password hashing, and routes protected by Laravel's built-in `auth` middleware.
- **Eloquent relationships:** brands have many cars; cars belong to brands and categories; users can favorite and wishlist many cars; users have memberships.
- **Tests:** feature tests already cover catalog browsing, car details, search, authentication redirects, and favorites/wishlists.

The new admin-car CRUD adds a resource-management example that builds on this existing foundation rather than duplicating the database schema.

## Request flow for admin car CRUD

A browser request follows this path:

1. **Route** — `routes/web.php` matches the URL and HTTP method.
2. **Authentication middleware** — `auth` redirects guests to the login page.
3. **Admin middleware** — `admin` checks that the authenticated user's `role` is `admin`; ordinary users receive HTTP 403.
4. **Form Request** — `SaveCarRequest` authorizes the operation and validates user input before the controller receives it.
5. **Controller** — `App\\Http\\Controllers\\Admin\\CarController` coordinates the operation.
6. **Eloquent Model** — `Car::create()`, `$car->update()`, query builders, and `$car->delete()` read or write the database.
7. **Response** — the controller redirects back to the catalog with a success message; Blade views render the form or list.

This separation keeps access control, validation, database logic, and HTML from being mixed into one file.

## CRUD route and method mapping

| Method | Route | Controller method | Purpose |
|---|---|---|---|
| GET | `/admin/cars` | `index()` | Search, eager-load relationships, and paginate cars |
| GET | `/admin/cars/create` | `create()` | Load brands/categories for the create form |
| POST | `/admin/cars` | `store()` | Validate and insert a car using Eloquent |
| GET | `/admin/cars/{car}/edit` | `edit()` | Load the car for editing |
| PUT | `/admin/cars/{car}` | `update()` | Validate and update the existing Eloquent model |
| DELETE | `/admin/cars/{car}` | `destroy()` | Delete the selected catalog record |

The resource routes intentionally omit `show`: public car details already use the existing `cars.show` route.

## Important code concepts

### PHP OOP

- A **class** groups related properties and methods. `CarController` is a class responsible for catalog operations.
- A **method** such as `store()` represents one operation.
- **Dependency / type declarations** such as `store(SaveCarRequest $request)` tell Laravel which request object should be injected.
- **Encapsulation / responsibility separation** keeps validation in the Form Request and database coordination in the controller.

### Migration vs. Eloquent

A migration defines the database schema; it does not handle each web form submission. The `cars` table and its fields already exist, so this CRUD feature does not add a duplicate migration.

- Schema change: create or edit a migration, then run `php artisan migrate`.
- New car: `Car::create($request->validated())`.
- Edit car: `$car->update($request->validated())`.
- Read cars: `Car::query()->with(['brand', 'category'])->paginate(15)`.
- Delete car: `$car->delete()`.

The `with(['brand', 'category'])` call eager-loads Eloquent relationships so the table can display brand/category names without issuing an individual query for every row.

### Relationship examples

- `Brand::cars()` is a one-to-many `hasMany` relationship.
- `Car::brand()` and `Car::category()` are `belongsTo` relationships.
- `User::favoriteCars()` and `User::wishlistCars()` are many-to-many relationships using the `favorites` and `wishlists` pivot tables.
- A relationship query like `$brand->cars()` is different from `$brand->cars`: the first is a query builder you can filter, while the second retrieves the related collection.

### Validation and mass assignment

`SaveCarRequest` whitelists permitted fields. The controller uses only `validated()` data, and the `Car` model defines its `$fillable` attributes. That reduces the risk of assigning arbitrary request values to the model.

The slug is unique **within the selected brand**, matching the database unique key `(brand_id, slug)`. The form also validates foreign keys for brand and category.

### Middleware and roles

`auth` answers: “Is the visitor logged in?”

`admin` answers: “Does this logged-in visitor have the administrator role?”

Both checks are server-side. Hiding an Admin link in HTML would not be a security control by itself.

## Run locally

1. Pull the feature branch and install dependencies if needed.
2. Confirm the local `.env` points to your development database.
3. Run `php artisan migrate:status` to inspect migration state. Run `php artisan migrate` only if there are pending migrations.
4. Start the app with `php artisan serve`, then open `/admin/cars`.
5. Run the focused feature tests: `php artisan test --filter=AdminCarCrudTest`.
6. Run the full suite: `php artisan test`.

Do not use `php artisan migrate:fresh` on a database containing data you want to keep; it drops all tables before re-running migrations.

## Grant administrator access in local development

New registrations are deliberately not allowed to choose their own role. To promote your own existing account in your local development database:

```bash
php artisan tinker
```

Then, in Tinker, replace the email with the account you own:

```php
\\App\\Models\\User::where('email', 'your-email@example.com')->update(['role' => 'admin']);
```

Verify the role, log out/in if needed, and visit `/admin/cars`. Do not promote users based on untrusted form input and do not use a shared example password for a production administrator.

## Learning sequence

1. Trace `routes/web.php` into `CarController::index()`.
2. Read the Eloquent query and note the use of `with()`, `when()`, `whereHas()`, and `paginate()`.
3. Submit the create form and follow `SaveCarRequest::rules()` → `store()` → `Car::create()`.
4. Edit one record and compare `update()` with `create()`.
5. Try opening `/admin/cars` as a guest, a normal user, and an admin to understand middleware.
6. Read `AdminCarCrudTest` to see how access rules and database changes are verified automatically.

After this milestone, sensible next steps are admin CRUD for brands/categories, authorization policies where permissions become resource-specific, safer image uploads, and tests for the remaining edge cases.
