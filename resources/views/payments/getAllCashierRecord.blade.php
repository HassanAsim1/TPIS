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
  @media print {
      body * {
          visibility: hidden;
      }

      #printTable, #printTable * {
          visibility: visible;
      }

      #printTable {
          position: absolute;
          left: 0;
          top: 0;
      }
  }
</style>
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
    <div class="card-header">
              <h3 class="card-title">Select Payment Entry Method</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-sm btn-tool btn-danger" data-card-widget="collapse" title="Collapse" id="DebitBtn">Add Debit
                </button>
                <button type="button" class="btn btn-sm btn-tool btn-success" data-card-widget="collapse" title="Collapse"id="CreditBtn">Add Credit
                </button>
                <button type="button" class="btn btn-sm btn-tool btn-secondary" data-card-widget="collapse" title="Collapse"id="CloseBtn">Close
                </button>
                <button type="button" class="btn btn-sm btn-secondary mt-1" onclick="window.open('{{ route('cashierInvoice') }}', '_blank');">Generate Invoice</button>
                <button type="button" class="btn btn-sm btn-secondary mt-1" id="printButton">Current Invoice</button>
                <a href="{{ url('cashier_payments') }}"><button type="button" class="btn btn-sm btn-secondary mt-1">Back</button></a>
              </div>
              
            <input class="form-control mt-2" type="text" id="searchInput" placeholder="Search...">
            @if(session('role') == 'admin')
            <div class="card-tools">
              <select class="form-select mt-2" name="user_id" data-live-search="true" id="cashierDropdown">
                  @if(request('user_id'))
                  <option value="{{request('user_id')}}">{{getName(request('user_id'))}}</option>
                  @endif
                  @foreach($cashiers as $cashier)
                  <option value="{{$cashier->user_id}}">{{$cashier->name}}</option>
                  @endforeach
              </select>
              <button type="button" class="btn btn-sm btn-tool btn-primary mt-2" data-card-widget="collapse" title="Collapse" id="cashierBtn">Cashier</button>
          </div>
          @endif
          
          <script>
              $(document).ready(function () {
                  // Capture click event on the "Cashier" button
                  $("#cashierBtn").on("click", function () {
                      // Get the selected value from the dropdown
                      var selectedUserId = $("#cashierDropdown").val();
          
                      // Append the selected value to the current URL as a query parameter
                      var newUrl = "cashier_payments?user_id=" + selectedUserId;
          
                      // Redirect to the new URL
                      window.location.href = newUrl;
                  });
              });
          </script>
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
                            @if(session('role') == 'admin')
                              <select name="given_by" class="form-control" id="">
                                <option value="{{session('user_id')}}">{{getname(session('user_id'))}}</option>
                                @foreach($CashData as $data)
                                    <option value="{{$data->user_id}}">{{$data->name}}</option>
                                @endforeach
                              </select>
                              @else
                              <input type="text" value="{{session('user_id')}}" name="given_by" class="form-control" required>
                              @endif
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
      <form action="{{url('adddebitemp')}}" method="POST">
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
                    <input type="hidden" name="verify" value="0" class="form-control" readonly>
                    <label for="inputGB">Given By</label>
                      @if(session('role') == 'admin')
                      <select name="given_by" class="form-control">
                        <option value="{{session('user_id')}}">{{getname(session('user_id'))}}</option>
                        @foreach($CashData as $data)
                            <option value="{{$data->user_id}}">{{$data->name}}</option>
                        @endforeach
                      </select>
                      @else
                      <input type="text" value="{{session('user_id')}}" name="given_by" class="form-control" required>
                      @endif
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
              <div class="card mt-5">
                <div class="row">
                <h5 class="card-header col-md-10">Payments Details</h5>
                <div class="col-md-2">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <!-- <button
                          type="button"
                          class="btn btn-sm btn-primary"
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
                          <th>PAY-ID</th>
                          <th>USER-ID</th>
                          <th>Description</th>
                          <th>Debit</th>
                          <th>Credit</th>
                          <th>Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                      @php
                          $balance = 0;
                          $num = count($CashEntry);
                          $count = 1;
                      @endphp
                      <input type="hidden" id="table_row" value="{{ $num }}" />
                      @foreach ($CashEntry as $key => $CashData)
                          <tr id="row{{ $key + 1 }}">
                              <td>
                                  <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                  <span class="badge bg-label-secondary me-1">{{ $CashData->pay_id }} - {{ \Carbon\Carbon::parse($CashData->created_at)->format('d M Y h:iA') }}</span>
                              </td>
                              @if ($CashData->user_id != 'Expense' && $CashData->user_id != 'Company')
                                  @if ($CashData->debit != null)
                                      <td>{{ getname($CashData->user_id) }}</td>
                                  @else
                                      <td>{{ getpartiename($CashData->user_id) }}</td>
                                  @endif
                              @else
                                  <td>{{ $CashData->user_id }}</td>
                              @endif
                              @if ($CashData->verify == 0)
                                  <td>{{ $CashData->description }} /
                                      <span class="badge bg-label-primary me-1">{{ getname($CashData->given_by) }}</span> /
                                      <span class="badge bg-label-danger me-1">Not Verify</span>
                                  </td>
                              @else
                                  <td>{{ $CashData->description }} /
                                      <span class="badge bg-label-primary me-1">{{ getname($CashData->given_by) }}</span> /
                                      <span class="badge bg-label-success me-1">Verify</span>
                                  </td>
                              @endif
                              <td>{{ $CashData->debit }}</td>
                              <td>{{ $CashData->credit }}</td>
                              <td>{{ $balance = ($balance + $CashData->credit - $CashData->debit) }}</td>
                              <td>
                                  <div class="dropdown">
                                      <button type="button" class="btn btn-sm p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                          <a class="dropdown-item" href="{{ url('cashier_payments/' . $CashData->pay_id) }}">
                                              <i class="bx bx-edit-alt me-1"></i>Update</a>
                                          {{-- <a class="dropdown-item" href="javascript:void(0);"
                                              ><i class="bx bx-trash me-1"></i> Delete</a
                                          > --}}
                                      </div>
                                  </div>
                              </td>
                              @php
                                  $count++;
                              @endphp
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

    <script>
      const searchInput = document.getElementById('searchInput');
      const rows = document.querySelectorAll('tbody tr');
  
      searchInput.addEventListener('input', function () {
          const searchString = this.value.trim().toLowerCase();
  
          rows.forEach(row => {
              const isVisible = Array.from(row.children).some(cell => cell.textContent.trim().toLowerCase().includes(searchString));
              row.style.display = isVisible ? '' : 'none';
          });
      });
  </script>
  <script>
   function filterTable(searchText) {
        $('.table-bordered tbody tr').each(function () {
            const isVisible = $(this).text().toLowerCase().includes(searchText);
            $(this).toggle(isVisible);
        });
    }

    $('#printButton').on('click', function () {
    const printContent = $('.table-bordered').clone(); // Clone the table

    // Create a new window
    const printWindow = window.open('', '', 'width=600,height=600');

    // Write HTML content to the new window
    printWindow.document.write('<html><head><title>Print Table</title>');

    // Include CSS styles in the new window
    printWindow.document.write(
        '<style>' +
        'body { font-family: Arial, sans-serif; }' + // Example styles - customize as needed
        '.table-bordered { border-collapse: collapse; width: 100%; }' +
        '.table-bordered th, .table-bordered td { border: 1px solid #ddd; padding: 8px; text-align: left; }' +
        '.table-bordered th { background-color: #f2f2f2; }' +
        '</style>'
    );

    printWindow.document.write('</head><body>');
    printWindow.document.write('<div id="printTable"></div>'); // Create a placeholder for the table
    printContent.appendTo(printWindow.document.getElementById('printTable')); // Append cloned table to the placeholder

    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
});
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
