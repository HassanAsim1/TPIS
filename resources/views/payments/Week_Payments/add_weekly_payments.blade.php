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
	<div class="content-wrapper" style="padding: 20px;">
  @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
                  {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          @endif
	<div class="card">
		<div class="card-body invoice-padding pb-0">
    <form action="{{url('weekly_payments')}}" method="POST" id="weeksubmit">
      @csrf
			<div class="row d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
				<div class="col-md-3">
					<div class="logo-wrapper">
						<h3 class="text-primary">TPIS</h3>
						<p>This is Textile Production and Inventory System Created By <strong>University of Lahore</strong> & <strong>Reownlogics</strong></p>
					</div>
				</div>
				<div class="col-md-4">
					<h3 class="text">Week ID</h3>
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
                                  <input type="text" class="form-control mt-2" value="{{getname($employee->user_id)}}" name="name[]" placeholder="EMP NAME" readonly/>
                                </div>
                                <div class="col">
                                  @if(cal_employee_amount($employee->user_id) >= 299)
                                  <input type="text" class="form-control mt-2 tquan" id="squan{{$count}}" value="{{cal_employee_amount($employee->user_id)}}" name="debit[]" placeholder="debit" required/>
                                  @else
                                  <input type="text" class="form-control mt-2 tquan" id="squan{{$count}}" value="{{getSalary($employee->user_id)}}" name="debit[]" placeholder="debit" required/>
                                  @endif
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control mt-2 signature-input" name="signature[]" placeholder="Signature" required/>
                                </div>
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
                                <button type="submit" class="btn btn-primary">Add WPAY</button>
                                <button type="button" id="printButton" class="btn btn-primary">Print</button>
                                <button type="button" class="btn btn-primary" id="openSignatureModal">Enter Signature</button>
                              </div>
                              <div class="col-sm-2 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Amount:</label>
                              <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-2 mb-3">
                                <label class="col-form-label" for="basic-default-company">Recieved Amount:</label>
                                <input type="number" class="form-control stotal" id="recieve_amount" name="recieved_amount" placeholder="Recieve Amount" required/>
                              </div>

                              <div class="col-sm-2 mb-3">
                                <label class="col-form-label" for="basic-default-company">Remaining Amount:</label>
                                <input type="text" class="form-control" id="remain_amount" name="remaining_amount" placeholder="Recieve Amount" readonly />
                              </div>
                            </div>
                          </div>
                      </form>



                      <!-- Modal -->
                      <div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Enter Your Name and Signature</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="nameInput">Name:</label>
                                <input type="text" class="form-control" id="nameInput" placeholder="Your Name">
                              </div>
                              <div class="form-group">
                                <label for="signatureInput">Signature:</label>
                                <textarea class="form-control" id="signatureInput" rows="4" placeholder="Your Signature"></textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                            </div>
                          </div>
                        </div>
                      </div>

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

                    <script>
                      $(document).ready(function() {
                        $('#openSignatureModal').click(function() {
                          $('#signatureModal').modal('show');
                        });

                        $('#confirmButton').click(function() {
                          // Get user-entered name and signature values
                          var userName = $('#nameInput').val();
                          var userSignature = $('#signatureInput').val();
                          $('.signature-input').each(function(index) {
                            $(this).val(userSignature);
                          });

                          $('#signatureModal').modal('hide');
                        });
                      });
                    </script>

<script>
  $(document).ready(function () {
    // ... your existing code ...

    $('#weeksubmit').submit(function (event) {
      // Prevent the form from submitting by default
      event.preventDefault();

      // Validate "debit" input fields
      var hasNegativeValue = false;
      $('.tquan').each(function () {
        var inputValue = parseFloat($(this).val());
        if (isNaN(inputValue) || inputValue < 0) {
          hasNegativeValue = true;
          return false; // Exit the loop if a negative value is found
        }
      });

      // If a negative value is found, display an error message
      if (hasNegativeValue) {
        alert('Please enter positive values in the "debit" fields.');
      } else {
        // No negative values found, submit the form
        $(this).unbind('submit').submit(); // Unbind the event to avoid recursive validation
      }
    });

    // ... your existing code ...
  });
</script>



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

	<script>
    $(document).ready(function(){
      var count = 0;
      $('#add_row').click(function(){
        count++
        // e.preventDefault();
        $('#addnewrow').append(`<div class="row" style="margin-top:10px;">
                                    <div class="col">
                                      <input type="text" class="form-control mt-2" name="employee[]" placeholder="EMP-ID"/>
                                    </div>
                                    <div class="col">
                                      <input type="text" class="form-control mt-2" name="employee[]"  placeholder="Lot ID" />
                                    </div>
                                    <div class="col">
                                      <input type="text" class="form-control mt-2" name="sdes[]"  placeholder="Description" />
                                    </div>
                                    <div class="col">
                                    <input type="text" class="form-control mt-2 tquan" id="squan" name="squantity[]" placeholder="Quantity"/>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger mt-2 remove-row-btn" id="remove_row">Remove Row</button>
                                    </div>
                                  </div>`);
      });
      $(document).on('click','#remove_row',function(e){
          e.preventDefault();
          let row_item = $(this).parent().parent();
          $(row_item).remove();
          OnRemoveSum(this);
      })
    });
  </script>
<script>
  function OnRemoveSum(){
    var sum = 0;
          $('.tsum').each(function() {
              sum += Number($(this).val());
          });
          $('#grandtotal').val(sum);
          var sumquan = 0;
          $('.tquan').each(function() {
              sumquan += Number($(this).val());
              $('#totalquan').val(sumquan);
          });
  }

    </script>
<script>
    const printButton = document.getElementById('printButton');
    printButton.addEventListener('click', () => {
        window.print();
    });
</script>
    <x-footerscript/>
  </body>
</html>
