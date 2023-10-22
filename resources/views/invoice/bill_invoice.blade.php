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
  @if(session()->has('msg'))
          <div class="alert alert-success alert-dismissible" role="alert">
                  {{session('msg')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @php session()->pull('msg') @endphp
          @endif
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
					<select class="form-control" name="bill_type" required>
            <option value="">Select</option>
						<option value="pant_bill">Pant Bill</option>
						<option value="shirt_bill">Shirt Bill</option>
            <option value="fabric_bill">Fabric Bill</option>
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
							<p>Owner Jeans<br>c/o Mubashir Hussain</br>Contact #: 0324-9841972<br></p>
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
    {{-- @php $count = 0 @endphp
    @foreach($lotdata as $lot) --}}
                          <div id="addnewrow">
                              <div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="slot[]" placeholder="Lot ID" required/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" required/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" id="squan0" name="squantity[]" placeholder="Quantity" required/>
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
                            {{-- <div class="row" style="margin-top:10px;">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control mt-2" name="slot[]" value="{{$lot->lot_id}}" placeholder="Lot ID" readonly/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control mt-2" name="sdes[]" value="{{count((array)json_decode($lot->lot_size))}}" placeholder="Description" readonly/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control mt-2 tquan" id="squan{{$count}}" value="{{$lot->lot_remain}}" name="squantity[]" placeholder="Quantity"/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control mt-2" onkeydown="totalval('{{$count}}')" id="srate{{$count}}" name="srate[]" placeholder="Rate"/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control mt-2 tsum" id="stotal{{$count}}" name="stotal[]" placeholder="Total" readonly/>
                                </div>
                                <div class="col-sm-2">
                                  <button type="button" class="btn btn-danger mt-2" id="remove_row">Remove Row</button>
                                </div>
                              </div>
                              @php $count++ @endphp
                              @endforeach --}}
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Add Invoice</button>
                                <!-- <button type="button" id="printButton" class="btn btn-primary">Print</button> -->
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
        const printButton = document.getElementById('printButton');
        printButton.addEventListener('click', () => {
            window.print();
        });
    </script>

    <x-footerscript/>
  </body>
</html>
