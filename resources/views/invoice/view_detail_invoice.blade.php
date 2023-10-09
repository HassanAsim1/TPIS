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
	<div class="card">
		<div class="card-body invoice-padding pb-0">
    <!-- <form action="#" method="POST"> -->
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
						value="{{$Invdata->invoice_id}}"
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
            value="{{$Invdata->created_by}}"
						autofocus
            readonly
						/>
				</div>
			</div>
		<hr class="mt-4">
		<div>
			<div class="row row_fuild">
				<div class="col-md-6">
					<label for="" class="form-label">Partie</label>
          <input type="text" class="form-control" value="{{$Invdata->partie_id}}" readonly/>
				</div>
				<div class="col-md-6">
				<label for="" class="form-label">Bill Type</label>
        <input type="text" class="form-control" value="{{$Invdata->bill_type}}" readonly/>
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
						<address>
						<p>Saad Garments<br>c/o Haji Shab</br>Contact #: 0324-9899809<br></p>
						</address>
				</div>
			</div>
		</div>
		<hr class="mt-4">
                          @foreach($data as $invoice)
                              <div class="row mt-2">
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" value="{{$invoice->lot_id}}" readonly/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" value="{{$invoice->description}}" readonly/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" id="squan0" value="{{$invoice->quantity}}" readonly/>
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" onkeydown="totalval(0)" id="srate0" value="{{$invoice->rate}}" readonly/>
                                </div>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control tsum" id="stotal0" value="{{$invoice->total}}" readonly/>
                                </div>
                              </div>
                            @endforeach
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <a href="{{route('view_invoice')}}"><button class="btn btn-Danger">Back</button></a>
                                <button type="button" id="printButton" class="btn btn-primary">Print</button>
                              </div>
                              <div class="col-sm-3 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" value="{{$Invdata->total_pcs}}" readonly/>
                              </div>
                              <div class="col-sm-3 mb-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="text" class="form-control stotal" id="grandtotal" value="{{$Invdata->grand_total}}" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <!-- <input type="text" class="form-control stotal" id="stotal" name="stotal[]" placeholder="Total" readonly/> -->
                              </div>
                            </div>
                          </div>
                      <!-- </form> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

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
    const printButton = document.getElementById('printButton');
    printButton.addEventListener('click', () => {
        window.print();
    });
</script>
    <x-footerscript/>
  </body>
</html>
