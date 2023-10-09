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
    <!-- <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
  </head>

  <body>
          <x-dashboard/>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class=" container-fluid table-responsive text-nowrap">
                  <table id="example1" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Invoice-ID</th>
                        <th>Party-ID</th>
                        <th>Created-By</th>
                        <th>Bill-Type</th>
                        <th>Total Pices</th>
                        <th>Grand Total</th>
                        <th>Discount</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($data as $user)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$user->invoice_id}}</strong></td>
                        <td>{{getpartiename($user->partie_id)}}</td>
                        <td><span class="badge bg-label-secondary me-1">{{$user->created_by}}</span></td>
                        <td>
                            @if($user->bill_type == 'pant_bill')
                            <span class="badge bg-label-info me-1">Pant Bill</span>
                            @elseif($user->bill_type == 'shirt_bill')
                            <span class="badge bg-label-info me-1">Shirt Bill</span>
                            @endif
                        </td>
                        <td>{{$user->total_pcs}}</td>
                        <td>{{$user->grand_total}}</td>
                        <td>{{$user->discount}}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('view_detail_invoice/'.$user->invoice_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View</a
                              >   
                               <a class="dropdown-item" href="{{url('editemp/' .$user->user_id)}}"
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
              <!--/ Basic Bootstrap Table -->

             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    
    <x-footerscript/>
    
  </body>
</html>
