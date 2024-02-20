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
    <form action="{{url('bill_inv')}}" method="POST">
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
						name="invoice_id"
						value="{{$id}}"
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
		<div>
			<div class="row row_fuild">
				<div class="col-md-6">
					<label for="" class="form-label">Select Partie</label>
					<select class="form-control" name="partie_id" id="parties_id" required>
            <option value=""> -- Select --</option>
						@foreach($data as $parties)
							@if($parties->status == 'active')
							<option value="{{$parties->partie_id}}" data-subtext="{{$parties->partie_id}}">{{$parties->name}} / {{$parties->partie_id}}</option>
							@endif
							@if($parties->status == 'disable')
							<option data-subtext="{{$parties->partie_id}}" disabled="disabled">{{$parties->name}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-md-6">
				<label for="" class="form-label">Select Bill Type</label>
          <select class="form-control" name="bill_type" id="billTypeSelect" required>
              <option value="">Select</option>
              <option value="pant_bill">Pant Bill</option>
              <option value="Fabric Manual">Fabric Manual</option>
              <option value="shirt_bill">Shirt Bill</option>
              <option value="Fabric Bill">Fabric Bill</option>
              <option value="Pant & Shirt Bill">Pant & Shirt Bill</option>
          </select>
				</div>
			</div>
		</div>
		<hr class="mt-4">
		<div>
			<div class="row">
				<div class="col-md-6">
					<h1>From</h1>
						<address>
							<p>Owner Jeans<br>c/o Mubashir Hussain<br />Contact #: 0324-9841973<br></p>
						</address>
				</div>
				<div class="col-md-6">
					<h1>TO</h1>
						<address id="partie_address">
						</address>
				</div>
			</div>
		</div>
		<hr class="mt-4">
                          <div id="addnewrow">
                              <div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <div class="fabricFields">
                                      <input type="text" class="form-control lotInput" name="slot[]" placeholder="Lot ID"/>
                                      <span class="badge badge-success remainingQuantity mt-1 mb-1"></span>
                                  </div>
                                  <div class="fabricSelect" style="display: none;">
                                      <select class="form-control" name="slot[]" >
                                      <option value="">-- Select --</option>
                                      @foreach($fabric as $fabricLot)
                                        <option value="{{$fabricLot->fabricId}}" data-subtext="{{$fabricLot->fabricId}}">{{$fabricLot->fabricId}}</option>
                                      @endforeach
                                      </select>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" id="squan0" name="squantity[]" placeholder="Quantity" required/>
                                <span class="badge badge-danger remainingDanger mt-1 mb-1"></span>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" onkeydown="totalval(0)" id="srate0" name="srate[]" placeholder="Rate" required/>
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
                                <button type="submit" class="btn btn-primary">Add Invoice</button>
                                @if(session()->has('invoiceNumber'))
                                  <button type="button" class="btn btn-secondary" onclick="window.open('{{ route('printBillInvoice', ['invoice_id' => session('invoiceNumber')]) }}', '_blank');">Generate Previous Invoice</button>
                                @endif
                              </div>
                              <div class="col-sm-3 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" name="total_quantity" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-3 mb-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="number" class="form-control stotal" id="grandtotal" name="grandtotal" placeholder="Grand Total" readonly/>
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
  var currentBillType = $('#billTypeSelect').val();

  $('#billTypeSelect').change(function() {
    currentBillType = $(this).val();
    updateFabricFieldsVisibility();
  });

  function updateFabricFieldsVisibility() {
    if (currentBillType === 'Fabric Bill') {
      $('.fabricFields').hide();
      $('.fabricSelect').show();
      $('.fabricFields input[name="slot[]"]').remove(); // Remove the input fields
      // if ($('.fabricSelect input[name="slot[]"]').length === 0) {
      //   $('.fabricSelect').append(`<select class="form-control" name="slot[]" >
      //                                 <option value="">-- Select --</option>
      //                                 @foreach($fabric as $fabricLot)
      //                                   <option value="{{$fabricLot->fabricId}}" data-subtext="{{$fabricLot->fabricId}}">{{$fabricLot->fabricId}}</option>
      //                                 @endforeach
      //                                 </select>`);
      // }
    } else {
      $('.fabricSelect').hide();
      $('.fabricFields').show();
      $('.fabricSelect').remove();
      if ($('.fabricFields input[name="slot[]"]').length === 0) {
        $('.fabricFields').append('<input type="text" class="form-control" name="slot[]" placeholder="Lot ID"/>');
      }
    }
  }
  var count = 0;
  $('#add_row').click(function(){
    count++
    if (currentBillType === 'Fabric Bill'){
      $('#addnewrow').append(`<div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <div class="fabricSelect" style="display: none;">
                                      <select class="form-control" name="slot[]" required>
                                          <option value="">-- Select --</option>
                                          @foreach($fabric as $fabricLot)
                                            <option value="{{$fabricLot->fabricId}}" data-subtext="{{$fabricLot->fabricId}}">{{$fabricLot->fabricId}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" id="squan`+count+`"  name="squantity[]" placeholder="Quantity" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" onkeydown=totalval(`+count+`) id="srate`+count+`" name="srate[]" placeholder="Rate" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control tsum" id="stotal`+count+`" name="stotal[]" placeholder="Total" readonly required/>
                                </div>
                                <div class="col-sm-2">
                                  <button type="button" class="btn btn-danger" id="remove_row">Remove Row</button>
                                </div>
                              </div>`);
                              updateFabricFieldsVisibility();
    }
    else{
      $('#addnewrow').append(`<div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <div class="fabricFields" style="display: none;">
                                      <input type="text" class="form-control lotInput" name="slot[]" placeholder="Lot ID"/>
                                      <span class="badge badge-success remainingQuantity mt-1 mb-1"></span>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" id="squan`+count+`"  name="squantity[]" placeholder="Quantity" required/>
                                <span class="badge badge-danger remainingDanger mt-1 mb-1"></span>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" onkeydown=totalval(`+count+`) id="srate`+count+`" name="srate[]" placeholder="Rate" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control tsum" id="stotal`+count+`" name="stotal[]" placeholder="Total" readonly required/>
                                </div>
                                <div class="col-sm-2">
                                  <button type="button" class="btn btn-danger" id="remove_row">Remove Row</button>
                                </div>
                              </div>`);
                              updateFabricFieldsVisibility();
    }
    // e.preventDefault();
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
    // let totalsum = 0;
    function totalval(id){
      $('#srate'+id).on('keyup',function(){
        // let totalsum = 0;
        let quan = $('#squan'+id).val();
        let rate = $(this).val();
        let total = quan * rate;
        $('#stotal'+id).val(total);
          var sum = 0;
          $('.tsum').each(function() {
              sum += Number($(this).val());
          });
          $('#grandtotal').val(sum);
          var tquan = 0;
          $('.tquan').each(function() {
              tquan += Number($(this).val());
          });
          $('#totalquan').val(tquan);
      })
    $('#squan'+id).on('keyup',function(){
        let quan = $(this).val();
        let rate = $('#srate'+id).val();
        let total = quan * rate;
        $('#stotal'+id).val(total);
        var sum = 0;
          $('.tsum').each(function() {
              sum += Number($(this).val());
          });
          $('#grandtotal').val(sum);
          var sumquan = 0;
          $('.tquan').each(function() {
              sumquan += Number($(this).val());
          });
          $('#totalquan').val(sumquan);
    })
    }
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
        $(document).on('change', 'select[name="slot[]"]', function() {
        var selectedLotId = $(this).val();
        var currentRow = $(this).closest('.row');

        // Make an AJAX request to get quantity based on selectedLotId
        $.ajax({
            type: 'GET',
            url: 'getFabricLotQuantity/' + selectedLotId,
            success: function(response) {
                // Update the quantity field in the current row
                $(currentRow).find('.tquan').val(response);
                // Recalculate the total for the current row
                totalval(currentRow);
                OnRemoveSum();
            },
            error: function(error) {
                console.error('Error fetching quantity:', error);
            }
        });
    });
        // const printButton = document.getElementById('printButton');
        // printButton.addEventListener('click', () => {
        //     window.print();
        // });
    </script>

<script>
  $(document).ready(function() {
      $(document).on('input', '.lotInput, .tquan', function() {
          var lotNumber = $(this).closest('.row').find('.lotInput').val();
          var quantity = $(this).closest('.row').find('.tquan').val();
          var fabricFields = $(this).closest('.fabricFields');
          var successBadge = fabricFields.find('.badge-success');
          var dangerBadge = fabricFields.find('.badge-danger');
          var remainingQuantitySpan = fabricFields.find('.remainingQuantity');
  
          // Make an AJAX request to the backend to check remaining quantity
          $.ajax({
              url: '/checkRemainingQuantity', // Replace with your backend route
              method: 'GET',
              data: { lotNumber: lotNumber, quantity: quantity },
              success: function(response) {
                  var remainingQuantity = response.remainingQuantity;
                  var isQuantityAvailable = remainingQuantity >= 0;
  
                  remainingQuantitySpan.text('Remaining Quantity: ' + remainingQuantity);

                  // Update the badges and UI based on remaining quantity
                  if (isQuantityAvailable) {
                      successBadge.show();
                      dangerBadge.hide();
                  } else {
                      successBadge.hide();
                      dangerBadge.show();
                  }

                  // Show the fabricFields div after checking the lot
                  fabricFields.show();
              },
              error: function(error) {
                  console.error('Error checking remaining quantity:', error);
              }
          });
      });
  });
</script>

  <x-footerscript/>
</body>
</html>
