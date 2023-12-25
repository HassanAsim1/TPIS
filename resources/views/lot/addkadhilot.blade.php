
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
                    <li class="breadcrumb-item"><a href="{{url('kadhilot')}}" style ="font-size:15px">Kadhi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Kadhi Lot</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- FORM TRIGGER -->
            <form action="{{url('addkadhilotdetails')}}" method="POST" enctype="multipart/form-data">
                @csrf
                            <div class="card mt-2">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add Kadhi Details</h5>
                              </div>
                              <div class="container-xxl flex-grow-1 container-p-y mt-2">
                                <div class="row">
                                  <div class="col mb-3">
                                    <input type="text" value="{{$data->lot_id}}" class="form-control" name="lot_id" readonly>
                                  </div>
                                  <div class="col mb-3">
                                    <input type="text" value="{{$data->lot_quantity}}" class="form-control" id="quantity" name="lot_quantity" readonly>
                                  </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-3">
                                        @if(isset($lot->front_image))
                                        <img src="{{ asset('public/attachments/'.$lot->front_image) }}" width="50px;" height="50px;" class="clickable-front-image" data-toggle="modal" data-target="#imageModal" data-value="{{ asset('public/attachments/'.$lot->front_image) }}">
                                        @else
                                        <p>No Image Set</p>
                                        @endif
                                    </div>
                                    <div class="col mb-3">
                                        @if(isset($lot->back_image))
                                        <img src="{{ asset('public/attachments/'.$lot->back_image) }}" width="50px;" height="50px;" class="clickable-image" data-toggle="modal" data-target="#imageModal" data-value="{{ asset('public/attachments/'.$lot->back_image) }}">
                                        @else
                                        <p>No Image Set</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-3">
                                    <label for="Quantity" class="form-label">Add Front Photo</label>
                                    <input type="file" name="front_image" class="form-control" />
                                  </div>
                                  <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Add Back Photo</label>
                                    <input type="file" name="back_image" class="form-control"/>
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Front Stich</label>
                                    <input type="text" class="form-control" value="{{ isset($lot->front_stich) ? $lot->front_stich : '' }}" name="front_stich" id="front" placeholder="Front Stich">
                                  </div>
                                  <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Back Stich</label>
                                    <input type="text" class="form-control" name="back_stich" value="{{ isset($lot->back_stich) ? $lot->back_stich : '' }}" id="back" placeholder="Back Stich">
                                  </div>
                                </div>
                                <script>
                                    $('#front').on('change', function() {
                                        var front_stich = parseInt($('#front').val()) || 0; // Parse as integer, default to 0 if not a valid number
                                        var total_pcs = parseInt($('#quantity').val());
                                        if((front_stich / 1000) < 5){
                                            $('#front_amount').val(5 * total_pcs);
                                        }
                                        else{
                                            $('#front_amount').val((front_stich / 1000) * total_pcs);
                                        }
                                    });

                                    $('#back').on('change', function() {
                                        var back_stich = parseInt($('#back').val()) || 0;
                                        var total_pcs = parseInt($('#quantity').val());
                                        if((back_stich / 1000) < 5){
                                            $('#back_amount').val(5 * total_pcs);
                                        }
                                        else{
                                            $('#back_amount').val((back_stich / 1000) * total_pcs);
                                        }
                                    });
                                    $('#back, #front').on('change', function() {
                                            let frontAmount = parseInt($('#front_amount').val());
                                            let backAmount = parseInt($('#back_amount').val());

                                            // Check if parsing was successful
                                            if (!isNaN(frontAmount) && !isNaN(backAmount)) {
                                                let total_amount = frontAmount + backAmount;
                                                $('#total_amount').val(total_amount);
                                            } else {
                                                // Handle cases where parsing failed
                                                $('#total_amount').val('Invalid input');
                                            }
                                        });

                                </script>
                                <div class="row g-2">
                                  <div class="col mb-3">
                                  <label for="dobBasic" class="form-label">Front Amount</label>
                                    <input type="text" class="form-control" name="front_amount" value="{{ isset($lot->total_front_amount) ? $lot->total_front_amount : '' }}" id="front_amount" placeholder="Front Amount" readonly>
                                  </div>
                                  <div class="col mb-3">
                                  <label for="dobBasic" class="form-label">Back Amount</label>
                                    <input type="text" class="form-control" name="back_amount" value="{{ isset($lot->total_back_amount) ? $lot->total_back_amount : '' }}" id="back_amount" placeholder="Back Amount" readonly>
                                  </div>
                                  <div class="col mb-3">
                                    <label for="dobBasic" class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" name="total_amount" value="{{ isset($lot->total_amount) ? $lot->total_amount : '' }}" id="total_amount" placeholder="Total Amount" readonly>
                                  </div>
                                </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Details</button>
                              </div>
                            </div>
                          </div>
                        </div>
                </form>
            </div>

    <!-- Image Model -->

    <!-- The Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                    </div>
                </div>
            </div>
        </div>

        <script>
    $(document).ready(function () {
        $('.clickable-image').click(function () {
            var imageSrc = $(this).data('value');
            $('#modalImage').attr('src', imageSrc);
        });
    });
    $(document).ready(function () {
        $('.clickable-front-image').click(function () {
            var imageSrc = $(this).data('value');
            alert(imageSrc);
            $('#modalImage').attr('src', imageSrc);
        });
    });
</script>



    <x-footerscript/>
  </body>
</html>
