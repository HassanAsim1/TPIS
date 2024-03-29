
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
                    <li class="breadcrumb-item"><a href="{{url('pantlot')}}" style ="font-size:15px">Pant Lot</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Lot</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- FORM TRIGGER -->
            <form action="{{url('add_pant_lot')}}" method="POST">
                @csrf
                            <div class="card mt-2">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">View Lot</h5>
                              </div>

                              <div class="container-xxl flex-grow-1 container-p-y mt-2">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Name</label>
                                    <input type="text" id="Remain_Quantity" name="remain_quantity" class="form-control" value="{{$data->lot_name}}" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Lot Fabric
                                    </label>
                                    <input type="text" class="form-control" value="{{$data->fabricId}}" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Lot Number</label>
                                    <input type="text" class="form-control" value="{{$data->lotNumber}}" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Fabric Rate
                                    </label>
                                    <input type="text" class="form-control" value="{{getfabricrate('$data->fabricId')}}" readonly/>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Quantity</label>
                                    <input type="text" value="{{$data->lot_quantity}}" class="form-control" id="totalQuantity" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Remaining Quantity</label>
                                    <input type="text" class="form-control" value="{{$data->lot_remain}}" readonly/>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Lot Size
                                    </label>
                                    <select class="form-control muliple-select" style="border:2px;" name="size[]" id="multi-search" multiple>
                                        <option value="18 to 20">18 to 20</option>
                                        <option value="20 to 22">20 to 22</option>
                                        <option value="22 to 24">22 to 24</option>
                                        <option value="24 to 26">24 to 26</option>
                                        <option value="26 to 28">26 to 28</option>
                                        <option value="28 to 30">28 to 30</option>
                                        <option value="30 to 32">30 to 32</option>
                                        <option value="32 to 34">32 to 34</option>
                                        <option value="34 to 36">34 to 36</option>
                                        <option value="36 to 38">36 to 38</option>
                                    </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Lot Master</label>
                                    <input type="text" class="form-control" value="{{$data->lot_master}}" readonly>
                                  </div>
                                </div>
                                <div id="SizeSelect" style="display:;">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Damage pcs</label>
                                    <input type="text" class="form-control" value="{{$data->damage_pcs}}" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">CM
                                    </label>
                                    <input type="text" value="{{$data->lot_cm}}" class="form-control" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Cost Price</label>
                                    <input type="text" value="{{$data->cost_price}}" class="form-control" readonly/>
                                  </div>
                                </div>
                                </div>
                                <div id="CostRow" style="display:;">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Fashion Cost</label>
                                    <input type="number" value="{{$data->fcost}}" class="form-control" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Muratray</label>
                                    <input type="number" value="{{$data->mcost}}" class="form-control" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Belt / Clip 
                                    </label>
                                    <input type="number" class="form-control" value="{{$data->beltclip}}" readonly/>
                                  </div>
                                </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Sale Price</label>
                                    <input type="text" value="{{$data->sale_price}}" class="form-control" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Status</label>
                                    <select class="form-select" name="status[]" disabled>
                                        @if($data->status == 1)
                                        <option id="cutroom" selected value="1">Cutting Room</option>
                                        @elseif($data->status == 2)
                                        <option id="cutroom" selected value="2">Kadhi</option>
                                        @elseif($data->status == 3)
                                        <option id="cutroom" selected value="3">Singer</option>
                                        @elseif($data->status == 4)
                                        <option id="cutroom" selected value="4">Fido</option>
                                        @elseif($data->status == 5)
                                        <option id="cutroom" selected value="5">Safety</option>
                                        @elseif($data->status == 6)
                                        <option id="cutroom" selected value="6">Batake</option>
                                        @elseif($data->status == 7)
                                        <option id="cutroom" selected value="7">Thoka / Mori</option>
                                        @elseif($data->status == 8)
                                        <option id="cutroom" selected value="8">Washing</option>
                                        @elseif($data->status == 9)
                                        <option id="cutroom" selected value="9">Clipping</option>
                                        @elseif($data->status == 10)
                                        <option id="cutroom" selected value="10">Rib Button</option>
                                        @elseif($data->status == 11)
                                        <option id="cutroom" selected value="11">Press</option>
                                        @elseif($data->status == 12)
                                        <option id="cutroom" selected value="12">Packing</option>
                                        @elseif($data->status == 13)
                                        <option id="cutroom" selected value="13">Complete</option>
                                        @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  @if($data->kadi == 1)
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled checked type="checkbox" id="flexSwitchCheckDefault" />
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Kadi</label
                                    >
                                  </div>
                                  </div>
                                  @else
                                  <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled type="checkbox" id="flexSwitchCheckDefault" />
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Kadi</label
                                    >
                                  </div>
                                  </div>
                                  @endif
                                  @if($data->rib == 1)
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled type="checkbox" checked name="rib" id="RibLot"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Rib Lot</label
                                    >
                                  </div>
                                </div>
                                @else
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled type="checkbox" name="rib" id="RibLot"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Rib Lot</label
                                    >
                                  </div>
                                </div>
                                @endif
                                @if($data->outoffactory == 1)
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled type="checkbox" checked name="outoffactory" id="outoffactory"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Out of Factory</label
                                    >
                                  </div>
                                </div>
                                @else
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" disabled type="checkbox" name="outoffactory" id="outoffactory"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Out of Factory</label
                                    >
                                  </div>
                                </div>
                                @endif
                              </div>
                              <div class="modal-footer">
                                <a><button type="button" data-toggle="modal" data-target="#imageModal" data-value="{{$data->lotNumber}}" class="btn btn-primary" onclick="updatePantLot()">Add Person</button></a>
                                <a href="{{url('pantlot')}}"><button type="button" class="btn btn-secondary">Back</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                </form>
                                      </div>


        <!-- The Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="imageModalLabel">Add Person</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{url('addPantLotDetails')}}" method="POST">
                      @csrf
                      <label for="">Pant Lot</label>
                      <input id="pantLotInput" name="pantLot" class="form-control" readonly/>
                      <label for="">Select Employee</label>
                      <select name="userId" class="form-select" required>
                          <option value=""> -- Select -- </option>
                          @foreach($employees as $employee)
                          <option value="{{$employee->user_id}}">{{$employee->name}}</option>
                          @endforeach
                      </select>
                      <label for="">Lot Size</label>
                      <select name="lotSize[]" class="form-select" id="lotSize" multiple required>
                          <option value=""> -- Select -- </option>
                          <?php
                          for ($i = 18; $i <= 45; $i += 2) {
                              $start = $i;
                              $end = $i + 2;
                              $optionValue = "$start to $end";
                              echo "<option value=\"$optionValue\">$optionValue</option>";
                          }
                          ?>
                          <option value="all">ALL</option>
                      </select>
                      <div class="row">
                          <div class="col-sm-6">
                              <label for="lotQuantity">Lot Quantity</label>
                              <input name="quantity" id="lotQuantity" class="form-control" oninput="calculateBundle()"/>
                          </div>
                          <div class="col-sm-6">
                              <label for="calculateLot">Quantity</label>
                              <input name="quantity" id="calculateLot" class="form-control" readonly/>
                          </div>
                      </div>
                      <label for="bundle">Bundle</label>
                      <input name="bundle" id="bundle" class="form-control" readonly/>
                  </form>
                  </div>
              </div>
          </div>
      </div>
             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script>
        $('document').ready(function(){
            $('#Quantity').on('change', function(){
                let quantity = $('#Quantity').val();
                $('#Remain_Quantity').val(quantity);
                $('#damage').val(0);
                $('#sale_price').val(0);
        })
        });
    </script>
    <script>
      document.getElementById('lotSize').addEventListener('change', calculateBundle);

      function calculateBundle() {
          var selectedLotSizes = $('#lotSize').val();
          var lotQuantity = $('#totalQuantity').val();
          if (selectedLotSizes && lotQuantity) {
              var totalLotSize = selectedLotSizes.length + 1;
              var bundleValue = lotQuantity / totalLotSize;
              $('#bundle').val(bundleValue.toFixed(2));
              $('#calculateLot').val(bundleValue.toFixed(2)); // Display the same value in "Quantity" field
          } else {
              $('#bundle').val('');
              $('#calculateLot').val('');
          }
      }

      function updatePantLot() {
          // Get the lot number from the button's data-value attribute
          var lotQuantity = $('#totalQuantity').val();
          $('#lotQuantity').val(lotQuantity);

          var lotNumber = document.querySelector('[data-target="#imageModal"]').getAttribute('data-value');
          document.getElementById('pantLotInput').value = lotNumber;

          calculateBundle(); // Call the function to update bundle when updating pant lot
      }
  </script>
    
    <x-footerscript/>
  </body>
</html>
