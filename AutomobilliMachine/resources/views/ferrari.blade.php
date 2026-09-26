<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/generalstyle.css')}}" />
    <link rel="icon" type="image/png" href="{{asset('image/logo.png')}}">
    <title>Ferrari Heritage & Performance</title>
  </head>

  <body>
    <header id="home">
      <div class="hero">
        <div class="hero-content">
          <p class="hero-label">ITALIAN PERFORMANCE</p>
          <h1>FERRARI</h1>
          <p class="hero-description">
            Explore the heritage, performance, and iconic machines that define
            Ferrari.
          </p>

          <a href="#models" class="hero-button"> Explore Models </a>
        </div>
      </div>
      <nav>
        <div class="nav-container">
          <a href="#home" class="brand"> ROSSO CORSA </a>
          <ul>
            <li>
              <a href="#home">Home</a>
            </li>
            <li>
              <a href="#models">Models</a>
            </li>
            <li>
              <a href="#heritage">Heritage</a>
            </li>
            <li>
              <a href="#performance">Performance</a>
            </li>
            <li>
              <a href="#featured">Featured</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <main>
      <div id="content">
        <article id="models" class="content-card">
          <div class="section-heading">
            <p class="section-label">ICONIC MACHINES</p>
            <h2>Ferrari Models</h2>
            <p>
              Several Ferrari models that symbolize the performance, design, and
              character of Italian sports cars.
            </p>
          </div>

          <div class="model-container">
            <section class="model-card">
              <img
                src="{{asset('image/Ferrari F40.jpg')}}"
                alt="Ferrari F40"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> ICON </span>
                <h3>Ferrari F40</h3>
                <p>
                  The Ferrari F40 is one of the most iconic cars in Ferrari
                  history. Its design features an aggressive character focused on
                  performance and driving experience.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>V8 Twin-Turbo</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari F12 Berlinetta.jpg')}}"
                alt="Ferrari F12 Berlinetta"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> GRAND TOURER </span>
                <h3>Ferrari F12 Berlinetta</h3>
                <p>
                  The Ferrari F12 Berlinetta combines a V12 engine, aerodynamic
                  design, and grand-tourer comfort in a high-performance car.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>6.3L V12</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari SF90 Spider.jpg')}}"
                alt="Ferrari SF90 Spider"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> HYBRID </span>
                <h3>Ferrari SF90 Spider</h3>
                <p>
                  The SF90 Spider represents Ferrari's move toward electrification
                  by combining a conventional engine with electric motors.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>V8 Hybrid</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>AWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari 458 Italia.jpg')}}"
                alt="Red Ferrari 458 Italia"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> SUPERCAR </span>
                <h3>Ferrari 458 Italia</h3>
                <p>
                  The Ferrari 458 Italia is known for its naturally aspirated V8
                  and a design that combines aerodynamic efficiency with Ferrari's
                  distinctive character.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>4.5L V8</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </article>

        <article id="models" class="content-card">
          <div class="section-heading">
            <p class="section-label">ALL MODELS</p>
            <h2>All Ferrari</h2>
            <p>
              All Ferrari models.
            </p>
          </div>

          <div class="model-container">
            <section class="model-card">
              <img
                src="{{asset('image/Ferrari F40.jpg')}}"
                alt="Ferrari F40"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> ICON </span>
                <h3>Ferrari F40</h3>
                <p>
                  The Ferrari F40 is one of the most iconic cars in Ferrari
                  history. Its design features an aggressive character focused on
                  performance and driving experience.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>V8 Twin-Turbo</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari F12 Berlinetta.jpg')}}"
                alt="Ferrari F12 Berlinetta"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> GRAND TOURER </span>
                <h3>Ferrari F12 Berlinetta</h3>
                <p>
                  The Ferrari F12 Berlinetta combines a V12 engine, aerodynamic
                  design, and grand-tourer comfort in a high-performance car.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>6.3L V12</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari SF90 Spider.jpg')}}"
                alt="Ferrari SF90 Spider"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> HYBRID </span>
                <h3>Ferrari SF90 Spider</h3>
                <p>
                  The SF90 Spider represents Ferrari's move toward electrification
                  by combining a conventional engine with electric motors.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>V8 Hybrid</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>AWD</strong>
                  </div>
                </div>
              </div>
            </section>

            <section class="model-card">
              <img
                src="{{asset('image/Ferrari 458 Italia.jpg')}}"
                alt="Red Ferrari 458 Italia"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> SUPERCAR </span>
                <h3>Ferrari 458 Italia</h3>
                <p>
                  The Ferrari 458 Italia is known for its naturally aspirated V8
                  and a design that combines aerodynamic efficiency with Ferrari's
                  distinctive character.
                </p>
                <div class="specification">
                  <div>
                    <span>Engine</span>
                    <strong>4.5L V8</strong>
                  </div>
                  <div>
                    <span>Layout</span>
                    <strong>RWD</strong>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </article>

        <article id="heritage" class="content-card heritage">
          <div class="section-heading">
            <p class="section-label">THE LEGACY</p>
            <h2>Ferrari Heritage</h2>
          </div>
          <img
            src="{{asset('image/ferrari.jpg')}}"
            alt="Foto Ferrari"
            class="feature-image"/>
          <p>
            Ferrari is one of the most influential names in the automotive world.
            Its identity is built on a combination of motorsport, engineering,
            design, and high-performance automotive character.
          </p>
          <p>
            As technology evolves, Ferrari continues to develop vehicles through
            new approaches, from V8 and V12 engines to hybrid technology in
            modern generations.
          </p>
          <section class="heritage-section">
            <h3>From Racing to Road Cars</h3>
            <p>
              Ferrari's racing experience has strongly influenced the development
              of its road cars. Aerodynamic technology, materials, engines, and
              vehicle control continue to evolve from one generation to the next.
            </p>
          </section>
        </article>

        <article id="performance" class="content-card">
          <div class="section-heading">
            <p class="section-label">ENGINEERING</p>
            <h2>Performance Philosophy</h2>
            <p>
              A Ferrari is not only about speed, but also about the balance between
              the engine, aerodynamics, handling, and design.
            </p>
          </div>
          <div class="performance-container">
            <section class="performance-item">
              <span class="performance-number"> 01 </span>
              <h3>Engine</h3>
              <p>
                The engine is one of the defining elements of Ferrari's character,
                ranging from V8 and V12 power to modern hybrid systems.
              </p>
            </section>

            <section class="performance-item">
              <span class="performance-number"> 02 </span>
              <h3>Aerodynamics</h3>
              <p>
                The body is designed not only for aesthetics, but also to manage
                airflow and vehicle stability.
              </p>
            </section>

            <section class="performance-item">
              <span class="performance-number"> 03 </span>
              <h3>Handling</h3>
              <p>
                The suspension, steering, and weight distribution systems are
                developed to deliver precise vehicle responses.
              </p>
            </section>
            <section class="performance-item">
              <span class="performance-number"> 04 </span>
              <h3>Design</h3>
              <p>
                Every model combines aerodynamic function with a distinctive
                Ferrari design language.
              </p>
            </section>
          </div>
        </article>
      </div>

      <aside id="featured">
        <article class="featured-card">
          <div class="featured-header">
            <p class="section-label">FEATURED FERRARI</p>
            <h2>Ferrari F40</h2>
            <p>A timeless icon of Ferrari performance.</p>
          </div>
          <figure>
            <img
              src="{{asset('image/Ferrari F40 1.jpg')}}"
              alt="Ferrari F40"
              class="profile-image"/>
            <figcaption>Ferrari F40</figcaption>
          </figure>

          <section class="featured-info">
            <h3>Vehicle Information</h3>
            <table>
              <tr>
                <th>Manufacturer</th>
                <td>Ferrari</td>
              </tr>
              <tr>
                <th>Model</th>
                <td>F40</td>
              </tr>
              <tr>
                <th>Category</th>
                <td>Supercar</td>
              </tr>
              <tr>
                <th>Engine</th>
                <td>V8 Twin-Turbo</td>
              </tr>
              <tr>
                <th>Drive</th>
                <td>Rear-Wheel Drive</td>
              </tr>
              <tr>
                <th>Country</th>
                <td>Italy</td>
              </tr>
            </table>
          </section>
          <section class="featured-description">
            <h3>Why It's Special</h3>
            <p>
              The F40 is known for its performance-focused design and remains one
              of the most recognizable Ferrari cars to this day.
            </p>
          </section>
        </article>
      </aside>
    </main>

    <footer>
      <div class="footer-container">
        <div>
          <h2>FERRARI</h2>
          <p>Heritage & Performance</p>
        </div>
        <div>
          <p>Test Test</p>
          <p>&copy; 2026</p>
        </div>
      </div>
    </footer>
  </body>
</html>
