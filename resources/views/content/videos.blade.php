<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} | Finances Educational Books</title>


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <link rel="stylesheet" href="../assets/vendor/fonts/remixicon/remixicon.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('layout.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          	@include('layout.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Examples -->

              <!-- Grid Card -->
              <h6 class="pb-1 mb-4 text-muted">Finances Videos</h6>
              <div class="row row-cols-1 row-cols-md-3 g-6 mb-6">
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/2.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/13.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/1.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/18.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/19.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top h-75" src="../assets/img/elements/20.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Masonry -->
              <h6 class="pb-1 mb-6 text-muted">Masonry</h6>
              <div class="row g-6" data-masonry='{"percentPosition": true }'>
                <div class="col-sm-6 col-lg-4">
                  <div class="card">
                    <img class="card-img-top" src="../assets/img/elements/5.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">CVideotitle that wraps to a new line</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3">
                    <figure class="p-3 mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-muted">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card">
                    <img class="card-img-top" src="../assets/img/elements/18.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This card has supporting text below as a natural lead-in to additional content.
                      </p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card bg-primary text-white text-center p-3">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-white">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card text-center">
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card">
                    <img class="card-img" src="../assets/img/elements/17.jpg" alt="Card image cap" />
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card p-3 text-end">
                    <figure class="mb-0">
                      <blockquote class="blockquote">
                        <p>A well-known quote, contained in a blockquote element.</p>
                      </blockquote>
                      <figcaption class="blockquote-footer mb-0 text-muted">
                        Someone famous in <cite title="Source Title">Source Title</cite>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Video title</h5>
                      <p class="card-text">
                        This is another card with title and supporting text below. This card has some additional content
                        to make it slightly taller overall.
                      </p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Card layout -->
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/masonry/masonry.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
