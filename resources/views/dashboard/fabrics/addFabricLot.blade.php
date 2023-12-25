
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
                    <li class="breadcrumb-item"><a href="{{url('fabrics')}}" style ="font-size:15px">Fabrics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Fabric Lot</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- FORM TRIGGER -->
                <form action="{{url('add_fabric')}}" method="POST">
                @csrf
                            <div class="card mt-2">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add Fabric Lot</h5>
                              </div>

                              <div class="container-xxl flex-grow-1 container-p-y mt-2">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="fabricName">
                                  </div>
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Fabric Color</label>
                                    <input type="text" class="form-control" name="fabricColor">
                                  </div>
                                  <div class="col mb-0">
                                      <div class="mb-3">
                                          <label for="select2Multiple" class="form-label">Select Roll</label>
                                          <select id="select2Multiple" class="form-select" name="rollId">
                                              <option value=''>-- Select --</option>
                                              @foreach($fabricRoll as $fabric)
                                              <option value='{{$fabric->rollId}}'>{{$fabric->rollId}} /{{$fabric->biltyNo}} /{{$fabric->rollTotalMeter}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col mb-0">
                                    <div class="col mb-0">
                                        <div class="mb-3">
                                            <label for="select2Multiple" class="form-label">Roll Data</label>
                                            <select id="select3Multiple" class="select2 form-select" multiple name="rollData[]" required>
                                                <optgroup label="Roll Data">
                                                   
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Meter</label>
                                    <input type="text" id="Quantity" name="meter" class="form-control" placeholder="Meter" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Remaining Quantity</label>
                                    <input type="text" id="remainingQuantity" name="remainingQuantity" class="form-control" placeholder="Remaining" readonly/>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Rate</label>
                                    <input type="text" id="rate" name="rate" class="form-control" placeholder="Rate" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" id="description" name="description" class="form-control" placeholder="Description" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Quantity" class="form-label">Baar - Length</label>
                                    <input type="text" name="fabricBaar" class="form-control">
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Added By</label>
                                    <select class="form-control" name="addedBy">
                                        @if(session()->has('email'))
                                        <option value="{{session('master_id')}}">{{session('name')}} / {{session('master_id')}}</option>
                                        @endif
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Fabric Lot</button>
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
    <x-footerscript/>
    
    <script>
       $(document).ready(function() {
    $('#select3Multiple').change(function() {
        var selectedOptions = $(this).find('option:selected');
        var totalQuantity = 0;

        selectedOptions.each(function() {
            var quantity = parseInt($(this).text().split('/')[1].trim(), 10);
            totalQuantity += quantity;
        });

        $('#Quantity').val(totalQuantity);
        $('#remainingQuantity').val(totalQuantity);
    });

    $('#select2Multiple').change(function() {
        var selectedRollIds = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/getRollIdData/' + selectedRollIds,
            success: function(response) {
                console.log('Data from server:', response);
                appendOptionsToSelect(response);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });

    function appendOptionsToSelect(data) {
        var optgroup = $('#select3Multiple').find('optgroup[label="Roll Data"]');
        optgroup.empty(); // Clear existing options before appending new ones
        data.forEach(function(item) {
            var newOption = $('<option>', {
                value: item.rollSubId,
                text: item.rollSubId + ' / ' + item.rollQuantity,
            });
            optgroup.append(newOption);
        });

        $('#select3Multiple').trigger('change');
    }
});

    </script>
  </body>
</html>
