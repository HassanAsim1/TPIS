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
                    <li class="breadcrumb-item active" aria-current="page">Create Card</li>
                </ol>
                </nav>
            </div>
            </div>
    @if($mstatus->status == 'disable')
              <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style="font-size:15px;">Sorry! Your Status is Currently <span style="color:red;">Disable</span>, Contact Your <strong>Admin</strong></a></li>
                  </ol>
                </nav>
              </div>
            </div>
      @else
        @if(session('role') == 'master' || session('role') == 'employee' || session('role') == 'singer' || session('role') == 'admin' )
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Add Card</h5>
                      <small class="text-muted float-end">Lot Section</small>
                    </div>
                    <div class="card-body">
                    <form action="{{url('addpantlot')}}" method="POST">
                      @csrf
                        <div class="row mb-3">
                          <label class="col-sm-1 col-form-label" for="basic-default-name">User ID</label>
                          <div class="col-sm-5">
                            @if(session('role') == 'admin')
                            <select class="form-select" aria-label="Default select example" name="user_id">
                              <option value="" selected>-- Select --</option>
                              @foreach($emp_data as $user)
                              <option value="{{$user->id}}">{{$user->id}} / {{$user->name}}</option>
                              @endforeach
                            </select>
                            @else
                            <input type="text" class="form-control" id="basic-default-name" value="{{session('user_id')}}" name="user_id" readonly/>
                            @endif
                          </div>

                          <script>
                            $(document).ready(function() {
                                // Listen for changes in the select input
                                $('select[name="user_id"]').on('change', function() {
                                    var selectedUserId = $(this).val(); // Get the selected user ID

                                    // Make an AJAX request to fetch the fix rate for the selected user
                                    $.ajax({
                                        type: 'GET',
                                        url: '/get-fix-rate/' + selectedUserId, // Replace with your route URL
                                        dataType: 'json',
                                        success: function(data) {
                                            // Update the input field with the fetched fix rate
                                            $('#rate').val(data.fix_rate);
                                        },
                                        error: function() {
                                            // Handle any errors here
                                            alert('An error occurred while fetching data.');
                                        }
                                    });
                                });
                            });
                            </script>

                          <label class="col-sm-1 col-form-label" for="basic-default-name">Fix Rate:</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" name="fix_rate" id="rate" value="{{session('fix_rate')}}"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-1 col-form-label" for="basic-default-company">Card Type :</label>
                          <div class="col-sm-5">
                            <select name="card_type" class="form-select">
                                <option value="pant">Pant Card</option>
                                <option value="shirt">Shirt Card</option>
                            </select>
                          </div>
                          <label class="col-sm-1 col-form-label" for="basic-default-company">Working Area :</label>
                          <div class="col-sm-5">
                            @if($data->working_area == 1)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Cutting Room" readonly/>
                            @elseif($data->working_area == 2)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Kadi" readonly/>
                            @elseif($data->working_area == 3)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Singer" readonly/>
                            @elseif($data->working_area == 4)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Fido" readonly/>
                            @elseif($data->working_area == 5)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Safti" readonly/>
                            @elseif($data->working_area == 6)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Batake" readonly/>
                            @elseif($data->working_area == 7)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Thoka" readonly/>
                            @elseif($data->working_area == 8)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Washing" readonly/>
                            @elseif($data->working_area == 9)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Clipping" readonly/>
                            @elseif($data->working_area == 10)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="Rib-Button" readonly/>
                            @elseif($data->working_area == 11)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="press" readonly/>
                            @elseif($data->working_area == 12)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="packing" readonly/>
                            @elseif($data->working_area == 13)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="complete" readonly/>
                            @elseif($data->working_area == 14)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="shirt" readonly/>
                            @elseif($data->working_area == 15)
                            <input type="text" class="form-control" id="basic-default-company" name="working_area" value="worker" readonly/>
                            @endif
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-1 col-form-label" for="basic-default-company">Advance :</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" name="" id="" value="{{number_format(cal_employee_amount(session('user_id')))}}" readonly/>
                          </div>
                        </div>
                        <hr />
                          <div id="addnewrow">
                            {{-- @php $count = 0 @endphp
                            @foreach($CheckLot as $lotcard) --}}

                            <div id="addnewrow">
                              <div class="row" style="margin-top:10px;">
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control" name="sname[]" placeholder="Lot ID" required/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" value="16 to 34" readonly required/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                <input type="text" class="form-control tquan" id="squan0" name="squantity[]" placeholder="Quantity" required/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control srate" id="srate0" name="srate[]" value="{{session('fix_rate')}}" placeholder="Rate" required/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <input type="text" class="form-control tsum" id="stotal0" name="stotal[]" placeholder="Total" readonly required/>
                                </div>
                                <div class="col-sm-2 mt-1">
                                  <button type="button" class="btn btn-success" id="add_row">Add Row</button>
                                </div>
                              </div>
                            </div>


                              {{-- <div class="row">
                                <div class="col mt-2 ">
                                <input type="text" class="form-control" name="sname[]" id="basic-default-company"  readonly/>
                                </div>
                                <div class="col mt-2">
                                  <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description"/>
                                </div>
                                <div class="col mt-2">
                                <input type="text" class="form-control tquan" id="squan{{$count}}" name="squantity[]" value="" readonly/>
                                </div>
                                <div class="col mt-2">
                                  <input type="text" class="form-control trate" onkeydown="totalval({{$count}})" id="srate0" name="srate[]" placeholder="Rate"/>
                                </div>
                                <div class="col mt-2">
                                  <input type="text" class="form-control tsum" id="stotal0" name="stotal[]" placeholder="Total" readonly/>
                                </div>
                                <div class="col mt-2">
                                   <button type="button" class="btn btn-danger" id="remove_row">Remove Row</button>
                                </div>
                              </div> --}}
                              {{-- @php $count++ @endphp
                              @endforeach --}}
                            </div>
                            <hr />
                            <div class="row justify-content-end">
                              <div class="col-sm-6 mt-5">
                                <button type="submit" class="btn btn-primary">Create Card</button>
                               {{-- <label for="">Insert Rate</label>
                                <input type="checkbox" class="btn btn-primary" onclick="InsertRate({{session('fix_rate')}})" /> --}}
                              </div>
                              <div class="col-sm-3">
                              <label class="col-form-label" for="basic-default-company">Total Quantity :</label>
                              <input type="text" class="form-control" id="totalquan" name="total_quantity" placeholder="Total Quantity" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <label class="col-form-label" for="basic-default-company">Grand-Total :</label>
                              <input type="text" class="form-control stotal" id="grandtotal" name="grandtotal" placeholder="Grand Total" readonly/>
                              </div>
                              <div class="col-sm-3">
                              <!-- <input type="text" class="form-control stotal" id="stotal" name="stotal[]" placeholder="Total" readonly/> -->
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                @else
                <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a style ="font-size:15px">You are not allow to <strong>Create Card</strong></a></li>
          </ol>
        </nav>
      </div>
    </div>
                @endif
                @endif


              <!-- Basic Bootstrap Table -->

              <!--/ Basic Bootstrap Table -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script>
