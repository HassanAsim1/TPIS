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
    <style>
      .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    /* Style for the table */
    .table-bordered {
        border-collapse: collapse;
        width: 100%;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table-bordered th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    </style>
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
                    <li class="breadcrumb-item"><a href="{{url('parties_payments')}}" style ="font-size:15px">Parties ledger</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Parties Payments</li>
                  </ol>
                </nav>
              </div>
            </div>
            <x-alert />

              <!-- Basic Bootstrap Table -->
    <!-- Credit By Cashier -->
    <div class="card">
    <div class="card-header">
              <h3 class="card-title">{{getpartiename($PRTYID->partie_id)}} 
                @if(getpartiestatus($PRTYID->partie_id) == 'active')
                <span class="badge bg-label-primary me-1" style="font-size:10px;">Active</span>
                @else
                <span class="badge bg-label-danger me-1" style="font-size:10px;">Disable</span>
                @endif</h3>
              <h6 class="card-title">Select Payment Entry Method</h6>
              <div class="card-tools">
                <div class="row">
                  <div class="col-sm-8">
                  <button type="button" class="btn btn-sm btn-tool btn-danger" data-card-widget="collapse" title="Collapse" id="DebitBtn">Add Debit
                </button>
                <button type="button" class="btn btn-sm btn-tool btn-success" data-card-widget="collapse" title="Collapse"id="CreditBtn">Add Credit
                </button>
                <button type="button" class="btn btn-sm btn-tool btn-secondary" data-card-widget="collapse" title="Collapse"id="CloseBtn">Close
                </button>
                <button type="button" class="btn btn-sm btn-secondary" onclick="window.open('{{ route('printPartieInvoice', ['partie_id' => $PRTYID->partie_id]) }}', '_blank');">Generate Invoice</button>
                  </div>
                  <div class="col-sm-4">
                  <label for="inputDate">Balance</label>
                    <input type="text" name="inputDebitID" value="{{number_format(cal_current_amount($PRTYID->partie_id))}}" class="form-control" readonly>
                  </div>
                </div>
              </div>
            </div>
</div>
    <section class="content mt-2" id="CreditCashier" style="display:none;">
      <form action="{{url('partie_credit')}}" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Credit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse" title="Collapse">
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
                  <div class="col-sm-3">
                    <label for="inputId">TRANSACTION ID</label>
                    <input type="text" name="trans_id" class="form-control">
                  </div>
                  <div class="col-sm-3">
                      <label for="inputId">TRANSACTION Date</label>
                      <input type="datetime-local" name="date" id="inputId" class="form-control" value="{{ date('Y-m-d\TH:i') }}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Partie ID</label>
                    <input type="text" name="parties_id" value="{{$PRTYID->partie_id}}" class="form-control" readonly>
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
          <!-- <a href="/parties" class="btn btn-sm btn-secondary">Cancel</a> -->
          <button type="submit" value="Add lot" class="btn btn-sm btn-success float-right">Add Credit</button>
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
      <form action="{{url('partie_credit')}}" method="POST">
        @csrf
        <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Debit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse" title="Collapse">
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
                  <div class="col-sm-3">
                    <label for="inputId">TRANSACTION ID</label>
                    <input type="text" name="trans_id" class="form-control">
                  </div>
                  <div class="col-sm-3">
                      <label for="inputId">TRANSACTION Date</label>
                      <input type="datetime-local" name="date" id="inputIdDebit" class="form-control" value="{{ date('Y-m-d\TH:i') }}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label for="inputId">Partie ID</label>
                    <input type="text" name="parties_id" value="{{$PRTYID->partie_id}}" class="form-control" readonly>
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
                    <input name="given_by" class="form-control" value="{{session('user_id')}}" style="width: 100%;" readonly>
                  </div>
                </div>
                <div class="col-12 mt-3">
          <!-- <a href="#" class="btn btn-sm btn-secondary">Cancel</a> -->
          <button type="submit" value="Add lot" class="btn btn-sm btn-danger float-right">Add Debit</button>
        </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </form>
    </section>
              <div class="card mt-2">
                <div class="row">
                <h5 class="card-header col-md-10">Payments Details</h5>
                
            
            </div>   
                <div class="table-responsive text-nowrap" style="max-height: 500px; overflow-y: auto;">
                  <table class="table table-bordered" style="overflow-x: auto;" id="exportTable">
                    <thead>
                      <tr>
                        <th>PAY-ID</th>
                        <th>TRANSCATION-ID / BILL NO</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                   @php $balance = 0;
                    $num = count($ledger);
                    $count = 1; @endphp
                    <input type="hidden" id="table_row" value="{{$num}}"/>
                     @foreach($ledger as $parties_ledger)
                      <tr id="row{{$count}}">
                        <td><span class="badge bg-label-secondary me-1">{{ $parties_ledger->payment_id }} - {{\Carbon\Carbon::parse($parties_ledger->created_at)->format('d M Y h:iA')}}</span></td>
                        <td>
                          <a href="{{ substr($parties_ledger->trans_id, 0, 3) === 'INV' ? '/invoiceEdit/' . $parties_ledger->trans_id : '#' }}" target="_blank">
                              {{ $parties_ledger->trans_id }}
                          </a> / {{ $parties_ledger->cashierPayId }}
                        </td>
                        @if($parties_ledger->trans_id && $parties_ledger->credit)
                        <td>{{$parties_ledger->description}} / {!! getInvoiceRecord($parties_ledger->trans_id) !!} / <span class="badge bg-label-primary me-1">{{getname($parties_ledger->given_by)}}</span></td>
                        @else
                        <td>{{$parties_ledger->description}} / <span class="badge bg-label-primary me-1">{{getname($parties_ledger->given_by)}}</span></td>
                        @endif
                        <td>{{$parties_ledger->debit}}</td>
                        <td>{{$parties_ledger->credit}}</td>
                        <td>{{$balance = ($balance + $parties_ledger->credit - $parties_ledger->debit)}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('parties_payment/'.$parties_ledger->payment_id)}}"
                                ><i class="bx bx-edit"></i> Update</a
                              >
                              <a class="dropdown-item" onclick="confirm('{{$parties_ledger->payment_id}}')" href="javascript:void(0);"
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
    <script>
      function confirm(id){
        // alert(id);
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    // alert($id);
    $.ajax({
      type: 'get',
      url: 'delete/'+id,
      success: function(res){
        console.log('Transaction Deleted');
      }
    })
    location.reload();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Transcation is safe :)',
      'error'
    )
  }
})
}
    </script>

<script>
    document.getElementById("inputId").valueAsDate = new Date(); // Set the input's value to the current date
    document.getElementById("inputIdDebit").valueAsDate = new Date(); // Set the input's value to the current date
</script>
    
  </body>
</html>
