<!doctype html>
<html lang="id">
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
              Beberapa model Ferrari yang menjadi simbol performa, desain, dan
              karakter mobil sport Italia.
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
                  Ferrari F40 merupakan salah satu mobil paling ikonik dalam
                  sejarah Ferrari. Desainnya menampilkan karakter agresif dengan
                  fokus pada performa dan pengalaman berkendara.
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
                  Ferrari F12 Berlinetta memadukan mesin V12, desain
                  aerodinamis, dan kenyamanan sebuah grand tourer dalam satu
                  mobil berperforma tinggi.
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
                  SF90 Spider menunjukkan perkembangan Ferrari menuju era
                  elektrifikasi dengan menggabungkan mesin konvensional dan
                  motor listrik.
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
                alt="Ferrari 458 Italia berwarna merah"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> SUPERCAR </span>
                <h3>Ferrari 458 Italia</h3>
                <p>
                  Ferrari 458 Italia dikenal dengan mesin V8 naturally aspirated
                  serta desain yang menggabungkan aerodinamika dan keindahan
                  khas Ferrari.
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
              Semua model Ferrari.
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
                  Ferrari F40 merupakan salah satu mobil paling ikonik dalam
                  sejarah Ferrari. Desainnya menampilkan karakter agresif dengan
                  fokus pada performa dan pengalaman berkendara.
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
                  Ferrari F12 Berlinetta memadukan mesin V12, desain
                  aerodinamis, dan kenyamanan sebuah grand tourer dalam satu
                  mobil berperforma tinggi.
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
                  SF90 Spider menunjukkan perkembangan Ferrari menuju era
                  elektrifikasi dengan menggabungkan mesin konvensional dan
                  motor listrik.
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
                alt="Ferrari 458 Italia berwarna merah"
                class="model-image"/>
              <div class="model-content">
                <span class="model-category"> SUPERCAR </span>
                <h3>Ferrari 458 Italia</h3>
                <p>
                  Ferrari 458 Italia dikenal dengan mesin V8 naturally aspirated
                  serta desain yang menggabungkan aerodinamika dan keindahan
                  khas Ferrari.
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
            Ferrari dikenal sebagai salah satu nama paling berpengaruh dalam
            dunia otomotif. Identitasnya dibangun melalui perpaduan motorsport,
            engineering, desain, dan karakter mobil berperforma tinggi.
          </p>
          <p>
            Seiring perkembangan teknologi, Ferrari terus mengembangkan
            kendaraan dengan pendekatan baru, mulai dari penggunaan mesin V8 dan
            V12 hingga teknologi hybrid pada generasi modern.
          </p>
          <section class="heritage-section">
            <h3>From Racing to Road Cars</h3>
            <p>
              Pengalaman Ferrari di dunia balap memberikan pengaruh besar
              terhadap pengembangan mobil jalan raya. Teknologi aerodinamika,
              material, mesin, serta pengendalian kendaraan terus berkembang
              dari generasi ke generasi.
            </p>
          </section>
        </article>

        <article id="performance" class="content-card">
          <div class="section-heading">
            <p class="section-label">ENGINEERING</p>
            <h2>Performance Philosophy</h2>
            <p>
              Sebuah Ferrari bukan hanya mengenai kecepatan, tetapi juga
              keseimbangan antara mesin, aerodinamika, handling, dan desain.
            </p>
          </div>
          <div class="performance-container">
            <section class="performance-item">
              <span class="performance-number"> 01 </span>
              <h3>Engine</h3>
              <p>
                Mesin menjadi salah satu bagian utama dalam karakter Ferrari,
                mulai dari V8 hingga V12 dan sistem hybrid generasi modern.
              </p>
            </section>

            <section class="performance-item">
              <span class="performance-number"> 02 </span>
              <h3>Aerodynamics</h3>
              <p>
                Bentuk bodi dirancang tidak hanya untuk estetika, tetapi juga
                membantu mengatur aliran udara dan kestabilan kendaraan.
              </p>
            </section>

            <section class="performance-item">
              <span class="performance-number"> 03 </span>
              <h3>Handling</h3>
              <p>
                Sistem suspensi, kemudi, dan distribusi bobot dikembangkan untuk
                memberikan respons kendaraan yang presisi.
              </p>
            </section>
            <section class="performance-item">
              <span class="performance-number"> 04 </span>
              <h3>Design</h3>
              <p>
                Setiap model memadukan fungsi aerodinamika dengan bahasa desain
                yang memiliki identitas khas Ferrari.
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
              F40 dikenal karena desain yang sangat berorientasi pada performa
              dan menjadi salah satu mobil Ferrari yang paling mudah dikenali
              hingga saat ini.
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
