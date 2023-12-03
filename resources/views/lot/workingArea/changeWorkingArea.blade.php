<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <x-head />
  <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
  <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
  <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
</head>
<body>
  <x-dashboard />
  @include('sweetalert::alert')
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style="font-size:15px">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cashier Payments</li>
            </ol>
          </nav>
        </div>
      </div>
      <x-alert />
      <!-- Credit By Cashier -->
      <div class="card">
        <section class="content mt-2" id="CreditCashier">
          <form action="{{ url('addChangeWorkingArea') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Working Area</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3">
                          <label for="inputDes">Employee Id</label>
                          <select class="form-select" name="employeeId" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach($employee as $data)
                            <option value="{{$data->user_id}}">{{$data->user_id}} / {{$data->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <label for="inputDes">Working Area</label>
                          <select class="form-select" aria-label="Default select example" name="changeWorkingArea">
                            <option selected>Open this select menu</option>
                            @foreach($workingArea as $data)
                            <option value="{{$data->workingAreaId}}">{{$data->workingAreaName}} / {{$data->workingAreaId}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-3">
                          <label for="inputGB">Change By</label>
                          <input type="text" name="addedBy" value="{{ getname(session('user_id')) }}" class="form-control" placeholder="Given By" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2 mt-4">
                            <button type="submit" class="btn btn-success">Add Working Area</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </form>
        </section>
        {{-- <div class="card mt-5">
          <div class="row">
            <h5 class="card-header col-md-10">Payments Details</h5>
            <div class="col-md-2">
              <div class="mt-3">
                <!-- Button trigger modal -->
              </div>
            </div>
          </div>
          <div class="container table-responsive text-nowrap">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Working ID</th>
                  <th>Working Area ID</th>
                  <th>Working Area Name</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php
                $balance = 0;
                $num = count($data);
                $count = 1;
                @endphp
                <input type="hidden" id="table_row" value="{{$num}}" />
                @foreach($data as $workingArea)
                <tr id="row{{$count}}">
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$workingArea->id}}</strong></td>
                  <td>WA-{{$workingArea->workingAreaId}}</td>
                  <td>{{$workingArea->workingAreaName}}</td>
                  <td><span class="badge badge-sm badge-primary">{{getname($workingArea->addedBy)}}</span></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('updateWorkingArea/'.$workingArea->id)}}"><i class="bx bx-edit-alt me-1"></i>Update</a>
                        <a class="dropdown-item" href="#" onclick="confirmDelete('{{url('deleteWorkingArea/'.$workingArea->id)}}')"><i class="bx bx-trash me-1"></i> Delete</a>
                      </div>
                    </div>
                  </td>
                  @php $count++ @endphp
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div> --}}
      </div>
      <!--/ Basic Bootstrap Table -->
      <!-- FORM TRIGGER -->
      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script>
        $(document).ready(function(){
          let rowval = $('#table_row').val();
          document.getElementById('row'+rowval).scrollIntoView();
        })
      </script>
      <script>
        function confirmDelete(deleteUrl) {
            if (confirm('Are you sure you want to delete this item?')) {
            window.location.href = deleteUrl;
            }
        }
      </script>
      <x-footerscript />
    </div>
  </div>
</body>
</html>
