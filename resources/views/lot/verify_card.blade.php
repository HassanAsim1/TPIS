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
          <div class="container py-5">
            <!-- Content -->
            @if(session('role') != 'admin' && session('role') != 'manager')
              <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style="font-size:15px;">Only <strong>Admin</strong> are Allow in this Section</a></li>
                  </ol>
                </nav>
              </div>
            </div>
            @else
            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verify Card</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="row">
                <h5 class="card-header col-md-10">Details</h5>
                <div class="col-md-2">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <!-- <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Add Parties
                        </button> -->
                    </div>
                </div>

            </div>
                <div class="container table-responsive text-nowrap">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Card-ID</th>
                        <th>User ID</th>
                        <th>Card Type</th>
                        <th>Working Area</th>
                        <th>Grand Total</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($data as $lotcard)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$lotcard->card_id}} / <span class="badge bg-label-secondary me-1">{{\Carbon\Carbon::parse($lotcard->created_at)->format('d M Y i:s:h')}}</span></strong></td>
                        <td>{{getname($lotcard->user_id)}}</td>
                        <td>{{$lotcard->card_type}}</td>
                        <td><span class="badge bg-label-primary me-1">{{$lotcard->working_area}}</span></td>
                        <td>{{$lotcard->grand_total}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('verify_card/'.$lotcard->card_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View Card</a
                              >
                              {{-- <a class="dropdown-item" href="{{url('editparty/' .$lotcard->card_id)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Edit Card</a
                              > --}}
                              <a class="dropdown-item delete-button" href="#" data-card-id="{{$lotcard->card_id}}"><i class="bx bx-trash me-1"></i>Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
              @endif
              <!--/ Basic Bootstrap Table -->

               <!-- FORM TRIGGER -->

                            <!-- Add this code at the end of your HTML body -->
              <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <a href="#" id="deleteRecordLink" class="btn btn-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>




    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script>
    // Function to set the href attribute of the "Delete" link in the modal
    function confirmDelete(cardId) {
      var deleteLink = document.getElementById('deleteRecordLink');
      deleteLink.href = '{{ url('delete-verify-card') }}/' + cardId; // Replace with your actual URL
    }

    // Attach a click event handler to the delete buttons in the table
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var cardId = this.getAttribute('data-card-id');
        confirmDelete(cardId);
        $('#deleteConfirmationModal').modal('show'); // Show the confirmation modal
      });
    });
  </script>




    <x-footerscript/>
  </body>
</html>
