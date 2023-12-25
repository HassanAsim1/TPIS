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
                    <li class="breadcrumb-item active" aria-current="page">Parties Payments</li>
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
                  <table class="table table-bordered" id="example">
                    <thead>
                      <tr>
                        <th>PARTIE-ID</th>
                        <th>NAME</th>
                        <th>CURRENT-BALANCE</th>
                        <th>status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($data as $partie)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$partie->partie_id}}</strong></td>
                        <td>{{$partie->name}}</td>
                        <td><strong>Rs :</strong> {{number_format(cal_current_amount($partie->partie_id))}}</td>
                        <td><span class="badge bg-label-primary me-1">{{$partie->status}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('parties_ledger/'.$partie->partie_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View Ledger</a
                              >   
                               <!-- <a class="dropdown-item" href="{{url('editparty/' .$partie->partie_id)}}"
                                ><i class="bx bx-edit-alt me-1"></i> </a
                              > -->
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
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
              <!--/ Basic Bootstrap Table -->

               <!-- FORM TRIGGER -->
               
             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    
    
    <x-footerscript/>
  </body>
</html>
