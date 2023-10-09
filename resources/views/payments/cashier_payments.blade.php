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
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
  </head>

  <body>
          <x-dashboard/>
          @include('sweetalert::alert')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cashier Payments</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
                  {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          @endif

              <!-- Basic Bootstrap Table -->
    <!-- Credit By Cashier -->
    <div class="card">
    <div class="card-header">
              <h3 class="card-title">Select Payment Entry Method</h3>
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
      <form action="{{url('adddebitemp')}}" method="POST">
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
                    <input type="text" name="inputDebitID" value="{{$debit_id}}" class="form-control" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Customer ID</label>
                    <select class="form-select" name="user_id" data-live-search="true">
                    <option value="Company" selected data-subtext="Company-Credit">Company</option>
                      @foreach($ParData as $Par)
                      @if($Par->status == 'active')
                      <option value="{{$Par->partie_id}}">{{$Par->name}}</option>
                      @endif
                    @endforeach
                  </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputDes">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="inputDebit">Credit</label>
                    <input type="number" name="credit" class="form-control" placeholder="Credit" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputGB">Given By</label>
                      <select name="given_by" class="form-select" style="width: 100%;">
                      @foreach ($CashData as $CData)
                        <option value="{{$CData['user_id']}}">{{$CData['user_id']}} / {{$CData['name']}}</option>
                      @endforeach
                      </select>
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
      <form action="{{url('adddebitemp')}}" method="POST">
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
                    <label for="inputDate">Debit ID</label>
                    <input type="text" name="inputDebitID" value="{{$debit_id}}" class="form-control" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Customer ID</label>
                    <select class="form-select" name="user_id" data-live-search="true">
                    <option value="Expense" data-subtext="Company-Expense">Expense</option>
                    @foreach($Empdata as $Emp)
                      @if($Emp->status == 'active')
                      <option value="{{$Emp->user_id}}" data-subtext="{{$Emp->user_id}}">{{$Emp->name}} / {{$Emp->user_id}}</option>
                      @endif
                    @endforeach
                  </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputDes">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Description" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="inputDebit">Debit</label>
                    <input type="number" name="debit" class="form-control" placeholder="Debit" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="inputGB">Given By</label>
                      <select name="given_by" class="form-control" style="width: 100%;">
                      @foreach ($CashData as $CData)
                        <option value="{{$CData['user_id']}}">{{$CData['user_id']}} / {{$CData['name']}}</option>
                      @endforeach
                      </select>
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
                        <th>USER-ID</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0"style="max-height: 300px; overflow-y: auto;">
                    @php $balance = 0;
                    $num = count($CashEntry);
                    $count = 1; @endphp
                    <input type="hidden" id="table_row" value="{{$num}}"/>
                     @foreach($CashEntry as $CashData)
                      <tr id="row{{$count}}">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$CashData->pay_id}}</strong> / <span class="badge bg-label-secondary me-1">{{\Carbon\Carbon::parse($CashData->created_at)->format('d M Y')}}</span></td>
                        <td>{{$CashData->user_id}}</td>
                        <td>{{$CashData->description}} / <span class="badge bg-label-primary me-1">{{$CashData->given_by}}</span></td>
                        <td>{{$CashData->debit}}</td>
                        <td>{{$CashData->credit}}</td>
                        <td>{{$balance = ($balance + $CashData->credit - $CashData->debit)}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('cashier_payments/'.$CashData->pay_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>Update</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                        @php $count++ @endphp
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
              <!--/ Basic Bootstrap Table -->

               <!-- FORM TRIGGER -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    <script>
      $(document).ready(function(){
        let rowval = $('#table_row').val();
        document.getElementById('row'+rowval).scrollIntoView();
      })
    </script>

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
