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
    <x-alert />
	<div class="content-wrapper" style="padding: 20px;">
	<div class="card">
		<div class="card-body invoice-padding pb-0">
    <form action="{{url('addRollData')}}" method="POST">
      @csrf
			<div class="row d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
				<div class="col-md-3">
					<div class="logo-wrapper">
						<h3 class="text-primary">TPIS</h3>
						<p>This is Textile Production and Inventory System Created By <strong>University of Lahore</strong> & <strong>Reownlogics</strong></p>
					</div>
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
		<div>
			<div class="row row_fuild">
                <div class="col-md-4">
					<label for="" class="form-label">Partie Id</label>
					<select class="form-control" name="partie_id" id="parties_id" required>
                        <option value=""> -- Select --</option>
						@foreach($partie as $parties)
							@if($parties->status == 'active')
							<option value="{{$parties->partie_id}}" data-subtext="{{$parties->partie_id}}">{{$parties->name}} / {{$parties->partie_id}}</option>
							@endif
							@if($parties->status == 'disable')
							<option data-subtext="{{$parties->partie_id}}" disabled="disabled">{{$parties->name}}</option>
							@endif
						@endforeach 
					</select>
				</div>
				<div class="col-md-4">
					<label for="" class="form-label">Total Roll Meter</label>
					<input type="text" class="form-control" name="rollTotalMeter">
				</div>
				<div class="col-md-4">
				<label for="" class="form-label">Roll Rate</label>
					<input type="text" class="form-control" name="rollRate">
				</div>
			</div>
      <div class="row row_fuild">
          <div class="col-md-4">
            <label for="" class="form-label">Gate Pass # (Optional)</label>
            <input type="text" class="form-control" name="gatePass">
          </div>
				<div class="col-md-4">
					<label for="" class="form-label">Bilty No (Optional)</label>
					<input type="text" class="form-control" name="biltyNo">
				</div>
				<div class="col-md-4">
				  <label for="" class="form-label">Date</label>
					<input type="date" class="form-control" name="date">
				</div>
			</div>
      <div class="row row_fuild">
          <div class="col-md-4">
            <label for="" class="form-label">Driver Name (Optional)</label>
            <input type="text" class="form-control" name="driverName">
          </div>
				<div class="col-md-4">
					<label for="" class="form-label">DC # (Optional)</label>
					<input type="text" class="form-control" name="dcNumber">
				</div>
				<div class="col-md-4">
          <label for="" class="form-label">No of Roll</label>
          <input type="text" class="form-control" id="noOfRollsField" name="noOfRolls" readonly>
			</div>
		</div>
		<hr class="mt-4">
		<div>
			<div class="row">
				<div class="col-md-6">
					<h1>To</h1>
						<address>
							<p>Owner Jeans<br>c/o Mubashir Hussain</br>Contact #: 0324-9841973<br></p>
						</address>
				</div>
				<div class="col-md-6">
					<h1>From</h1>
						<address id="partie_address">
						</address>
				</div>
			</div>
		</div>
		<hr class="mt-4">
                          <div id="addnewrow">
                              <div class="row rowCount" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="rollSubId[]" placeholder="Roll ID" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" onkeydown="totalval(0)" id="squan0" name="squantity[]" placeholder="Quantity" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control srate" onkeydown="totalval(0)" id="srate0" name="srate[]" placeholder="Rate" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control tsum" id="stotal0" name="stotal[]" placeholder="Total" readonly required/>
                                </div>
                                <div class="col-sm-2">
                                  <button type="button" class="btn btn-success" id="add_row">Add Row</button>
                                </div>
                              </div>
                            </div>
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Add Roll</button>
                                @if(session()->has('invoiceNumber'))
                                  <button type="button" class="btn btn-secondary" onclick="window.open('{{ route('printBillInvoice', ['invoice_id' => session('invoiceNumber')]) }}', '_blank');">Generate Previous Invoice</button>
                                @endif
                              </div>
                              <div class="col-sm-3 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" name="totalRollQuantity" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-3 mb-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="number" class="form-control stotal" id="grandtotal" name="totalAmount" placeholder="Grand Total" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <!-- <input type="text" class="form-control stotal" id="stotal" name="stotal[]" placeholder="Total" readonly/> -->
                              </div>
                            </div>
                          </div>
                      </form>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

	<script>
$(document).ready(function(){
  updateRowCount();
  var count = 0;
  $('#add_row').click(function(){
    count++
    // e.preventDefault();
    $('#addnewrow').append(`<div class="row rowCount" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="rollSubId[]" placeholder="Roll ID" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control onkeydown=totalval(`+count+`) tquan" id="squan`+count+`"  name="squantity[]" placeholder="Quantity" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control srate" onkeydown=totalval(`+count+`) id="srate`+count+`" name="srate[]" placeholder="Rate" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control tsum" id="stotal`+count+`" name="stotal[]" placeholder="Total" readonly required/>
                                </div>
                                <div class="col-sm-2">
                                  <button type="button" class="btn btn-danger remove_row" id="remove_row">Remove Row</button>
                                </div>
                              </div>`);
                              updateRowCount();
  });
  $(document).on('click', '.remove_row', function (e) {
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
    updateTotals(); // Update totals when a row is removed
    updateRowCount();
  });

  // Add an oninput event handler to quantity and rate input fields within the dynamically added rows
  $(document).on('input', '.tquan, .srate', function () {
    updateSubTotal($(this));
    updateTotals();
  });

  // Calculate and update sub-total for a row
  function updateSubTotal(inputField) {
    var row = inputField.closest('.row');
    var quantity = parseFloat(row.find('.tquan').val()) || 0; // Ensure it's a number, default to 0
    var rate = parseFloat(row.find('.srate').val()) || 0; // Ensure it's a number, default to 0
    var subTotal = quantity * rate;
    row.find('.tsum').val(subTotal);
  }

  // Calculate and update totals
  function updateTotals() {
    var sum = 0;
    var sumquan = 0;

    // Calculate the sum of subtotals
    $('.tsum').each(function () {
        var value = parseFloat($(this).val()) || 0; // Ensure it's a number, default to 0
        sum += value;
    });

    // Calculate the sum of quantities
    $('.tquan').each(function () {
        var value = parseFloat($(this).val()) || 0; // Ensure it's a number, default to 0
        sumquan += value;
    });

    // Update the grand total and total quantity fields
    $('#grandtotal').val(sum);
    $('#totalquan').val(sumquan);
  }
  function updateRowCount() {
    var rowCount = $('.rowCount').length;
    $('#noOfRollsField').val(rowCount); // Update the No of Roll field with row count
  }
  $('input[name="rollRate"]').on('input', function() {
          const newRate = parseFloat($(this).val()) || 0;
          $('.srate').val(newRate);
          // // Optionally, trigger the total calculation function for each srate input field
          // $('.srate').each(function() {
          //   totalval($(this));
          // });
          updateTotals();
        });

  // Initialize totals when the page loads
  updateTotals();
});
    </script>
    <script>
      $('#parties_id').on('change',function(){
        var partie_id = $('#parties_id').val();
        $.ajax({
          type:'GET',
          url:'getpartiesdetails/'+partie_id,
          success(data){
            $('#partie_address').empty();
            $('#partie_address').append(`<p>`+data.name+`<br>c/o `+data.address+`</br>Contact #: `+data.phone_no+`<br></p>`);
          }
        })
      })
    </script>
    <script>
      $(document).ready(function() {
       
      });
    </script>
    <x-footerscript/>
  </body>
</html>
