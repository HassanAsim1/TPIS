<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <x-head />
</head>
<body>
  <x-dashboard />
  <x-alert />
  <div class="content-wrapper" style="padding: 20px;">
    <div class="card">
      <div class="card-body invoice-padding pb-0">
        <form action="{{url('bill_inv')}}" method="POST">
          @csrf
          <div class="row d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div class="col-md-3">
              <div class="logo-wrapper">
                <h3 class="text-primary">TPIS</h3>
                <p>This is Textile Production and Inventory System Created By <strong>University of Lahore</strong> & <strong>Reownlogics</strong></p>
              </div>
            </div>
            <div class="col-md-4">
              <h3 class="text">Fabric Id</h3>
              <input type="text" class="form-control" name="invoice_id" value="{{$data->fabricId}}" autofocus readonly />
            </div>
            <div class="col-md-4">
              <h3 class="text">Created By:</h3>
              <input type="text" class="form-control" name="created_by" value="{{session('role')}}" autofocus readonly />
            </div>
          </div>
          <hr class="mt-4">
          @php $count = 0 @endphp
          @foreach($fabricData as $fabric)
          <div id="addnewrow">
            <div class="row" style="margin-top:10px;">
              <div class="col-sm-2">
                <input type="text" class="form-control" name="slot[]" value="{{$fabric->fabricId}}" placeholder="Lot ID" readonly/>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="sdes[]" value="{{$fabric->rollId}}" id="basic-default-company" placeholder="Description" readonly/>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control tquan" id="squan0" value="{{$fabric->rollSubId}}" name="squantity[]" placeholder="Quantity" readonly/>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" value="{{$fabric->roleQuantity}}"  name="srate[]" placeholder="Rate" readonly/>
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control tsum" name="stotal[]" value="{{$fabric->rollUseStatus}}" placeholder="Total" readonly readonly/>
              </div>
            </div>
          </div>
          @php $count++ @endphp
          @endforeach
          <hr />
        </form>
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script>
          const printButton = document.getElementById('printButton');
          printButton.addEventListener('click', () => {
              window.print();
          });
        </script>
        <x-footerscript/>
      </div>
    </div>
  </div>
</body>
</html>
