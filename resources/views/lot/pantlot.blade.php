
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
                            <a href="{{url('addpant')}}"><button
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
                      @foreach($data as $lot)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$lot->lotNumber}}</strong></td>
                        <td>{{$lot->lot_name}}</td>
                        <td>{{$lot->lot_quantity}}</td>
                        <td>{{$lot->lot_remain}}</td>
                        <td>{{$lot->lot_master}}</td>
                        <td>
                            <!-- {{$lot->lot_size}} -->
                            
                        @php
                            $size = json_decode($lot->lot_size);
                        @endphp
                        {{-- @foreach((array) $size as $lotsize)
                        <span class="badge bg-label-warning me-1">{{$lotsize}}</span>,
                        @endforeach --}}
                        {{count((array)$size)}}
                        </td>
                        <td>
                          @if($lot->status == 1)
                          <span class="badge bg-label-info me-1">Cutting Room</span>
                          @elseif($lot->status == 2)
                          <span class="badge bg-label-info me-1">Kadi</span>
                          @elseif($lot->status == 3)
                          <span class="badge bg-label-info me-1">Singer</span>
                          @elseif($lot->status == 4)
                          <span class="badge bg-label-info me-1">Fido</span>
                          @elseif($lot->status == 5)
                          <span class="badge bg-label-info me-1">Safti</span>
                          @elseif($lot->status == 6)
                          <span class="badge bg-label-info me-1">Thoka / Mori</span>
                          @elseif($lot->status == 7)
                          <span class="badge bg-label-info me-1">Washing</span>
                          @elseif($lot->status == 8)
                          <span class="badge bg-label-info me-1">Clipping</span>
                          @elseif($lot->status == 9)
                          <span class="badge bg-label-info me-1">Rib - Button</span>
                          @elseif($lot->status == 10)
                          <span class="badge bg-label-info me-1">Press</span>
                          @elseif($lot->status == 11)
                          <span class="badge bg-label-info me-1">Packing</span>
                          @elseif($lot->status == 12)
                          <span class="badge bg-label-info me-1">Complete</span>
                          @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{url('viewlot/'.$lot->lot_id)}}"
                              ><i class="bx bx-edit-alt me-1"></i>View</a
                              >   
                               <a class="dropdown-item" href="{{url('editpantlot/' .$lot->lot_id)}}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="{{url('lotReport?lotId=' .$lot->lotNumber.'&lotType=Pant')}}"
                                ><i class="bx bx-edit-alt me-1"></i> Report</a
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
    <script>
        $('document').ready(function(){
            $('#Quantity').on('change', function(){
                let quantity = $('#Quantity').val();
                $('#Remain_Quantity').val(quantity);
                $('#damage').val(0);
                $('#cost_price').val(0);
                $('#sale_price').val(0);
        })
        });
    </script>
    
    <x-footerscript/>
  </body>
</html>
