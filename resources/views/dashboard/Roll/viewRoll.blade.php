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
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <x-alert />
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Roll Details</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="row">
                    <div class="col-sm-10">
                      <h5 class="card-header">Roll Tables </h5>
                    </div>
                    <div class="col-md-2">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <a href="{{url('addRoll')}}">
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal"
                        >
                          Add Roll
                        </button></a>
                    </div>
                </div>
                </div>
                <div class="container table-responsive text-nowrap mt-2">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Roll-ID</th>
                        <th>Partie Name</th>
                        <th>Rate</th>
                        <th>Remaining Meter</th>
                        <th>Total Meter</th>
                        <th>Created By</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($data as $roll)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$roll->rollId}}</strong></td>
                        <td>{{getpartiename($roll->partieId)}}</td>
                        <td>{{$roll->rollRate}}</td>
                        <td>{{getRemainingRoll($roll->rollId)}}</td>
                        <td>{{$roll->rollTotalMeter}}</td>
                        <td><span class="badge badge-info">{{$roll->createdBy}}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                               <a class="dropdown-item" href="{{url('editRoll/' .$roll->rollId)}}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);" onclick="deleteemp('{{$roll->rollId}}')" data-toggle="modal" data-target="#exampleModal"
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

              <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Record Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{url('deleteemp')}}" method="POST">
                      @csrf
                      <input type="hidden" name="user_id" id="userid">
                      <h4>Are you sure to delete the Record ?</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<script>
  function deleteemp(id){
    $('#userid').val(id);
  }
</script>

    
    <x-footerscript/>
  </body>
</html>
