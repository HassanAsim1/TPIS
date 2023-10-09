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
              <h4 class="fw-bold py-3 mb-4">fabrics Details</h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="row">
                <h5 class="card-header col-md-10">Table Basic</h5>
                <div class="col-md-2">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Add Fabric
                        </button>
                    </div>
                </div>
            
            </div>   
                <div class="container table-responsive text-nowrap">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>FABRIC-ID</th>
                        <th>FABRIC-NAME</th>
                        <th>Fabric-Type</th>
                        <th>METER</th>
                        <th>RATE</th>
                        <th>CUSTOMER-NAME</th>
                        <th>status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                   <tbody class="table-border-bottom-0">
                       @foreach($data as $fabric)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$fabric->fabric_id}}</strong></td>
                        <td>{{$fabric->fabric_name}}</td>
                        <td>{{$fabric->fabric_type}}</td>
                        <td>{{$fabric->meter}}</td>
                        <td>{{$fabric->rate}}</td>
                        <td>{{$fabric->customer_name}}</td>
                        
                        <td><span class="badge bg-label-primary me-1">{{$fabric->status}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bx-edit-alt me-1"></i>View</a
                              >   
                               <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
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
               <form action="{{url('add_fabric')}}" method="POST">
                @csrf
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add Fabric</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="fabricname" class="form-label">Fabric_Name</label>
                                    <input type="text" id="fabricname" name="fabricname" class="form-control" placeholder="Fabric Name" />
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="fabrictype" class="form-label">Fabric_Type</label>
                                    <input type="text" id="fabrictype" name="fabrictype" class="form-control" placeholder="Fabric Type" />
                                  </div>
                                </div>

                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="meter" class="form-label">Meter</label>
                                    <input type="text" id="meter" name="meter" class="form-control" placeholder="Meter" />
                                  </div>
                                  <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="rate" class="form-label">Rate</label>
                                    <input type="text" id="rate" name="rate" class="form-control" placeholder="Rate" />
                                  </div>
                                </div>
                   
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="customername" class="form-label">Customer Name</label>
                                    <input type="text" id="customername" name="customername" class="form-control" placeholder="Customer Name" />
                                  </div>
                                  
                                </div>
                                <div class="row g-2">
                                  
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">status</label>
                                    <select class="form-control"   name="status"  >
                                        <option value="disable">Disable</option>
                                        <option value="active" selected>Active</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary">Add Fabrics</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    
    <x-footerscript/>
  </body>
</html>

