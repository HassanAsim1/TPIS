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
    <form action="{{url('updateInvoice')}}" method="POST">
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
						value="{{$invoiceId->invoice_id}}"
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
                        <option value="{{$invoiceId->partie_id}}" data-subtext="{{$invoiceId->partie_id}}">{{getpartiename($invoiceId->partie_id)}} / {{$invoiceId->partie_id}}</option>
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
					<select class="form-control" name="bill_type" required>
                        <option value="{{$invoiceId->bill_type}}">{{$invoiceId->bill_type}}</option>
						<option value="pant_bill">Pant Bill</option>
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
							<p>Owner Jeans<br>c/o Mubashir Hussain</br>Contact #: 0324-9841973<br></p>
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
                          @php $count = 0; @endphp

                            @foreach($invoiceIdData as $lot)
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="slot[]" value="{{$lot->lot_id}}" placeholder="Lot ID" required/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="sdes[]" value="{{$lot->description}}" id="basic-default-company" placeholder="Description" required/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control tquan" id="squan{{$count}}" onkeydown="totalval({{$count}})" name="squantity[]" value="{{$lot->quantity}}" placeholder="Quantity" required/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" onkeydown="totalval({{$count}})" id="srate{{$count}}" value="{{$lot->rate}}" name="srate[]" placeholder="Rate" required/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control tsum" id="stotal{{$count}}" name="stotal[]" value="{{$lot->total}}" placeholder="Total" readonly required/>
                                    </div>
                                    @if($count == 0)
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-success" id="add_row">Add Row</button>
                                    </div>
                                    @else
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger" id="remove_row">Remove Row</button>
                                    </div>
                                    @endif
                                </div>
                                @php $count++ @endphp
                            @endforeach
                            </div>
                            
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Update Invoice</button>
                                @if(session()->has('invoiceNumber'))
                                  <button type="button" class="btn btn-secondary" onclick="window.open('{{ route('printBillInvoice', ['invoice_id' => session('invoiceNumber')]) }}', '_blank');">Generate Previous Invoice</button>
                                @endif
                              </div>
                              <div class="col-sm-3 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" name="total_quantity" value="{{$invoiceId->total_pcs}}" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-3 mb-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="number" class="form-control stotal" id="grandtotal" name="grandtotal" value="{{$invoiceId->grand_total}}" placeholder="Grand Total" readonly/>
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
  var count = 0;
  $('#add_row').click(function(){
    count++
    // e.preventDefault();
    $('#addnewrow').append(`<div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="slot[]" placeholder="Lot ID" required/>
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
  });
  $(document).on('click', '.btn-danger', function (e) {
    e.preventDefault();
    $(this).closest('.row').remove();
    calculateTotal(); // Call total calculation here
  });
  function calculateTotal() {
    var sum = 0;
    var sumquan = 0;
    $('.tsum').each(function() {
      sum += Number($(this).val());
    });
    $('#grandtotal').val(sum);

    $('.tquan').each(function() {
      sumquan += Number($(this).val());
      $('#totalquan').val(sumquan);
    });
  }

  // Calculate totals initially
  calculateTotal();
  
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
        $('#srate' + id).on('input', function () {
            let quan = $('#squan' + id).val();
            let rate = $(this).val();
            let total = quan * rate;
            $('#stotal' + id).val(total);
            OnRemoveSum(); // Call total calculation here
        });

        $('#squan' + id).on('input', function () {
            let quan = $(this).val();
            let rate = $('#srate' + id).val();
            let total = quan * rate;
            $('#stotal' + id).val(total);
            OnRemoveSum(); // Call total calculation here
        });
    }
    </script>
    <script>
      $('#parties_id').on('change',function(){
        var partie_id = $('#parties_id').val();
        $.ajax({
          type:'GET',
          url:'/getpartiesdetails/'+partie_id,
          success(data){
            $('#partie_address').empty();
            $('#partie_address').append(`<p>`+data.name+`<br>c/o `+data.address+`</br>Contact #: `+data.phone_no+`<br></p>`);
          }
        })
      })
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
