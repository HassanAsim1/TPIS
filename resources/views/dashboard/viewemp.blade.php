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
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}" style ="font-size:15px">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('emptable')}}" style ="font-size:15px">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data->user_id}}</li>
          </ol>
        </nav>
      </div>
    </div>
    @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @php session()->pull('error') @endphp
          @endif
      <div class="col-lg-12">
        <!-- <div class="card mb-12"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">User ID</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->user_id}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->phone_no}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">CNIC</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->cnic}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->role}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$data->address}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-9">
                @if($data->status == 'active')
                <p class="text-muted mb-0"><span class="badge badge-success">{{$data->status}}</span></p>
                @else
                <p class="text-muted mb-0"><span class="badge badge-danger">{{$data->status}}</span></p>
                @endif
              </div>
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</section>





          <x-footerscript/>
  </body>
  </html>