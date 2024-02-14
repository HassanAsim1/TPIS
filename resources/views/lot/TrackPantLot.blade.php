
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

          <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
          @if(session()->has('msg'))
          <div class="alert alert-success alert-dismissible" role="alert">
                    {{session('msg')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @php session()->pull('msg') @endphp
          @endif
          <div class="card">
                <h5 class="card-header">Track lots</h5>
                <div class="card-body">
                  <div class="row">
                    <!-- Custom content with heading -->
                    <div class="col-lg-12">
                      <!-- <small class="text-light fw-semibold">Horizontal</small> -->
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Cutting</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#kadhi"
                            >Kadhi</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#singer"
                            >Singer</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#fido"
                            >Fido</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#safety"
                            >Safety</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#batake"
                            >Batake</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#thokamori"
                            >Thoka/M</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#washing"
                            >Washing</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#clipping"
                            >Clipping</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#ribbtn"
                            >R.Button</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#press"
                            >Press</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#packing"
                            >Packing</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#complete"
                            >Complete</a
                          >
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
                          <div class="card">
                            <h5 class="card-header">Cutting Room</h5>
                              <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                      <th>LOT-ID</th>
                                        <th>LOT-QUANTITY</th>
                                        <th>LOT-MASTER</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $TrackData)
                                      @php
                                          $size = json_decode($TrackData->lot_size);
                                      @endphp
                                      @if($TrackData->status == 1)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                                        </td>
                                        <td>{{$TrackData->lot_quantity}}</td>
                                        <td>{{$TrackData->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Cutting Room</span></td>
                                        <td>
                                          <a>
                                          <div class="dropdown">
                                            <button
                                              type="button"
                                              class="btn btn-success btn-sm"
                                              data-bs-toggle="dropdown"
                                              onclick="next('{{$TrackData->lot_id}}')"
                                            >
                                            Next
                                            </button></a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                                      @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 1)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Cutting Room</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="kadhi">
                          <div class="tab-pane fade show active" id="kadhi">
                          <div class="card">
                <h5 class="card-header">Kadhi</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 2)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">kadhi</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 2)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">kadhi</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="singer">
                          <div class="tab-pane fade show active" id="singer">
                          <div class="card">
                <h5 class="card-header">Singer</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 3)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Singer</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 3)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Singer</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="fido">
                          <div class="tab-pane fade show active" id="fido">
                          <div class="card">
                <h5 class="card-header">Fido</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 4)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Fido</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 4)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Fido</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="safety">
                          <div class="tab-pane fade show active" id="safety">
                          <div class="card">
                <h5 class="card-header">Singer</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 5)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Safety</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 5)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Safety</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="batake">
                          <div class="tab-pane fade show active" id="batake">
                          <div class="card">
                <h5 class="card-header">Batake</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 6)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Batake</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 6)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Batake</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>

                          <div class="tab-pane fade" id="thokamori">
                          <div class="tab-pane fade show active" id="thokamori">
                          <div class="card">
                <h5 class="card-header">Thoka Mori</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 7)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Thoka Mori</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 7)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Thoka Mori</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>
                          

                        <div class="tab-pane fade" id="ribbtn">
                          <div class="tab-pane fade show active" id="ribbtn">
                          <div class="card">
                <h5 class="card-header">Rib Button</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 10)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Rib Button</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 10)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Rib Button</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!--/ Bordered Table -->
                          </div>
                          <div class="tab-pane fade" id="washing">
                          <div class="tab-pane fade show active" id="washing">
                          <div class="card">
                <h5 class="card-header">Washing</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 8)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Washing</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 8)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Washing</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
                          </div>
                          <div class="tab-pane fade" id="clipping">
                          <div class="tab-pane fade show active" id="clipping">
                          <div class="card">
                <h5 class="card-header">Clipping</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 9)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Clipping</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 9)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Clipping</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
</div>
</div>
                          </div>
                          <div class="tab-pane fade" id="press">
                          <div class="tab-pane fade show active" id="press">
                          <div class="card">
                <h5 class="card-header">Press</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 11)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Press</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 11)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Press</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
</div>
</div>
                          </div>
                          <div class="tab-pane fade" id="packing">
                          <div class="tab-pane fade show active" id="packing">
                          <div class="card">
                <h5 class="card-header">Packing</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 12)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-info me-1">Packing</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                                onclick="next('{{$TrackData->lot_id}}')"
                              >
                              Next
                              </button></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 12)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Packing</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="dropdown" onclick="shirtnext('{{$shirtLot->lot_id}}')">Next</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
</div>
</div>
                          </div>
                          <div class="tab-pane fade" id="complete">
                          <div class="tab-pane fade show active" id="complete">
                          <div class="card">
                <h5 class="card-header">Complete</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>LOT-ID</th>
                          <th>LOT-QUANTITY</th>
                          <th>LOT-MASTER</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $TrackData)
                        @php
                            $size = json_decode($TrackData->lot_size);
                        @endphp
                        @if($TrackData->status == 13)
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$TrackData->lotNumber}}</strong>
                          </td>
                          <td>{{$TrackData->lot_quantity}}</td>
                          <td>{{$TrackData->lot_master}}</td>
                          <td><span class="badge bg-label-success me-1">Complete</span></td>
                          <td>
                          <a>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="dropdown"
                                onclick="back('{{$TrackData->lot_id}}')"
                              >
                              Back
                              </button></a>
                              <!-- <a>
                              <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-bs-toggle="dropdown"
                              >
                              Verify
                              </button></a> -->
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($shirtLots as $shirtLot)
                                      @php
                                          $size = json_decode($shirtLot->lot_size);
                                      @endphp
                                      @if($shirtLot->status == 13)
                                      <tr>
                                        <td>
                                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$shirtLot->lotNumber}}</strong>
                                        </td>
                                        <td>{{$shirtLot->lot_quantity}}</td>
                                        <td>{{$shirtLot->lot_master}}</td>
                                        <td><span class="badge bg-label-info me-1">Complete</span></td>
                                        <td>
                                        <a>
                                          <a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="dropdown" onclick="shirtback('{{$shirtLot->lot_id}}')">Back</button>
                                          </a>
                                          </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
</div>
</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Custom content with heading -->
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- / Content -->

              
             

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

     
    <script>
      function next(id){
        $.ajax({
          type: 'GET',
          url: 'next/'+id,
          success(data){
            location.reload();
          }
        })
      }

      function back(id){
        $.ajax({
          type: 'GET',
          url: 'back/'+id,
          success(data){
            location.reload();
          }
        })
      }
    </script>
    <script>
      function shirtnext(id){
        $.ajax({
          type: 'GET',
          url: 'shirtnext/'+id,
          success(data){
            location.reload();
          }
        })
      }

      function shirtback(id){
        $.ajax({
          type: 'GET',
          url: 'shirtback/'+id,
          success(data){
            location.reload();
          }
        })
      }
    </script>
    <x-footerscript/>
  </body>
</html>
