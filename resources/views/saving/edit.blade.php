<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}/"
  data-template="vertical-menu-template-free"
  data-style="dark">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} | Edit box</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/') }}/img/favicon/favicon.ico" />


    <link rel="stylesheet" href="{{ asset('assets/') }}/vendor/fonts/remixicon/remixicon.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/') }}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/') }}/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('layout.sidebar')
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('layout.navbar')

          <!-- / Navbar -->
          
    <!-- endbuild -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Bootstrap Table -->
              <div class="card">
               <h5 class="card-header">Edit Saving box</h5>
                <div class="card-body">
                  <form action="{{ route('saving.update', $box->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                      <div class="row">
                        <div class="col mb-6 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="title"
                              class="form-control"
                              value="{{ $box->name }}"
                              name="name"
                              placeholder="Enter box name" />
                            <label for="titleBackdrop">Name</label>
                          </div>
                          <div class="col mb-2 mt-4">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="number"
                                id="editamountBackdrop"
                                class="form-control"
                                name="amount"
                                value="{{ round($box->amount) }}"
                                placeholder="000.00" />
                              <label for="amountBackdrop">Amount</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row g-2">
                        <div class="col mb-2">
                          <div class="form-floating form-floating-outline">
                            <select class="form-select" name="type" id="edittypeBackdrop">
                              @foreach(['deposit', 'withdrawal'] as $type)
                                <option value="{{ $type }}" @selected($type == $box->type)>
                                  {{ $type }}
                                </option>
                              @endforeach
                            </select>
                            <label for="typeBackdrop">Type</label>
                          </div>
                        </div>
                        <div class="row g-4">
                          <div class="col mb-2">
                            <div class="form-floating form-floating-outline">
                              <textarea name="description" id="editdescription" cols="30" rows="10" class="form-control">{{ $box->description }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div>
                    <hr>
                      <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                  </form>
                </div>

                <div class="mx-3">
                </div>
              </div>
              <!--/ Responsive Table -->
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
    <script src="{{ asset('assets/') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets/') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets/') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets/') }}/vendor/libs/node-waves/node-waves.js"></script> 
    <script src="{{ asset('assets/') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets/') }}/vendor/js/menu.js"></script>
    <script src="{{ asset('assets/') }}/js/pages/transactions.js"></script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/') }}/endor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets/') }}/endor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets/') }}/endor/js/bootstrap.js"></script>
    <script src="{{ asset('assets/') }}/endor/libs/node-waves/node-waves.js"></script> 
    <script src="{{ asset('assets/') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets/') }}/vendor/js/menu.js"></script>
    <!-- Vendors JS -->

    <!-- Page JS -->
    @if (Session::has('success'))
       <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
       <div class="toast-header">
         <i class="ri-checkbox-circle-fill text-success me-2"></i>
           <div class="me-auto fw-medium">Success</div>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
         <div class="toast-body">{{ Session::get('success') }}</div>
     </div>
            <!-- Page JS -->
     <script>
      const toastPlacementExample = document.querySelector(".toast-placement-ex");
        let selectedType, selectedPlacement;
        // Placement Button click
        selectedType = "text-success";
        selectedPlacement = "top-0 end-0".split(" ");

        function open() {
          toastPlacementExample
            .querySelectorAll('i[class^="ri-"]')
            .forEach(function (element) {
              element.classList.add(selectedPlacement);
            });
          DOMTokenList.prototype.add.apply(
            toastPlacementExample.classList,
            selectedPlacement
          );
          toastPlacement = new bootstrap.Toast(toastPlacementExample);
          toastPlacement.show();
        }
          open();
      </script>
    @endif

  </body>
</html>
