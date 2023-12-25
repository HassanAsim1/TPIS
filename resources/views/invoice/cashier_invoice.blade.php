<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <x-head />
    <style>
    /* Add your custom CSS styles here */
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .table th, .table td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    .table th {
        background-color: #f5f5f5;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #e0e0e0;
    }

    .badge {
        padding: 2px 8px;
        border-radius: 4px;
    }

    /* Adjust column widths */
    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 15%; /* Adjust the width as needed */
    }

    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 20%; /* Adjust the width as needed */
    }

    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 35%; /* Adjust the width as needed */
    }

    .table th:nth-child(4),
    .table td:nth-child(4) {
        width: 10%; /* Adjust the width as needed */
    }

    .table th:nth-child(5),
    .table td:nth-child(5) {
        width: 10%; /* Adjust the width as needed */
    }

    .table th:nth-child(6),
    .table td:nth-child(6) {
        width: 10%; /* Adjust the width as needed */
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
    }

    .from-address,
    .to-address {
        width: 48%; /* Adjust the width to leave space for spacing between elements */
    }

    .container {
        text-align: center;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }
</style>

</head>
<body>
   <div class="container">
    <h1>Owner Jeans</h1>
    <h4 style="text-align:center;">Export By : {{getname(session('user_id'))}}</h4>
   </div>
    <div class="table-responsive text-nowrap" style="max-height: 500px; overflow-y: auto;">
        <table class="table table-bordered" style="overflow-x: auto;" id="exportTable">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>TRANSCATION-ID / BILL NO</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @php $balance = 0;
                    $num = count($CashEntry);
                    $count = 1; @endphp
                    <input type="hidden" id="table_row" value="{{$num}}"/>
                     @foreach($CashEntry as $CashData)
                      <tr id="row{{$count}}">
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$CashData->pay_id}}</strong> / <span class="badge bg-label-secondary me-1">{{\Carbon\Carbon::parse($CashData->created_at)->format('d M Y')}}</span></td>
                        @if($CashData->user_id != 'Expense' && $CashData->user_id != 'Company')
                          @if($CashData->debit != null)
                          <td>{{getname($CashData->user_id)}}</td>
                          @else
                          <td>{{getpartiename($CashData->user_id)}}</td>
                          @endif
                        @else
                        <td>{{$CashData->user_id}}</td>
                        @endif
                        <td>{{$CashData->description}} / <span class="badge bg-label-primary me-1">{{getname($CashData->given_by)}}</span></td>
                        <td>{{$CashData->debit}}</td>
                        <td>{{$CashData->credit}}</td>
                        <td>{{$balance = ($balance + $CashData->credit - $CashData->debit)}}</td>
                        @php $count++ @endphp
                      </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row" style="margin-top:30px;">
        <div class="col-sm-6">
            <h4>Signature: ________________</h4>
        </div>
    </div>

    <script>
    // Get the current date
    var currentDate = new Date();

    // Format the date as you desire (e.g., "Month Day, Year")
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString(undefined, options);

    // Update the content of the "date" element with the formatted date
    document.getElementById("date").textContent = formattedDate;
    </script>
</body>
</html>
