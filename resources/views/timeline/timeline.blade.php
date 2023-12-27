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
                    <li class="breadcrumb-item active" aria-current="page">Audit</li>
                  </ol>
                </nav>
              </div>
            </div>

              <!-- Basic Bootstrap Table -->
            <section class="basic-timeline">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Audit</h4>
                            </div>
                            <div class="card-body" style="height: 700px;">
                                <ul class="timeline">
                                    @foreach($auditData as $data)
                                    <li class="timeline-item">
                                        <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                <h6 class="mb-50">{{$data->event}} - {{$data->user_id}}</h6>
                                                <span class="timeline-event-time">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('Do MMMM YYYY, h:mm A') }}</span>
                                            </div>
                                            <p>{{$data->old_values}}</p>
                                            <p>{{$data->new_values}}</p>
                                            <hr />
                                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="mb-0">Katy Turner</p>
                                                        <span class="text-muted">{{$data->auditable_type}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center cursor-pointer mt-sm-0 mt-50">
                                                    <i data-feather="message-square" class="mr-1"></i>
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
              </div>
            </div>
               
             
    <x-footerscript/>
  </body>
</html>
