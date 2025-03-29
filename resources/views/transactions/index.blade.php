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

    <title>{{ config('app.name') }} | Transactions</title>

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
                  Transactions
                  <button data-bs-toggle="modal" data-bs-target="#addTransaction" class="btn rounded-pill btn-outline-primary waves-effect">
                    <i class="ri-add-line"></i>
                    New transaction
                  </button>
                </h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if($transactions->count() > 0)
                        @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{ $transaction->id }}</td>
                          <td>{{ $transaction->title }}</td>
                          <td><span>{{ Str::limit($transaction->description, 25) ?? '- no details -' }}</span></td>
                          <td>
                          <span class="badge rounded-pill bg-label-{{ $transaction->type == 'income' ? 'success' : 'danger' }} me-1">{{ $transaction->type }}</span>
                          </td>
                          <td>
                            {{ number_format($transaction->amount) }}
                          </td>
                          <td>{{ $transaction->category }}</td>
                          <td>{{ $transaction->date }}</td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ri-more-2-line"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('transactions.edit', $transaction->id) }}"><i class="ri-pencil-line me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="{{ route('transactions.deletePage', $transaction->id) }}"><i class="ri-delete-bin-6-line me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                      @else
                        <tr>
                          <td>There is no transactions yet 🤔</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <div class="mx-3">
                  {{ $transactions->links('layout.pagination') }}
                </div>
              </div>
              <!--/ Responsive Table -->
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>

          <!-- Modal -->
            <div class="modal fade" id="addTransaction" data-bs-backdrop="static" tabindex="-1">
              <div class="modal-dialog">
                <form class="modal-content">
                  @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionTitle">Add Transaction</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col mb-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="titleBackdrop"
                            class="form-control"
                            name="title"
                            placeholder="Enter Title" />
                          <label for="titleBackdrop">Title</label>
                        </div>
                        <div class="col mb-2 mt-2">
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
                    <div class="row g-4">
                      <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                          <input type="date" id="dateBackdrop" class="form-control"  name="date"/>
                          <label for="dateBackdrop">Date</label>
                        </div>
                      </div>
                      <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                          <select class="form-select" name="type" id="typeBackdrop">
                            <option value="income">income</option>
                            <option value="expense">expense</option>
                          </select>
                          <label for="typeBackdrop">Type</label>
                        </div>
                      </div>

                      <div class="col mb-2">
                        <div class="form-floating form-floating-outline">
                          <select class="form-select" id="categoryBackdrop" name="category">
                            <option value="salary">salary</option>
                            <option value="busnuis">busnuis</option>
                            <option value="Git">Git</option>
                            <option value="shopping">shopping</option>
                            <option value="education">education</option>
                          </select>
                          <label for="categoryBackdrop">Category</label>
                        </div>
                      </div>

                      <div class="row g-4">
                        <div class="col mb-2">
                          <div class="form-floating form-floating-outline">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                            placeholder="Description"></textarea>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="submit" id="newTransaction" class="btn btn-primary" onsubmit="return;">Save</button>
                  </div>
                </form>
              </div>
            </div>
          <!-- Model -->
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
    <script src="../assets/js/pages/transactions.js"></script>

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

    <!-- Main JS -->
    <script src="{{ url('assets') }}/js/main.js"></script>
    <!-- Page JS -->
  </body>
</html>
