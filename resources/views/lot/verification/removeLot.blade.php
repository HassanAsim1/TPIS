
<!DOCTYPE html>
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
                    <li class="breadcrumb-item active" aria-current="page">Remove Lot</li>
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
                </div>
                <div class="container-fluid table-responsive text-nowrap">
                  <table id="example1" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>CARD-ID</th>
                        <th>NAME</th>
                        <th>Lot ID</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>Verify By</th>
                        <th>Role</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $lot)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$lot->card_id}}</strong></td>
                        <td>{{getname($lot->user_id)}}</td>
                        <td>{{$lot->lot_id}}</td>
                        <td>{{$lot->description}}</td>
                        <td>{{$lot->quantity}}</td>
                        <td>{{$lot->rate}}</td>
                        <td>{{$lot->total}}</td>
                        <td><span class="badge bg-label-warning me-1">{{$lot->check_by}}</span></td>
                        <td><span class="badge bg-label-warning me-1">{{$lot->role}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                               <a class="dropdown-item" href="#"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
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
    
    <x-footerscript/>
  </body>
</html>
