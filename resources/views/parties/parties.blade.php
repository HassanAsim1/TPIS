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
                    <li class="breadcrumb-item active" aria-current="page">Parties</li>
                  </ol>
                </nav>
              </div>
            </div>

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
                          Add Parties
                        </button>
                    </div>
                </div>
            
            </div>   
                <div class="container table-responsive text-nowrap">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>PARTIE-ID</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>PHONE-NO</th>
                        <th>CATEGORY</th>
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
                        <td>{{$partie->address}}</td>
                        <td>{{$partie->phone_no}}</td>
                        @if($partie->category == 'buyer')
                        <td><span class="badge bg-label-info me-1">{{$partie->category}}</span></td>
                        @else
                        <td><span class="badge bg-label-warning me-1">{{$partie->category}}</span></td>
                        @endif
                        <td><strong>Rs:</strong> {{number_format(cal_current_amount($partie->partie_id))}}</td>
                        <td>
                          @if($partie->status == 'active')
                          <span class="badge bg-label-primary me-1">{{$partie->status}}</span>
                          @else
                          <span class="badge bg-label-danger me-1">{{$partie->status}}</span>
                          @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                              ><i class="bx bx-edit-alt me-1"></i>View</a
                              > 
                               <a class="dropdown-item" href="{{url('editparty/' .$partie->partie_id)}}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="{{url('report?partieId=' .$partie->partie_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>Report</a
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
               <form action="{{url('add_partie')}}" method="POST">
                @csrf
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Add Parties</h5>
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
                                    <label for="nameBasic" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" />
                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="Address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" />
                                  </div>
                                  <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="phone_no" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_no" name="phone_no" class="form-control" placeholder="Phone Number" />
                                  </div>
                                </div>
                   
                                <!-- <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="openbalance" class="form-label">Opening Balance</label>
                                    <input type="text" id="openbalance" name="openbalance" class="form-control" placeholder="Open Balance" />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="currentbalance" class="form-label">Current Balance</label>
                                    <input type="text" id="currentbalance" name="currentbalance" class="form-control" placeholder="Current Balance" />
                                  </div>
                                </div> -->
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="dobBasic" class="form-label">Category</label>
                                    <select class="form-control" name="category">
                                        <option value="buyer">Product Buyer</option>
                                        <option value="seller">Fabric Seller</option>
                                    </select>
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
                                <button type="submit" class="btn btn-primary">Add Parties</button>
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
