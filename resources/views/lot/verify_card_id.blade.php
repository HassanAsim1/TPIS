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
          <!-- Content wrapper -->
         
            <!-- Content -->
            <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{url('verify_card')}}">Verify Card</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data->card_id}}</li>
          </ol>
        </nav>
      </div>
    </div>
    @if($data->verify_card == 1)
              <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><span style ="font-size:15px">This Card # <strong>{{$data->card_id}}</strong>, is <span style="color:green">Verify<span></span></li>
                  </ol>
                </nav>
              </div>
            </div>
      @else
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-9 col-md-9 col-12 invoice-actions mt-md-0 mt-2">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Verify Card - {{getname($data->user_id)}}</h5>
                      <small class="text-muted float-end">Lot Section</small>
                    </div>
                    <div class="card-body">
                    <form action="{{url('adminverify')}}" method="POST">
                      @csrf
                      <input type="hidden" class="form-control form-control-sm" value="{{$data->card_id}}" name="card_id"/>
                        <div class="row mb-3">
                          <label class="col-sm-1 col-form-label" for="basic-default-name">User ID</label>
                          <div class="col-sm-11">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name" value="{{$data->user_id}}" name="user_id" readonly/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-1 col-form-label" for="basic-default-company">Card Type :</label>
                          <div class="col-sm-5">
                          <input type="text" class="form-control form-control-sm" id="basic-default-name" value="{{$data->card_type}}" name="card_type" readonly/>
                          </div>
                          <label class="col-sm-1 col-form-label" for="basic-default-company">Working Area :</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-company" name="working_area" value="{{$data->working_area}}" readonly/>
                          </div>
                        </div>
                        <hr />
                          <div id="addnewrow">
                            @php $count = 0 @endphp
                            @foreach($CardData as $lotcard)
                              <div class="row">
                                <div class="col-sm-2 mt-1">
                                {{-- <select class="form-control form-control-sm selectpicker border" id="lot_id" name="sname[]" data-live-search="true">
                                  <option value=""> -- Select Lot --</option>
                                    @foreach($lotdata as $lot)
                                      @if($lot->status == session('working_area'))
                                        <option value="{{$lot->lot_id}}" data-subtext="">{{$lot->lot_id}}</option>
                                      @endif
                                    @endforeach
                              </select> --}}
                              <input type="text" class="form-control form-control-sm" name="sname[]" id="basic-default-company" value="{{$lotcard->lot_id}}" />
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control form-control-sm" name="sdes[]" id="basic-default-company" value="{{$lotcard->description}}" placeholder="Description"/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                <input type="text" class="form-control form-control-sm tquan" id="squan{{$count}}" name="squantity[]" value="{{$lotcard->quantity}}" />
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control form-control-sm srate" onkeydown="totalval({{$count}})" value="{{$lotcard->rate}}" id="srate{{$count}}" name="srate[]" placeholder="Rate"/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control form-control-sm tsum" id="stotal{{$count}}" value="{{$lotcard->total}}" name="stotal[]" placeholder="Total" readonly/>
                                </div>
                                <!-- <div class="col-sm-2 mt-1">
                                  <button type="button" class="btn btn-success" id="add_row">Add Row</button>
                                </div> -->
                                <div class="col-sm-2 mt-1">
                                   <button type="button" class="btn btn-danger btn-sm" id="remove_row">Remove Row</button>
                                </div>
                              </div>
                              @php $count++ @endphp
                              @endforeach
                            </div>
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6 mt-5">
                                <button type="submit" class="btn btn-primary">Card Verify</button>
                               {{-- <label for="">Insert Rate</label>
                                <input type="checkbox" class="btn btn-primary" onclick="InsertRate({{session('fix_rate')}})" /> --}}
                              </div>
                              <div class="col-sm-3">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control form-control-sm" id="totalquan" name="total_quantity" value="{{$data->total_pcs}}" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="text" class="form-control form-control-sm stotal" id="grandtotal" name="grandtotal" value="{{$data->grand_total}}" placeholder="Grand Total" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <!-- <input type="text" class="form-control form-control-sm stotal" id="stotal" name="stotal[]" placeholder="Total" readonly/> -->
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                    <div class="card">
                      <section class="basic-custom-icons-tree">
                        <div class="row">
                          <div class="card-header">
                            <h6 class="card-title">Lot Info</h6>
                        </div>
                        <div class="card-body">
                            <div id="jstree-basic">
                                <ul>
                                    @for($i = 0; $i < count($lotArray); $i++)
                                    @php $quantity = 0; @endphp
                                    <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                                      {{$i + 1}}
                                        @for($j = 0; $j < count($lotArray[$i]); $j++)
                                        @php $lotId = $lotArray[$i][$j]['lot_id'] @endphp 
                                        <ul>
                                            <li data-jstree='{"icon" : "fab fa-css3-alt"}'>{{$lotArray[$i][$j]['lot_id']}} / {{$lotArray[$i][$j]['quantity']}}</li>
                                            @php $quantity += $lotArray[$i][$j]['quantity'] @endphp
                                        </ul>
                                        @endfor
                                        <ul>
                                          <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Pcs = {{$quantity}}</li>
                                          <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Total Pcs = {{getLotTotalPcs($lotId)}}</li>
                                          <li data-jstree='{"icon" : "fab fa-css3-alt"}'>Reamining Pcs = {{getLotTotalPcs($lotId) - $quantity}} </li>
                                        </ul>
                                      </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        </div>
                    </section>
                    </div>
                </div>
                </div>
                @endif
           

              <!-- Basic Bootstrap Table -->
              
              <!--/ Basic Bootstrap Table -->

             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
<script>

  $(document).on('click','#remove_row',function(e){
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
      OnRemoveSum(this);
  });
// });
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
    // $('#squan'+id).on('keyup',function(){
    //     let quan = $(this).val();
    //     let rate = $('#srate'+id).val();
    //     let total = quan * rate;
    //     $('#stotal'+id).val(total);
    //     var sum = 0;
    //       $('.tsum').each(function() {
    //           sum += Number($(this).val());
    //       });
    //       $('#grandtotal').val(sum);
    //       var sumquan = 0;
    //       $('.tquan').each(function() {
    //           sumquan += Number($(this).val());
    //       });
    //       $('#totalquan').val(sumquan);
    // })
    }
    </script>
    <script>
      function InsertRate(id){
        // var sum = 0;
          $('.trate').each(function() {
              $(this).val(id);
          });
      }
    </script>
      <!-- ---------------- DATE SECTION ----------------- -->

      <!-- <script>
          n =  new Date();
          y = n.getFullYear();
          m = n.getMonth() + 1;
          d = n.getDate();
          $("#date").val(d + "/" + m + "/" + y);
        </script> -->

      <script>
        $('#lot_id').on('change',function(){
          
        })
      </script>

<script>
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

  // Initialize totals when the page loads
  updateTotals();
                    </script>
    <x-footerscript/>
  </body>
</html>
