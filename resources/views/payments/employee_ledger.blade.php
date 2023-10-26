<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <x-head />
  </head>

  <body>
          <x-dashboard/>
          @include('sweetalert::alert')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('employee_payments')}}" style ="font-size:15px">Employee Ledger</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee Payments</li>
                  </ol>
                </nav>
              </div>
            </div>
            <x-alert />

              <!-- Basic Bootstrap Table -->
    <!-- Credit By Cashier -->
    <div class="card">
    <div class="card-header">
              <h3 class="card-title">{{getname($EMPID)}}
              <h6 class="card-title">Select Payment Entry Method</h6>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-danger" data-card-widget="collapse" title="Collapse" id="DebitBtn">Add Debit
                </button>
                <button type="button" class="btn btn-tool btn-success" data-card-widget="collapse" title="Collapse"id="CreditBtn">Add Credit
                </button>
                <button type="button" class="btn btn-tool btn-secondary" data-card-widget="collapse" title="Collapse"id="CloseBtn">Close
                </button>
              </div>
            </div>
</div>
    <section class="content mt-2" id="CreditCashier" style="display:none;">
      <form action="{{url('employee_credit')}}" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Credit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
              <div class="row">
                  <div class="col-sm-2">
                    <label for="inputDate">PAY ID</label>
                    <input type="text" name="inputDebitID" value="{{$PAYID}}" class="form-control" readonly>
                  </div>
                  <!-- <div class="col-sm-3">
                    <label for="inputId">TRANSACTION ID</label>
                    <input type="text" name="trans_id" class="form-control">
                  </div> -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Employee ID</label>
                    <input type="text" name="user_id" value="{{$EMPID}}" class="form-control" readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputDes">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputDebit">Credit</label>
                    <input type="number" name="credit" class="form-control" placeholder="Credit">
                  </div>
                  <div class="col-sm-3">
                    <label for="inputGB">Written By</label>
                      <input name="given_by" class="form-control select2" value="{{session('user_id')}}" style="width: 100%;" readonly>
                  </div>
                </div>
                <div class="col-12 mt-3">
          <!-- <a href="/parties" class="btn btn-secondary">Cancel</a> -->
          <button type="submit" value="Add lot" class="btn btn-success float-right">Add Credit</button>
        </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </form>
</section>
    <section class="content mt-2" id="DebitCashier" style="display:none;">
      <form action="{{url('employee_credit')}}" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Debit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
              <div class="row">
                  <div class="col-sm-2">
                    <label for="inputDate">PAY ID</label>
                    <input type="text" name="inputDebitID" value="{{$PAYID}}" class="form-control" readonly>
                  </div>
                  <!-- <div class="col-sm-3">
                    <label for="inputId">TRANSACTION ID</label>
                    <input type="text" name="trans_id" class="form-control">
                  </div> -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Employee ID</label>
                    <input type="text" name="user_id" value="{{$EMPID}}" class="form-control" readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputDes">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                  </div>
                  <div class="col-sm-2">
                    <label for="inputDebit">Debit</label>
                    <input type="number" name="debit" class="form-control" placeholder="Debit">
                  </div>
                  <div class="col-sm-3">
                    <label for="inputGB">Written By</label>
                    <input name="given_by" class="form-control select2" value="{{session('user_id')}}" style="width: 100%;" readonly>
                  </div>
                </div>
                <div class="col-12 mt-3">
          <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
          <button type="submit" value="Add lot" class="btn btn-danger float-right">Add Debit</button>
        </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </form>
    </section>
              <div class="card mt-5">
                <div class="row">
                <h5 class="card-header col-md-10">Payments Details</h5>
                <div class="col-md-2">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <!-- <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Add Parties
                        </button> -->
                    </div>
                </div>

            </div>
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered" style="overflow-x: auto;" id="exportTable">
                    <thead>
                      <tr>
                        <th>PAY-ID</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                   @php $balance = 0; @endphp
                     @foreach($ledger as $parties_ledger)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$parties_ledger->payment_id}}</strong> / <span class="badge bg-label-secondary">{{\Carbon\Carbon::parse($parties_ledger->created_at)->format('d M Y i:s:h')}}</span></td>
                        {{-- <td>{{$parties_ledger->employee_id}}</td> --}}
                        <td>{{$parties_ledger->description}} / <span class="badge bg-label-primary me-1">{{getname($parties_ledger->given_by)}}</span></td>
                        <td>{{$parties_ledger->debit}}</td>
                        <td>{{$parties_ledger->credit}}</td>
                        <td>{{$balance = ($balance + $parties_ledger->credit - $parties_ledger->debit)}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <!-- <a class="dropdown-item"
                              ><i class="bx bx-edit-alt me-1"></i>View Ledger</a
                              > -->
                              <a class="dropdown-item" href="{{url('delete_employee_payment/'.$parties_ledger->payment_id)}}" onclick="confirmDelete(event)"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
              <script>
                function confirmDelete(event) {
                    event.preventDefault(); // Prevent default link behavior

                    // Show a confirmation dialog
                    var result = confirm("Are you sure you want to delete this?");

                    // If user confirms, proceed with the deletion
                    if (result) {
                        var deleteUrl = event.target.getAttribute('href');
                        window.location.href = deleteUrl; // Redirect to the delete URL
                    }
                }
            </script>
                        <!--/ Basic Bootstrap Table -->

               <!-- FORM TRIGGER -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->




    <x-footerscript/>
    <script>
        $('#DebitBtn').on('click',function(){
            $('#CreditCashier').css('display','none');
            $('#DebitCashier').css('display','block');
        })
        $('#CreditBtn').on('click',function(){
            $('#DebitCashier').css('display','none');
            $('#CreditCashier').css('display','block');
        })
        $('#DebitBtn').on('click',function(){
            $('#CreditCashier').css('display','none');
            $('#DebitCashier').css('display','block');
        })
        $('#CloseBtn').on('click',function(){
            $('#DebitCashier').css('display','none');
            $('#CreditCashier').css('display','none');
        })
    </script>

  </body>
</html>
