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
           <x-alert />

              <!-- Basic Bootstrap Table -->
    <!-- Credit By Cashier -->
    <div class="card">
    <section class="content mt-2" id="CreditCashier" >
      <form action="{{url('checkLot')}}" method="GET">
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
                    <label for="inputDate">Lot Id</label>
                    <input type="text" name="getLot" class="form-control" value="{{ request()->has('getLot') ? request('getLot') : '' }}" placeholder="Lot Id">
                  </div>
                  <div class="col-sm-3">
                    <label for="inputId">Customer ID</label>
                    <select class="form-control" name="userId" id="">
                      @if(request()->has('userId'))
                        <option value="">-- Select --</option>
                        <option value="{{request('userId')}}" selected>{{request('userId') }} / {{getname(request('userId'))}}</option>
                      @else
                      <option value="">-- Select --</option>
                      @endif
                      @foreach($user as $userData)
                      <option value="{{$userData->user_id}}">{{$userData->user_id}} / {{getname($userData->user_id)}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="inputDate">Role</label>
                    <select class="form-control" name="role">
                      @if(request()->has('role'))
                        <option value="{{request('role')}}">{{request('role') }}</option>
                      @else
                      <option value="">-- Select --</option>
                      @endif
                      <option value="">-- Select --</option>
                      @foreach($workingArea as $working)
                      <option value="{{$working->workingAreaId}}">{{$working->workingAreaName}}</option>
                      <!-- <option value="pant">Pant</option> -->
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2 mt-4">
                    <button type="submit" class="btn btn-primary" required>Submit</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3 mt-2">
                      <label for="inputDes">Total Quantity</label>
                      <input type="text" class="form-control" value="{{$lotSum}}" id="totalQuantity" readonly>
                  </div>
                  <div class="col-sm-3 mt-2">
                      <label for="inputDes">T.Lot Quantity</label>
                      <input type="text" class="form-control" id="totalLotQuantity">
                  </div>
                  <div class="col-sm-3 mt-2">
                      <label for="inputDes">Extra Pcs</label>
                      <input type="text" class="form-control" id="extraPcs" readonly>
                  </div>
                </div>
                <script>
                  $('#totalLotQuantity').on('input',function(){
                    totalLot = $('#totalLotQuantity').val();
                    totalQuantity = $('#totalQuantity').val();
                    $('#extraPcs').val(totalLot - totalQuantity);
                  })
                </script>
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
                <div class="table-responsive text-nowrap" style="max-height: 500px; overflow-y: auto;">
                  <table class="table table-bordered" style="overflow-x: auto;" id="exportTable">
                    <thead>
                      <tr>
                        <th>CARD-ID</th>
                        <th>USER-ID</th>
                        <th>Lot-ID</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @php $balance = 0;
                    $num = count($lot);
                    $count = 1; @endphp
                    <input type="hidden" id="table_row" value="{{$num}}"/>
                     @foreach($lot as $lotData)
                      <tr id="row{{$count}}">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$lotData->card_id}}</strong> / <span class="badge bg-label-secondary me-1">{{\Carbon\Carbon::parse($lotData->created_at)->format('d M Y')}}</span></td>
                        <td>{{getname($lotData->user_id)}} / <span class="badge bg-label-secondary me-1">{{$lotData->user_id}}</span></td>
                        <td>{{$lotData->lot_id}}</td>
                        <td>{{$lotData->quantity}}</td>
                        <td>{{$lotData->rate}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('cashier_payments/'.$lotData->card_id)}}"
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
