<!doctype html>


<html
  lang="en"
  class="dark-style layout-menu-fixed layout-compact"
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

    <title> {{ config('app.name') }} - Dashboard</title>

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
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

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
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

        @include('layout.navbar')
        
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                <!-- Congratulations card -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow-sm">
                    <div class="card-body text-nowrap">
                      <h5 class="card-title mb-0 flex-wrap text-nowrap">Balance 🎉</h5>
                      <p class="mb-2">Your balance {{ auth()->user()->name }}</p>
                      <h4 class="text-primary mb-0">${{ $balance }}</h4>
                      <p class="mb-2">This is balance</p>
                      <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
                    </div>
                    <img
                      src="../assets/img/illustrations/trophy.png"
                      class="position-absolute bottom-0 end-0 me-5 mb-5"
                      width="83"
                      alt="view sales" />
                  </div>
                </div>
                <!--/ Congratulations card -->

                <!-- Transactions -->
                <div class="col-lg-8">
                  <div class="card h-100 shadow-sm">
                    <div class="card-header">
                      <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Transactions Summary</h5>
                        <div class="dropdown">
                          <button
                            class="btn text-muted p-0"
                            type="button"
                            id="transactionID"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-24px"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                          </div>
                        </div>
                      </div>
                      <p class="small mb-0"><span class="h6 mb-0">Total incomes {{ $incomePercentage }}% Growth</span> 😎 this month</p>
                    </div>
                    <div class="card-body pt-lg-10">
                      <div class="row g-6">
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-primary rounded shadow-xs">
                                <i class="ri-pie-chart-2-line ri-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Total Amount</p>
                              <h5 class="mb-0">{{ $totalTransactionsAmount }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-success rounded shadow-xs">
                                <i class="ri-group-line ri-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Income Amount</p>
                              <h5 class="mb-0">{{ $monthIncomeTransactions }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-warning rounded shadow-xs">
                                <i class="ri-macbook-line ri-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Expense Amount</p>
                              <h5 class="mb-0">{{ $monthExpenseTransactions }}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="avatar">
                              <div class="avatar-initial bg-info rounded shadow-xs">
                                <i class="ri-money-dollar-circle-line ri-24px"></i>
                              </div>
                            </div>
                            <div class="ms-3">
                              <p class="mb-0">Balance</p>
                              <h5 class="mb-0">{{ $monthRemanentTransactions }}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->

                <!-- Weekly Overview Chart -->
                <div class="col-xl-4 col-md-6">
                  <div class="card shadow-sm">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Weekly Expense</h5>
                        <div class="dropdown">
                          <button
                            class="btn text-muted p-0"
                            type="button"
                            id="weeklyOverviewDropdown"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-24px"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body pt-lg-2">
                      <div id="weeklyOverviewChart"></div>
                      <div class="mt-1 mt-md-3">
                        <div class="d-flex align-items-center gap-4">
                          <h4 class="mb-0">{{ $expensePercentage }}%</h4>
                          <p class="mb-0">Your expense performance is {{ $expensePercentage }}% 😎 better compared to last month</p>
                        </div>
                        <div class="d-grid mt-3 mt-md-4">
                          <button class="btn btn-primary" type="button">Details</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Weekly Overview Chart -->

                <!-- Total Earnings -->
                <div class="col-xl-4 col-md-6">
                  <div class="card shadow-sm" style="height: 100%">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Goals Progress</h5>
                      <div class="dropdown">
                        <button
                          class="btn text-muted p-0"
                          type="button"
                          id="totalEarnings"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ri-more-2-line ri-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div>

                    </div>
                    <div class="card-body pt-lg-8">
                      <div class="mb-5 mb-lg-12">
                        <div class="d-flex align-items-center">
                          <h3 class="mb-0">${{ number_format($latestGoals->sum('current_amount')) }}</h3>
                          <span class="text-success ms-2">
                            <i class="ri-arrow-up-s-line"></i>
                            <span>{{ $goalsProgress }}%</span>
                          </span>
                        </div>
                        <p class="mb-0">from <b>${{ number_format($latestGoals->sum('target_amount')) }}</b></p>
                      </div>
                      <ul class="p-0 m-0">
                        @forelse($latestGoals as $goal)
                          <li class="d-flex mb-6">
                          <div class="avatar flex-shrink-0 bg-lightest rounded-circle me-3">
                            <img src="../assets/img/avatars/1.png" alt="zipcar" class="rounded-circle" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">{{ $goal->name }}</h6>
                            </div>
                            <div>
                              <h6 class="mb-2">${{number_format( $goal->current_amount )}}</h6>
                              <div class="progress bg-label-primary" style="height: 4px; width: 80px">
                                <div
                                  class="progress-bar bg-primary"
                                  style="width: {{ $goal->calcProgress() }}%"
                                  role="progressbar"
                                  aria-valuenow="75"
                                  aria-valuemin="0"
                                  aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @empty
                        <p class="d-flex mb-6 mt-5">There isn't goals 🎯😅</p>
                        <a href="{{ route('goals.index') }}" class="text-primary">Create new goal</a>
                        @endforelse
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Total Earnings -->

                <!-- Four Cards -->
                <div class="col-xl-4 col-md-6">
                  <div class="row gy-6">
                    <!-- Total Profit line chart -->
                    <div class="col-sm-6">
                      <div class="card h-100 shadow-sm">
                        <div class="card-header pb-0">
                          <h4 class="mb-0">$86.4k</h4>
                        </div>
                        <div class="card-body">
                          <div id="totalProfitLineChart" class="mb-3"></div>
                          <h6 class="text-center mb-0">Total Profit</h6>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Profit line chart -->
                    <!-- Total Profit Weekly Project -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                              <i class="ri-pie-chart-2-line ri-24px"></i>
                            </div>
                          </div>
                          <div class="dropdown">
                            <button
                              class="btn text-muted p-0"
                              type="button"
                              id="totalProfitID"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false">
                              <i class="ri-more-2-line ri-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                              <a class="dropdown-item" href="javascript:void(0);">Share</a>
                              <a class="dropdown-item" href="javascript:void(0);">Update</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Total Profit</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $weeklyProfitAmount }}</h4>
                            <p class="text-success mb-0">+42%</p>
                          </div>
                          <small>Weekly Profit</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Profit Weekly Project -->
                    <!-- New Yearly Project -->
                    <div class="col-sm-6">
                      <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                              <i class="ri-file-word-2-line ri-24px"></i>
                            </div>
                          </div>
                          <div class="dropdown">
                            <button
                              class="btn text-muted p-0"
                              type="button"
                              id="newProjectID"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false">
                              <i class="ri-more-2-line ri-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                              <a class="dropdown-item" href="javascript:void(0);">Share</a>
                              <a class="dropdown-item" href="javascript:void(0);">Update</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Total transactions</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $yearTotalTransactions }}</h4>
                          </div>
                          <small>Yearly transactions</small>
                        </div>
                      </div>
                    </div>
                    <!--/ New Yearly Project -->
                    <!-- Sessions chart -->
                    <div class="col-sm-6">
                      <div class="card h-100 shadow-sm">
                        <div class="card-header pb-0">
                          <h4 class="mb-0">2,856</h4>
                        </div>
                        <div class="card-body">
                          <div id="sessionsColumnChart" class="mb-3"></div>
                          <h6 class="text-center mb-0">Sessions</h6>
                        </div>
                      </div>
                    </div>
                    <!--/ Sessions chart -->
                  </div>
                </div>
                <!--/ Total Earning -->

                <!-- Sales by Countries -->
                <div class="col-xl-4 col-md-6">
                  <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Sales by Countries</h5>
                      <div class="dropdown">
                        <button
                          class="btn text-muted p-0"
                          type="button"
                          id="saleStatus"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false">
                          <i class="ri-more-2-line ri-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-4">
                          <div class="avatar me-4">
                            <div class="avatar-initial bg-label-success rounded-circle">US</div>
                          </div>
                          <div>
                            <div class="d-flex align-items-center gap-1 mb-1">
                              <h6 class="mb-0">$8,656k</h6>
                              <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                              <span class="text-success">25.8%</span>
                            </div>
                            <p class="mb-0">United states of america</p>
                          </div>
                        </div>
                        <div class="text-end">
                          <h6 class="mb-1">894k</h6>
                          <small class="text-muted">Sales</small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-4">
                          <div class="avatar me-4">
                            <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
                          </div>
                          <div>
                            <div class="d-flex align-items-center gap-1 mb-1">
                              <h6 class="mb-0">$2,415k</h6>
                              <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                              <span class="text-danger">6.2%</span>
                            </div>
                            <p class="mb-0">United Kingdom</p>
                          </div>
                        </div>
                        <div class="text-end">
                          <h6 class="mb-1">645k</h6>
                          <small class="text-muted">Sales</small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-4">
                          <div class="avatar me-4">
                            <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
                          </div>
                          <div>
                            <div class="d-flex align-items-center gap-1 mb-1">
                              <h6 class="mb-0">865k</h6>
                              <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                              <span class="text-success"> 12.4%</span>
                            </div>
                            <p class="mb-0">India</p>
                          </div>
                        </div>
                        <div class="text-end">
                          <h6 class="mb-1">148k</h6>
                          <small class="text-muted">Sales</small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center mb-4">
                          <div class="avatar me-4">
                            <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
                          </div>
                          <div>
                            <div class="d-flex align-items-center gap-1 mb-1">
                              <h6 class="mb-0">$745k</h6>
                              <i class="ri-arrow-down-s-line ri-24px text-danger"></i>
                              <span class="text-danger">11.9%</span>
                            </div>
                            <p class="mb-0">Japan</p>
                          </div>
                        </div>
                        <div class="text-end">
                          <h6 class="mb-1">86k</h6>
                          <small class="text-muted">Sales</small>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <div class="avatar me-4">
                            <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
                          </div>
                          <div>
                            <div class="d-flex align-items-center gap-1 mb-1">
                              <h6 class="mb-0">$45k</h6>
                              <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                              <span class="text-success">16.2%</span>
                            </div>
                            <p class="mb-0">Korea</p>
                          </div>
                        </div>
                        <div class="text-end">
                          <h6 class="mb-1">42k</h6>
                          <small class="text-muted">Sales</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Sales by Countries -->

                <!-- Deposit / Withdraw -->
                <div class="col-xl-8">
                  <div class="card-group shadow-sm">
                    <div class="card mb-0">
                      <div class="card-body card-separator">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">Top incomes categories</h5>
                          <p class="small mb-0">this month</p>
                          <a class="fw-medium" href="javascript:void(0);">View all</a>
                        </div>
                        <div class="deposit-content pt-2">
                          <ul class="p-0 m-0">
                            @foreach($topIncomeCategories as $income)
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="flex-shrink-0 me-4">
                                  <img
                                    src="../assets/img/icons/payments/gumroad.png"
                                    class="img-fluid"
                                    alt="gumroad"
                                    height="30"
                                    width="30" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ $income->category }}</h6>
                                    <p class="mb-0">total of transactions {{ $income->count }}</p>
                                  </div>
                                  <h6 class="text-success mb-0">{{ number_format($income->amount) }}$</h6>
                                </div>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card mb-0">
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">Top expenses categories</h5>
                          <p class="small mb-0">this month</p>
                          <a class="fw-medium" href="javascript:void(0);">View all</a>
                        </div>
                        <div class="withdraw-content pt-2">
                          <ul class="p-0 m-0">
                            @foreach($topExpenseCategories as $expense)
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="flex-shrink-0 me-4">
                                  <img
                                    src="../assets/img/icons/brands/google.png"
                                    class="img-fluid"
                                    alt="gumroad"
                                    height="30"
                                    width="30" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                      <h6 class="mb-0">{{ $expense->category }}</h6>
                                      <p class="mb-0">total of transactions {{ $expense->count }}</p>
                                    </div>
                                    <h6 class="text-danger mb-0">{{ number_format($expense->amount) }}$</h6>
                                  </div>
                                </li>
                              @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Deposit / Withdraw -->

              <!-- Data Tables -->
                <div class="col-12">
                  <div class="card overflow-hidden shadow-sm">
                    @if($latestTransactions->count() > 0)
                    <h5 class="card-header">Latest {{ $latestTransactions->count() }} tranactions</h5>
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th class="text-truncate">Title</th>
                            <th class="text-truncate">Description</th>
                            <th class="text-truncate">Amount</th>
                            <th class="text-truncate">Category</th>
                            <th class="text-truncate">Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($latestTransactions as $transaction)
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="../assets/img/avatars/{{$loop->iteration}}.png" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">{{ $transaction->title }}</h6>
                                  <small class="text-truncate">{{ $transaction->date }}</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">{{ Str::limit($transaction->description, 25) }}</td>
                            <td>{{ number_format($transaction->amount) }}</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="ri-vip-crown-line ri-22px text-primary me-2"></i>
                                <span>{{ $transaction->category }}</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-{{ $transaction->type == 'income'  ? 'success' : 'danger'}} rounded-pill">{{ $transaction->type }}</span></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @else
                      <h5 class="card-header">Latest tranactions</h5>
                      <div class="py-5">
                        <p class="text-center fs-6">There isn't transactions 😅, <a href="{{ route('transactions.index') }}">Create your first transaction</a></p>
                      </div>
                    @endif
                  </div>
                </div>
                <!--/ Data Tables -->

              </div>
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


    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>
  </body>
</html>
