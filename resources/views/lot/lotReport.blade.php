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
          <form action="{{ url('addWorkingArea') }}" method="POST">
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
                        <div class="col-sm-2">
                          <label for="inputDebit">Working Area Id</label>
                          <input type="number" name="workingAreaId" class="form-control" placeholder="WA ID" required>
                        </div>
                        <div class="col-sm-3">
                          <label for="inputDes">Main Working Area</label>
                          <input type="text" name="mainWorkingArea" class="form-control" placeholder="Main Name" required>
                        </div>
                        <div class="col-sm-3">
                          <label for="inputDes">Working Area Name</label>
                          <input type="text" name="workingAreaName" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-sm-3">
                          <label for="inputGB">Given By</label>
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
      </div>
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
