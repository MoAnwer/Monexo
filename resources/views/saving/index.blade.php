<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="dark">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }} | Saving Boxs</title>

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
    <script src="../assets/js/config.js"></script>
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

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header d-flex justify-content-between">
                  Saving boxs
                  <button data-bs-toggle="modal" data-bs-target="#addTransaction" class="btn rounded-pill btn-outline-primary waves-effect">
                    <i class="ri-add-line"></i>
                    New saving box
                  </button>
                </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @forelse ($boxs as $box)
                        <tr>
                          <td>{{ $box->id }}</td>
                          <td>{{ $box->name }}</td>
                          <td>{{ number_format($box->amount) }}</td>
                          <td>
                            <span 
                            class="{{ $box->type == 'deposit' ? 'badge rounded-pill bg-label-success' : 'badge rounded-pill bg-label-danger' }}">
                              <i class="fs-6 {{ $box->type == 'deposit' ? 'ri-arrow-down-s-line' : 'ri-arrow-up-s-line' }}"> {{ $box->type }} </i>
                            </span>
                            <i ></i>
                          </td>
                          <td>{{ $box->description }}</td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ri-more-2-line"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('saving.edit', $box->id) }}">
                                <i class="ri-pencil-line me-1"></i>Edit</a>
                                <a class="dropdown-item" href="{{ route('saving.deletePage', $box->id) }}">
                                <i class="ri-delete-bin-6-line me-1"></i>Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td>There is no saving boxs yet 🤔</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mx-2">
                  {{ $boxs->links('layout.pagination') }}
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


      <!-- Modal -->
    <div class="modal fade" id="addTransaction" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content" action="{{ route('saving.create') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addTransactionTitle">New Saving Box</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col mb-2 mt-2">
                <div class="form-floating form-floating-outline">
                  <input
                    type="text"
                    id="titleBackdrop"
                    class="form-control"
                    name="name"
                    placeholder="Enter Saving Box Name" />
                  <label for="titleBackdrop">Box Name</label>
                </div>
                <div class="col mt-2">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="number"
                      id="amountBackdrop"
                      class="form-control"
                      name="amount"
                      placeholder="000.00" />
                    <label for="amountBackdrop">Amount</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-2">
              <div class="form-floating form-floating-outline">
                <select class="form-select" name="type" id="typeBackdrop">
                  <option value="deposit">deposit</option>
                  <option value="withdrawal">withdrawal</option>
                </select>
                <label for="typeBackdrop">Type</label>
              </div>
            </div>
            <div class="row g-4">
              <div class="col mb-2">
                <div class="form-floating form-floating-outline">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" cols="50" rows="40" style="min-height: 100px;" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" id="newTransaction" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
          <!-- Model -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script> 
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->
    <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
       <div class="toast-header">
         <i class="ri-checkbox-circle-fill text-success me-2"></i>
           <div class="me-auto fw-medium">Success</div>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
         <div class="toast-body"></div>
     </div>
    <!-- Vendors JS -->

    @if (Session::has('success'))
    <div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
       <div class="toast-header">
         <i class="ri-checkbox-circle-fill text-success me-2"></i>
           <div class="me-auto fw-medium">Success</div>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
         <div class="toast-body">{{ Session::get('success') }}</div>
     </div>
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
    @endif()
    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ url('assets') }}/js/main.js"></script>
    <!-- Page JS -->
  </body>
</html>
