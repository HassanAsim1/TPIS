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
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <x-head />
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="authentication">  
          <x-alert />
          @if(session('role') == null)
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="{{url('login')}}" style ="font-size:15px">Sorry! Only <span style="color:red;">Admin</span>, Can Register the <strong>User</strong></a></li>
                    @if(session('role') == 'master')
                    <li class="breadcrumb-item"><a href="{{url('pantlot')}}" style ="font-size:15px">Sorry! Only <span style="color:red;">Admin</span>, Can Register the <strong>User</strong></a></li>
                    @elseif(session('role') == 'employee')
                    <li class="breadcrumb-item"><a href="{{url('lotcard')}}" style ="font-size:15px">Sorry! Only <span style="color:red;">Admin</span>, Can Register the <strong>User</strong></a></li>
                    @endif
                  </ol>
                </nav>
              </div>
            </div>
            @elseif(session('role') != 'admin')
            <div class="row">
              <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                  <ol class="breadcrumb mb-0">
                    @if(session('role') == 'master')
                    <li class="breadcrumb-item"><a href="{{url('pantlot')}}" style ="font-size:15px">Sorry! Only <span style="color:red;">Admin</span>, Can Register the <strong>User</strong></a></li>
                    @elseif(session('role') == 'employee')
                    <li class="breadcrumb-item"><a href="{{url('lotcard')}}" style ="font-size:15px">Sorry! Only <span style="color:red;">Admin</span>, Can Register the <strong>User</strong></a></li>
                    @endif
                  </ol>
                </nav>
              </div>
            </div>
            @else
          <!-- Register Card -->
          <div class="card">
            <div class="card-body col-xl">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/register" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">TPIS</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Adventure starts here 🚀</h4>
              <p class="mb-4">Make your app management easy and fun!</p>

              <form id="formAuthentication" class="mb-3" action="/register" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Enter your name"
                    autofocus
                  />
                </div>


                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="password">Password</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="password"
                          id="password"
                          class="form-control"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="phonenumber" class="form-label">Phone Number</label>
                      <input
                        type="text"
                        class="form-control"
                        id="phonenumber"
                        name="phonenumber"
                        placeholder="Enter your phonenumber"
                        autofocus
                      />
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="cnic" class="form-label">CNIC</label>
                      <input
                        type="text"
                        class="form-control"
                        id="cnic"
                        name="cnic"
                        placeholder="Enter your CNIC"
                        autofocus
                      />
                    </div>
                  </div>
                </div>


                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    placeholder="Enter your Address"
                    autofocus
                  />
                </div>

                <div class="mb-3">
                  <label for="address" class="form-label">Bank Account No:</label>
                  <input
                    type="text"
                    class="form-control"
                    id="bankAccountNumber"
                    name="bankAccountNumber"
                    placeholder="Enter your Bank Number"
                    autofocus
                  />
                </div>

                <div class="row">
                  <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="address" class="form-label">Bank Account Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="bankAccountName"
                          name="bankAccountName"
                          placeholder="Enter your Bank Account Name"
                          autofocus
                        />
                      </div>
                  </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="address" class="form-label">Bank Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="bankName"
                          name="bankName"
                          placeholder="Enter your Bank Account Name"
                          autofocus
                        />
                      </div>
                    </div>
                </div>


                <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Select Role</label>
                        <select class="form-select" id="selrole" aria-label="Default select example" name="role">
                          <option selected>Open this select menu</option>
                          <option value="admin">Admin</option>
                          <option value="cashier">Cashier</option>
                          <option value="manager">Manager</option>
                          <option value="master">Master</option>
                          <option value="employee">employee</option>
                        </select>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3" style="display:none" id="WorkingArea">
                      <label for="exampleFormControlSelect1" class="form-label">Select Working Area</label>
                      <select class="form-select" aria-label="Default select example" name="WorkingArea">
                        <option value="" selected>-- Select --</option>
                        @foreach($data as $workingArea)
                          <option value="{{$workingArea->workingAreaId}}">{{$workingArea->workingAreaName}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="mb-3" style="display:none" id="MethodofSalary">
                      <label for="exampleFormControlSelect1" class="form-label">Method of Salary</label>
                      <select class="form-control" aria-label="Default select example" name="MethodofSalary">
                        <option value="" selected>-- Select --</option>
                        <option value="salary">Salary</option>
                        <option value="perpiece">Per Piece</option>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="mb-3" style="display:none" id="salaryno">
                  <label for="salaryno" class="form-label">Salary</label>
                  <input
                    type="text"
                    class="form-control"
                    id="salaryno"
                    name="salaryno"
                    placeholder="Enter your salary"
                    
                  />
                </div>
                <div class="mb-3" style="display:none" id="perpiece">
                  <label for="salaryno" class="form-label">Rate</label>
                  <input
                    type="text"
                    class="form-control"
                    id="perpiece"
                    name="fix_rate"
                    placeholder="Enter your Rate"
                    
                  />
                </div>

                <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Select Role</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="status">
                          <option selected value="active">Active</option>
                          <option value="disable">Disable</option>
                        </select>
                </div>
                

                <!-- <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div> -->
                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                <a href="{{url('dashboard')}}"><button class="btn btn-secondary d-grid w-100 mt-2" type="button">Back</button></a>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{url('login')}}">
                  <span>Login!</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
        @endif
      </div>
    </div>
    <script>
        $('#selrole').on('change',function(){
          var rolevalue = $(this).find(":selected").val();
          if(rolevalue != 'cashier' && rolevalue != 'admin' && rolevalue != 'manager'){
            $('#WorkingArea').css('display','block');
            $('#MethodofSalary').css('display','block');
           
          }
          else{
            $('#WorkingArea').css("display", "none");
            $('#MethodofSalary').css('display','none');
            
          }
        })
      </script>

<script>
        $('#MethodofSalary').on('change',function(){
          var rolevalue = $(this).find(":selected").val();
          if(rolevalue == 'salary'){
            $('#perpiece').css("display", "none");
            $('#salaryno').css("display", "block");
          }
          else if(rolevalue == 'perpiece'){
            $('#salaryno').css("display", "none");
            $('#perpiece').css("display", "block");
          }
          // else{
          //   $('#salaryno').css("display", "none");
          // }
        })
      </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
