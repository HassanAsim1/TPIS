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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
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
                    <li class="breadcrumb-item active" aria-current="page">Employee Payments</li>
                  </ol>
                </nav>
              </div>
            </div>
            @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
                  {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          @endif

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="row">
                <h5 class="card-header col-md-10">Weekly Payments Details</h5>
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
                  <table class="table table-bordered display nowrap" id="example">
                    <thead>
                      <tr>
                        <th>WEEK-ID</th>
                        <th>EMP-ID</th>
                        <th>Total Amount</th>
                        <th>Remaining Amount</th>
                        <th>Recieved Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                     @foreach($data as $employee)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$employee->week_id}}</strong></td>
                        <td><span class="badge bg-label-secondary me-1">{{$employee->created_by}}</span></td>
                        <td><strong>Rs :</strong> {{number_format($employee->total_amount)}}</td>
                        <td>{{number_format($employee->remaining_amount)}}</td>
                        <td>{{number_format($employee->recieved_amount)}}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{ \Carbon\Carbon::parse($employee->created_at)->format('d M Y h:iA') }}</strong></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('weekly_payments/'.$employee->week_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View Details</a
                              >
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
