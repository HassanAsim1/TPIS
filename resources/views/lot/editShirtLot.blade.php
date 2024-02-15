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
    <form action="{{url('editShirtLotData')}}" method="POST">
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
					 required	name="shirtId"
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
					 required	name="created_by"
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
					<label for="" class="form-label">Select Master</label>
          <select class="form-select" name="lotMaster" id="fabricLot" required>
            <option value='{{$shirtLot->fabricId}}'>{{$shirtLot->fabricId}}</option>
            @foreach($masters as $master)
              <option value='{{$master->user_id}}'><strong>{{$master->user_id}}</strong>/ {{$master->name}}</option>
            @endforeach
        </select>
				</div>
        <div class="col-sm-4">
          <label for="" class="form-label">Select Fabric</label>
          <select class="form-select" name="fabricId" id="fabricLot" required>
            <option value='{{$shirtLot->fabricId}}'>{{$shirtLot->fabricId}}</option>
            @foreach($fabricData as $fabric)
              <option value='{{$fabric->fabricId}}'><strong>{{$fabric->fabricId}}</strong>/ {{$fabric->fabricName}}</option>
            @endforeach
            <script>
              $('#fabricLot').on('change',function(){
                  let FabVal = $(this).val();
                  $('#fabric_rate').val(FabVal);
              })
            </script>
        </select>
        </div>
        <div class="col-sm-4">
            <label for="" class="form-label">Total Yard</label>
            <input type="number" class="form-control" required name="fabricYard" value="{{$shirtLot->fabricYard}}" placeholder="Total Yard"/>
        </div>
        <div class="col-md-4">
          <label for="" class="form-label">Lot Number</label>
              <input type="text" class="form-control" required name="lotNumber" placeholder="Lot Number" value="{{$shirtLot->lotNumber}}" />
          </div>
			</div>
		</div>
		<hr class="mt-4">
    {{-- @php $count = 0 @endphp
    @foreach($lotdata as $lot) --}}
                          <div id="addnewrow">
                            @foreach($shirtLotData as $shirt)
                            <div class="row mb-2">
                                <div class="col-sm-2">
                                  <select required name="suserId[]" class="form-control">
                                    <option value="{{$shirt->userId}}">{{getName($shirt->userId)}}</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->user_id}}">{{$employee->user_id}} / {{$employee->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" required name="sdes[]" id="basic-default-company" value="{{$shirt->description}}" placeholder="Description"/>
                                </div>
                                <div class="col-sm-2">
                                <input type="text" class="form-control tquan" onkeydown="totalval(0)" id="squan0" name="squantity[]" value="{{$shirt->lot_quantity}}" placeholder="Quantity"/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control tGhazana" onkeyup="calculateTotalGhazana()" id="ghazana0" value="{{$shirt->lot_ghazana}}" name="sghazana[]" placeholder="Ghazana"/>
                                </div>
                                <div class="col-sm-2">
                                  <input type="color" class="form-control tsum" name="scolor[]" value="{{$shirt->lot_color}}" />
                                </div>
                                <div class="col-sm-2">
                                  @if($loop->last)
                                      <button type="button" class="btn btn-success btn-sm" id="add_row">Add Row</button>
                                  @else
                                      <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove Row</button>
                                  @endif
                              </div>
                              </div>
                            @endforeach
                            </div>
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Update Lot</button>
                              </div>
                              <div class="col-sm-3 mb-2">
                                <label class="col-form-label" for="basic-default-company">Total Ghazana :</label>
                                <input type="text" class="form-control" id="totalGhazana" name="totalGhazana"  value="{{$shirtLot->total_ghazana}}" placeholder="Total Ghazana" readonly/>
                                </div>
                              <div class="col-sm-3 mb-2">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" name="total_quantity" placeholder="Total Quantity" value="{{$shirtLot->lot_quantity}}" readonly/>
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
      $(document).ready(function () {
          var count = 0;
          $('#add_row').click(function () {
              count++;
              $('#addnewrow').append(`<div class="row" style="margin-top:10px;">
                                          <div class="col-sm-2">
                                            <select required name="suserId[]" class="form-control">
                                              <option value="{{$shirt->userId}}">{{getName($shirt->userId)}}</option>
                                              @foreach($employees as $employee)
                                              <option value="{{$employee->user_id}}">{{$employee->user_id}} / {{$employee->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-sm-2">
                                              <input type="text" class="form-control" required name="sdes[]" id="basic-default-company" placeholder="Description"/>
                                          </div>
                                          <div class="col-sm-2">
                                              <input type="text" class="form-control tquan" onkeyup="totalval(${count})" id="squan${count}" required name="squantity[]" placeholder="Quantity"/>
                                          </div>
                                          <div class="col-sm-2">
                                              <input type="text" class="form-control tGhazana" onkeyup="calculateTotalGhazana()" id="ghazana${count}" required name="sghazana[]" placeholder="Ghazana"/>
                                          </div>
                                          <div class="col-sm-2">
                                              <input type="color" class="form-control tsum" required name="scolor[]" value="#3498db" />
                                          </div>
                                          <div class="col-sm-2">
                                              <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove Row</button>
                                          </div>
                                      </div>`);
          });
  
          $(document).on('click', '.btn-danger', function (e) {
              e.preventDefault();
              let row_item = $(this).parent().parent();
              $(row_item).remove();
              OnRemoveSum();
          })
      });
  
      function totalval(id) {
          $('#squan' + id).on('keyup', function () {
              let quan = $(this).val();
              $('#stotal' + id).val(quan);
              calculateTotal();
          });
      }
  
      // function totalGhazana() {
      //     $('#ghazana' + id).on('keyup', function () {
      //         calculateTotalGhazana();
      //     });
      // }
  
      function calculateTotal() {
          var sum = 0;
          $('.tquan').each(function () {
              sum += Number($(this).val());
          });
          $('#totalquan').val(sum);
      }
  
      function calculateTotalGhazana() {
          var sumGhanaza = 0;
          $('.tGhazana').each(function () {
              sumGhanaza += Number($(this).val());
          });
          $('#totalGhazana').val(sumGhanaza);
      }
  
      function OnRemoveSum() {
          calculateTotal();
          calculateTotalGhazana();
      }
  
      function removeRow(btn) {
          var row = btn.parentNode.parentNode;
          row.parentNode.removeChild(row);
          OnRemoveSum();
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

    <x-footerscript/>
  </body>
</html>
