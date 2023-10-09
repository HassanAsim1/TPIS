
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
                    <li class="breadcrumb-item active" aria-current="page">Lot Details</li>
                  </ol>
                </nav>
              </div>
            </div>
              <!-- Basic Bootstrap Table -->
              @if($mstatus->status == 'disable')
              <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Sorry! Your Status is Currently <span style="color:red;">Disable</span>, Contact Your <strong>Admin</strong></a></li>
                  </ol>
                </nav>
              </div>
            </div>
            @else
              <div class="card">
                <div class="row">
                    <div class="col-md-10">
                        <h5 class="card-header">Lot Table</h5>
                    </div>
                    <div class="col-md-2">
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <a href="{{url('addshirtlot')}}"><button
                            type="button"
                            class="btn btn-primary"
                            >
                            Add Lot
                            </button></a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid table-responsive text-nowrap">
                  <table id="example1" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                      <th>LOT-ID</th>
                        <th>NAME</th>
                        <th>QUANTITY</th>
                        <th>REMAINING-QUAN</th>
                        <th>MASTER</th>
                        <th>LOT-SIZE</th>
                        <th>LOT-STATUS</th>
                        <th>Actions</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $user)
                      <tr>
                      <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$user->lot_id}}</strong></td>
                          <td>{{$user->lot_fabric}}</td>
                          <td>{{$user->lot_quantity}}</td>
                          <td>{{$user->lot_remain}}</td>
                          <td>{{$user->lot_master}}</td>
                          <td>{{$user->lot_size}}</td>
                          <td><span class="badge badge-primary">{{$user->status}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('shirtlot/'.$user->lot_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View</a
                              >
                               <a class="dropdown-item" href="{{url('editshirtlot/' .$user->lot_id)}}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href=""
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
              <!--/ Basic Bootstrap Table -->

                @endif


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <x-footerscript/>
  </body>
</html>