$(document).ready(function () {
  var count = 0;

  $('#add_row').click(function () {
    count++;
    $('#addnewrow').append(`
      <div class="row" style="margin-top:10px;">
        <div class="col-sm-2">
          <input type="text" class="form-control" name="sname[]" placeholder="Lot ID" required/>
        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="sdes[]" id="basic-default-company" placeholder="Description" value="16 to 34" readonly required/>
        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control tquan" id="squan${count}" name="squantity[]" placeholder="Quantity" required/>
        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control srate" name="srate[]" value="{{session('fix_rate')}}" placeholder="Rate" required/>
        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control tsum" id="stotal${count}" name="stotal[]" placeholder="Total" readonly required/>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-danger remove_row">Remove Row</button>
        </div>
      </div>
    `);
  });

  $(document).on('click', '.remove_row', function (e) {
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
    updateTotals(); // Update totals when a row is removed
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

  // Initialize totals when the page loads
  updateTotals();
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
  //   $(document).on('input', '#squan0', function () {
  //     var quantity = parseFloat($('#squan0').val()) || 0; // Ensure it's a number, default to 0
  //     var rate = parseFloat($('#srate0').val()) || 0; // Ensure it's a number, default to 0
  //     var subTotal = quantity * rate;
  //     alert(subTotal);
  //     $('#stotal0').val(subTotal);
  // });
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
    <x-footerscript/>
  </body>
</html>
