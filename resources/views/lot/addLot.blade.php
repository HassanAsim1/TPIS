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
  <div class="content-wrapper">
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
      <div class="card">
        <section class="content mt-2" id="CreditCashier">
          <form action="{{ url('addLotData') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Lot</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-4">
                          <label for="inputDes">Employee Id</label>
                          <select class="form-select" name="employeeId" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach($user as $data)
                            <option value="{{$data->user_id}}">{{$data->user_id}} / {{$data->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <label for="inputGB">Lot ID</label>
                          <input type="text" name="lotId" class="form-control" placeholder="Lot ID">
                        </div>
                        <div class="col-sm-4">
                          <label for="inputGB">Quantity</label>
                          <input type="text" name="lotQuantity" class="form-control quantity" placeholder="Quantity">
                        </div>
                      </div>
                      <div class="row">
                        <!-- Rate field -->
                        <div class="col-sm-4">
                          <label for="inputDes">Rate</label>
                          <input type="text" name="lotRate" class="form-control rate" placeholder="Rate">
                        </div>
                        <!-- Total field -->
                        <div class="col-sm-4">
                          <label for="inputGB">Total</label>
                          <input type="text" name="lotTotal" class="form-control total" placeholder="Total" readonly>
                        </div>
                        <div class="col-sm-4">
                          <label for="inputGB">Change By</label>
                          <input type="text" name="addedBy" value="{{ getname(session('user_id')) }}" class="form-control" placeholder="Given By" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2 mt-4">
                          <button type="submit" class="btn btn-success">Add Lot</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </section>
      </div>
      <script>
        // Function to calculate total based on quantity and rate
        function calculateTotal() {
          // Get the quantity and rate values
          let quantity = parseFloat(document.querySelector('.quantity').value);
          let rate = parseFloat(document.querySelector('.rate').value);

          // Calculate the total
          let total = isNaN(quantity) || isNaN(rate) ? 0 : quantity * rate;

          // Set the total value
          document.querySelector('.total').value = total.toFixed(0); // You can adjust decimal places as needed
        }

        // Event listeners for quantity and rate fields to trigger total calculation
        document.querySelector('.quantity').addEventListener('input', calculateTotal);
        document.querySelector('.rate').addEventListener('input', calculateTotal);

        // Optional: Trigger the calculation on page load if default values are present
        calculateTotal();
      </script>
      <x-footerscript />
    </div>
  </div>
</body>
</html>
