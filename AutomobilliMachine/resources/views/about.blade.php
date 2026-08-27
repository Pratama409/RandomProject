<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IntelliPHP | About</title>
    <style>
        :root {
            --bg: #0b1220;
            --bg-soft: #111c2d;
            --card: #132238;
            --primary: #5eead4;
            --secondary: #7dd3fc;
            --text: #e5eefb;
            --muted: #a7b6cf;
            --accent: #fbbf24;
            --line: rgba(255,255,255,0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(180deg, var(--bg) 0%, #0d1729 100%);
            color: var(--text);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 24px 80px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: var(--primary);
        }

        .nav {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .nav a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
        }

        .nav a:hover {
            color: var(--text);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.35fr 0.9fr;
            gap: 28px;
            align-items: center;
            padding: 60px 0 36px;
        }

        .eyebrow {
            display: inline-block;
            padding: 8px 14px;
            background: rgba(94, 234, 212, 0.08);
            border: 1px solid rgba(94, 234, 212, 0.2);
            border-radius: 999px;
            color: var(--primary);
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        h1 {
            font-size: clamp(2.5rem, 4vw, 4.3rem);
            line-height: 1.08;
            margin: 0 0 16px;
        }

        .lead {
            font-size: 1.08rem;
            color: var(--muted);
            max-width: 620px;
            line-height: 1.8;
            margin: 0;
        }

        .cta-row {
            display: flex;
            gap: 14px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn.primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #062033;
        }

        .btn.secondary {
            border: 1px solid var(--line);
            color: var(--text);
            background: rgba(255,255,255,0.02);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .panel {
            background: linear-gradient(180deg, rgba(17,28,45,0.9), rgba(19,34,56,0.9));
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.18);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 24px;
        }

        .stat {
            padding: 18px 16px;
            border-radius: 14px;
            background: rgba(255,255,255,0.025);
            border: 1px solid var(--line);
        }

        .stat strong {
            display: block;
            font-size: 1.7rem;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .section {
            margin-top: 56px;
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-header h2 {
            margin: 0 0 8px;
            font-size: clamp(1.8rem, 2.5vw, 2.4rem);
        }

        .section-header p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 24px;
        }

        .icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(94, 234, 212, 0.08);
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 18px;
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 1.25rem;
        }

        .card p {
            margin: 0;
            line-height: 1.7;
            color: var(--muted);
        }

        .timeline {
            display: grid;
            gap: 18px;
            margin-top: 24px;
        }

        .timeline-item {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 20px;
            padding: 18px 0;
            border-bottom: 1px solid var(--line);
        }

        .year {
            color: var(--accent);
            font-weight: 700;
            letter-spacing: 0.04em;
        }

        .timeline-item h4 {
            margin: 0 0 6px;
            font-size: 1.05rem;
        }

        .timeline-item p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        @media (max-width: 820px) {
            .hero, .grid {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="topbar">
            <div class="brand">INTELLIPHP</div>
            <nav class="nav" aria-label="Main navigation">
                <a href="#about">About</a>
                <a href="#mission">Mission</a>
                <a href="#journey">Journey</a>
                <a href="#contact">Contact</a>
            </nav>
        </header>

        <section class="hero" id="about">
            <div>
                <span class="eyebrow">About us</span>
                <h1>We build smarter PHP experiences.</h1>
                <p class="lead">
                    IntelliPHP is a modern web development initiative focused on creating fast,
                    scalable, and elegant applications with the power of PHP and Laravel. We believe
                    software should be clean, useful, and built to evolve with real user needs.
                </p>
                <div class="cta-row">
                    <a class="btn primary" href="#mission">Learn more</a>
                    <a class="btn secondary" href="#contact">Get in touch</a>
                </div>
            </div>

            <div class="panel" aria-label="Company overview">
                <div style="font-size: 0.78rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted);">Overview</div>
                <div class="stats">
                    <div class="stat">
                        <strong>4+</strong>
                        <span>Years of learning</span>
                    </div>
                    <div class="stat">
                        <strong>12</strong>
                        <span>Core focus areas</span>
                    </div>
                    <div class="stat">
                        <strong>24/7</strong>
                        <span>Product mindset</span>
                    </div>
                    <div class="stat">
                        <strong>100%</strong>
                        <span>PHP-first</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="mission">
            <div class="section-header">
                <h2>Our mission</h2>
                <p>We help people and businesses transform ideas into reliable digital solutions through thoughtful engineering and practical design.</p>
            </div>

            <div class="grid">
                <article class="card">
                    <div class="icon">01</div>
                    <h3>Build with clarity</h3>
                    <p>We focus on maintainable code, simple architecture, and user-centered experiences that stay easy to evolve.</p>
                </article>

                <article class="card">
                    <div class="icon">02</div>
                    <h3>Ship with confidence</h3>
                    <p>Our workflows are designed to support performance, testing, and long-term reliability for every release.</p>
                </article>

                <article class="card">
                    <div class="icon">03</div>
                    <h3>Grow with purpose</h3>
                    <p>We create systems that scale with teams, products, and real-world demands instead of short-term shortcuts.</p>
                </article>
            </div>
        </section>

        <section class="section" id="journey">
            <div class="section-header">
                <h2>Our journey</h2>
                <p>From early experiments to full product thinking, IntelliPHP continues to evolve around better implementation and better outcomes.</p>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="year">2022</div>
                    <div>
                        <h4>Foundation</h4>
                        <p>Started exploring the potential of PHP as a modern platform for practical, performance-oriented application development.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="year">2023</div>
                    <div>
                        <h4>Framework adoption</h4>
                        <p>Adopted Laravel to establish cleaner patterns, faster delivery, and stronger application structure.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="year">2024</div>
                    <div>
                        <h4>Product focus</h4>
                        <p>Shifted toward building real-world solutions with better UX, maintainability, and business value.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="contact">
            <div class="section-header">
                <h2>Let's create something valuable</h2>
                <p>Whether it's a personal project, a startup idea, or a business platform, we are ready to build it with intention.</p>
            </div>
        </section>
    </div>
</body>
</html>
