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
	<div class="content-wrapper" style="padding: 20px;">
  @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
                  {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          @endif
	<div class="card">
		<div class="card-body invoice-padding pb-0">
    <form action="{{url('weekly_payments')}}" method="POST">
      @csrf
			<div class="row d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
				<div class="col-md-3">
					<div class="logo-wrapper">
						<h3 class="text-primary">TPIS</h3>
						<p>This is Textile Production and Inventory System Created By <strong>University of Lahore</strong> & <strong>Reownlogics</strong></p>
					</div>
				</div>
				<div class="col-md-4">
					<h3 class="text">Invoice</h3>
					<input
						type="text"
						class="form-control"
						name="week_id"
						value="{{$Pid}}"
						autofocus
						readonly
						/>
				</div>
				<div class="col-md-4">
					<h3 class="text">Created By:</h3>
					<input
						type="text"
						class="form-control"
						name="created_by"
                        value="{{session('role')}}"
						autofocus
                        readonly
						/>
				</div>
			</div>
		<hr class="mt-4">
        @php $count = 0; $totalEmployees = count($employees) @endphp
            @foreach($employees as $index => $employee)
                            <div class="row" id="addnewrow" style="margin-top:10px;">
                                <div class="col">
                                  <input type="text" class="form-control mt-2" name="employee_id[]" value="{{$employee->user_id}}" placeholder="EMP ID" readonly/>
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control mt-2" value="{{getname($employee->user_id)}}" placeholder="EMP NAME" readonly/>
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control mt-2" name="description[]" value="Weekly Payment" placeholder="Description" readonly/>
                                </div>
                                <div class="col">
                                <input type="text" class="form-control mt-2 tquan" id="squan{{$count}}" value="{{cal_employee_amount($employee->user_id)}}" name="debit[]" placeholder="debit"/>
                                </div>
                                <!-- <div class="col">
                                  <input type="text" class="form-control mt-2 tsum" id="stotal{{$count}}" name="stotal[]" placeholder="Total" readonly/>
                                </div> -->
                                <div class="col">
                                    @if($index == $totalEmployees - 1)
                                        <button type="button" class="btn btn-success mt-2" id="add_row">Add Row</button>
                                    @else
                                        <button type="button" class="btn btn-danger mt-2 remove-row-btn" id="remove_row">Remove Row</button>
                                    @endif
                                </div>
                              </div>
                              @php $count++ @endphp
                              @endforeach
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <button type="button" id="printButton" class="btn btn-primary">Print Page</button>
                              </div>
                              <div class="col-sm-2 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Amount:</label>
                              <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-2 mb-3">
                                <label class="col-form-label" for="basic-default-company">Recieved Amount:</label>
                                <input type="number" class="form-control stotal" id="recieve_amount" name="recieved_amount" placeholder="Recieve Amount" />
                              </div>

                              <div class="col-sm-2 mb-3">
                                <label class="col-form-label" for="basic-default-company">Remaining Amount:</label>
                                <input type="text" class="form-control" id="remain_amount" name="remaining_amount" placeholder="Recieve Amount" readonly />
                              </div>
                            </div>
                          </div>
                      </form>
                      <script>
    $(document).ready(function () {
        calculateTotals(); // Calculate totals when the page loads

        // Calculate totals when quantity input changes
        $(document).on('input', '.tquan', function () {
            calculateTotals();
        });

        function calculateTotals() {
            var totalQuantity = 0;
            var grandTotal = 0;

            $('.tquan').each(function () {
                var quantity = parseFloat($(this).val());
                totalQuantity += isNaN(quantity) ? 0 : quantity;

                var unitPrice = parseFloat($(this).data('unit-price')); // Replace with your actual unit price data
                grandTotal += isNaN(quantity) || isNaN(unitPrice) ? 0 : (quantity * unitPrice);
            });

            $('#total_amount').val(totalQuantity);
            updateRemainingAmount();
        }

        $('#recieve_amount').on('input', updateRemainingAmount);

        function updateRemainingAmount() {
            var totalAmount = parseInt($('#total_amount').val());
            var receivedAmount = parseInt($('#recieve_amount').val());

            if (!isNaN(totalAmount) && !isNaN(receivedAmount)) {
                var remainingAmount = totalAmount - receivedAmount;
                $('#remain_amount').val(remainingAmount);
            }
        }
    });
</script>

    <x-footerscript/>
  </body>
</html>
