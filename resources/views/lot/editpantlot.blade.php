
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Lot</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- FORM TRIGGER -->
            <form action="{{url('add_pant_lot')}}" method="POST">
                @csrf
                            <div class="card mt-2">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Edit Lot</h5>
                              </div>

                              <div class="container-xxl flex-grow-1 container-p-y mt-2">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Name</label>
                                    <select class="form-select" name="name" id="">
                                        <option value="{{$data->lot_name}}" selected>{{$data->lot_name}}</option>
                                        <option value="fashion">Fashion</option>
                                        <option value="simple">Simple</option>
                                    </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Lot Fabric
                                    </label>
                                    <select class="form-select" name="fabricid" id="fabricLot">
                                    <option selected value='{{$data->fabricId}}'><strong>{{$data->fabricId}}</option>
                                        @foreach($FabData as $fabric)
                                          <option value='{{$fabric->rate}}'><strong>{{$fabric->fabricId}}</strong>/ {{$fabric->fabric_name}}</option>
                                        @endforeach
                                        <script>
                                          $('#fabricLot').on('change',function(){
                                              let FabVal = $(this).val();
                                              $('#fabric_rate').val(FabVal);
                                          })
                                        </script>
                                    </select>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Fabric Rate
                                    </label>
                                    <input type="text" id="fabric_rate" name="fabric_rate" class="form-control" value="{{getfabricrate($data->fabricId)}}" readonly/>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Quantity</label>
                                    <input type="text" id="Quantity" name="quantity" class="form-control" value="{{$data->lot_quantity}}" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Remaining Quantity</label>
                                    <input type="text" id="Remain_Quantity" name="remain_quantity" class="form-control" value="{{$data->lot_remain}}" readonly/>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Lot Size
                                    </label>
                                    <select class="form-control muliple-select" style="border:2px;" name="size[]" id="multi-search" multiple>
                                    @php
                                    $size = json_decode($data->lot_size);
                                    @endphp
                                    @foreach((array) $size as $lotsize)
                                    @if($lotsize == '18 to 20')
                                    <option selected value="18 to 20">18 to 20</option>
                                    @else
                                    <option value="18 to 20">18 to 20</option>
                                    @if($lotsize == '20 to 22')
                                    <option selected value="20 to 22">20 to 22</option>
                                    @else
                                    <option value="20 to 22">20 to 22</option>
                                    @if($lotsize == '22 to 24')
                                    <option selected value="22 to 24">22 to 24</option>
                                    @else
                                    <option value="22 to 24">22 to 24</option>
                                    @if($lotsize == '24 to 26')
                                    <option selected value="24 to 26">24 to 26</option>
                                    @else
                                    <option value="24 to 26">24 to 26</option>
                                    @if($lotsize == '26 to 28')
                                    <option selected value="26 to 28">26 to 28</option>
                                    @else
                                    <option value="26 to 28">26 to 28</option>
                                    @endif @endif @endif @endif @endif
                                    @endforeach
                                        <option value="28 to 30">28 to 30</option>
                                        <option value="30 to 32">30 to 32</option>
                                        <option value="32 to 34">32 to 34</option>
                                        <option value="34 to 36">34 to 36</option>
                                        <option value="36 to 38">36 to 38</option>
                                    </select>
                                    <!-- <script>
                                      $('#multi-search').on('change',function(){
                                        if(($('#multi-search').val()) == 0){
                                          $('#SizeSelect').css('display','none');
                                        }
                                        else{
                                          $('#SizeSelect').css('display','block');
                                        }
                                      })
                                    </script> -->
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Lot Master</label>
                                    <select class="form-control" name="master" readonly>
                                    @if(session()->has('email'))
                                    <option value="{{session('master_id')}}">{{session('name')}} / {{session('master_id')}}</option>
                                    @endif
                                    </select>
                                  </div>
                                </div>
                                <div id="SizeSelect" style="display:block;">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Damage pcs</label>
                                    <input type="text" id="damage" name="damage" class="form-control" value="{{$data->damage_pcs}}" placeholder="Damage"/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">CM
                                    </label>
                                    <input type="text" id="lot_cm" name="lot_cm" class="form-control" value="{{$data->lot_cm}}" placeholder="Enter Lot CM"/>
                                  </div>
                                  
                                  <script>
                                    $('#lot_cm').on('keyup',function(){
                                        var lotsize = $('#multi-search').val();
                                        var fabricRate = ($('#fabric_rate').val()) / 100;
                                        var lotcm = $('#lot_cm').val();
                                        var lotcost = fabricRate*(lotcm / lotsize.length) + 146;
                                        $('#cost_price').val(lotcost);
                                        var getcost = $('#cost_price').val();
                                        var fashionCost = parseInt(getcost) + parseInt($('#fcost').val()) + parseInt($('#mcost').val()) + parseInt($('#beltclip').val());
                                        $('#cost_price').val(fashionCost);
                                        $('#sale_price').val(fashionCost + 50);
                                        // if(lotcm == ''){
                                        //   $('#CostRow').css('display','none');
                                        // }
                                        // else{
                                        //   $('#CostRow').css('display','block');
                                        // }
                                    })
                                  </script>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Cost Price</label>
                                    <input type="text" id="cost_price" name="cost_price" class="form-control" value="{{$data->cost_price}}" placeholder="Cost" readonly/>
                                  </div>
                                </div>
                                </div>
                                <div id="CostRow" style="display:block;">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Fashion Cost</label>
                                    <input type="number" id="fcost" name="fcost" class="form-control" value="{{$data->fcost}}" placeholder="Cost"/>
                                    <script>
                                      $('#fcost').on('keyup',function(){
                                        var lotsize = $('#multi-search').val();
                                        var fabricRate = ($('#fabric_rate').val()) / 100;
                                        var lotcm = $('#lot_cm').val();
                                        var lotcost = fabricRate*(lotcm / lotsize.length) + 146;
                                        $('#cost_price').val(lotcost);
                                        var getcost = $('#cost_price').val();
                                        var fashionCost = parseInt(getcost) + parseInt($('#fcost').val()) + parseInt($('#mcost').val()) + parseInt($('#beltclip').val());
                                        $('#cost_price').val(fashionCost);
                                        $('#sale_price').val(fashionCost + 50);
                                      })
                                    </script>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Muratray</label>
                                    <input type="number" id="mcost" name="muratary" class="form-control" value="{{$data->mcost}}" placeholder="Cost"/>
                                  </div>
                                  <script>
                                      $('#mcost').on('keyup',function(){
                                        var lotsize = $('#multi-search').val();
                                        var fabricRate = ($('#fabric_rate').val()) / 100;
                                        var lotcm = $('#lot_cm').val();
                                        var lotcost = fabricRate*(lotcm / lotsize.length) + 146;
                                        $('#cost_price').val(lotcost);
                                        var getcost = $('#cost_price').val();
                                        var fashionCost = parseInt(getcost) + parseInt($('#fcost').val()) + parseInt($('#mcost').val()) + parseInt($('#beltclip').val());
                                        $('#cost_price').val(fashionCost);
                                        $('#sale_price').val(fashionCost + 50);
                                      })
                                    </script>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Belt / Clip 
                                    </label>
                                    <input type="number" id="beltclip" name="beltclip" class="form-control" value="{{$data->beltclip}}" placeholder="Cost"/>
                                  </div>
                                  <script>
                                      $('#beltclip').on('keyup',function(){
                                        var lotsize = $('#multi-search').val();
                                        var fabricRate = ($('#fabric_rate').val()) / 100;
                                        var lotcm = $('#lot_cm').val();
                                        var lotcost = fabricRate*(lotcm / lotsize.length) + 146;
                                        $('#cost_price').val(lotcost);
                                        var getcost = $('#cost_price').val();
                                        var fashionCost = parseInt(getcost) + parseInt($('#fcost').val()) + parseInt($('#mcost').val()) + parseInt($('#beltclip').val());
                                        $('#cost_price').val(fashionCost);
                                        $('#sale_price').val(fashionCost + 50);
                                      })
                                    </script>
                                </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Sale Price</label>
                                    <input type="text" id="sale_price" name="sale_price" class="form-control" value="{{$data->sale_price}}" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Status</label>
                                    <select class="form-control" style="border:2px;" name="status[]" id="lottrack" multiple>
                                        <option id="cutroom" value="1">Cutting Room</option>
                                        <option id="kadi" value="2">Kadi</option>
                                        <option id="singer" value="3">Singer</option>
                                        <option id="fido" value="4">Fido</option>
                                        <option id="safti" value="5">Safti</option>
                                        <option id="thokamori" value="6">Thoka/Mori</option>
                                        <option id="washing" value="7">Washing</option>
                                        <option id="clipping" value="8">Clipping</option>
                                        <option id="ribbtn" value="9">Rib Button</option>
                                        <option id="press" value="10">Press</option>
                                        <option id="packing" value="11">Packing</option>
                                        <option id="complete" value="12">Complete</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  @if($data->kadi == 1)
                                  <div class="col-md-2">
                                    <div class="form-check form-switch mt-4">
                                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked />
                                      <label class="form-check-label" for="flexSwitchCheckDefault"
                                        >Kadi</label
                                      >
                                    </div>
                                  </div>
                                  @else
                                  <div class="col-md-2">
                                    <div class="form-check form-switch mt-4">
                                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" />
                                      <label class="form-check-label" for="flexSwitchCheckDefault"
                                        >Kadi</label
                                      >
                                    </div>
                                  </div>
                                  @endif
                                  @if($data->rib == 0)
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="rib" id="RibLot" checked/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Rib Lot</label
                                    >
                                  </div>
                                </div>
                                @else
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="rib" id="RibLot"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Rib Lot</label
                                    >
                                  </div>
                                </div>
                                @endif
                                @if($data->outoffactory == 1)
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="outoffactory" id="outoffactory" checked/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Out of Factory</label
                                    >
                                  </div>
                                </div>
                                @else
                                <div class="col-md-2">
                                  <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="outoffactory" id="outoffactory"/>
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                      >Out of Factory</label
                                    >
                                  </div>
                                </div>
                                @endif
                              </div>
                              <div class="modal-footer">
                                <a href="{{url('pantlot')}}"></a><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button></a>
                                <button type="submit" class="btn btn-primary">Add Lot</button>
                              </div>
                            </div>
                          </div>
                        </div>
                </form>
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
        
    </script>
    
    <x-footerscript/>
  </body>
</html>
