
<meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    @php
    $urlSegments = explode('/', request()->url());
    $secondParameter = $urlSegments[count($urlSegments) - 2]; // Index before the last segment
    @endphp

    <title>All Rounder - {{ $secondParameter }}</title>

    <title>{{request()->is()}}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Search Link -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Load Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Load the plugin bundle. -->
    <!-- <link rel="stylesheet" href="{{asset('searchjs/filter_multi_select.css')}}" /> -->
    <!-- <script src="{{asset('searchjs/filter-multi-select-bundle.min.js')}}"></script> -->

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
    <!-- Bill Invoice -->
    <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/jstree.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-tree.css">
  <!-- Theme style -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- <script src="../../path/to/cdn/jquery.slim.min.js"></script> -->
    <script src="{{asset('dist/jautocalc.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<!-- select 2 -->
<link rel="stylesheet" href="{{asset('multiple/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('multiple/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<style>
      @media print {
        /* Remove unnecessary elements */
        body {
          font-size: 12pt; /* Adjust font size for readability */
        }
        .content-wrapper {
          padding: 0; /* Remove padding to maximize content space */
        }
        .card {
          border: 1px solid #000;
          border-radius: 5px; /* Add rounded corners to the card */
          padding: 10px;
          margin-bottom: 10px;
        }
        input, select, .form-control {
          border: 1px solid #000;
          border-radius: 3px; /* Add rounded corners to input fields */
          padding: 3px; /* Add padding to input fields */
          font-size: 10pt; /* Adjust font size for input fields */
        }
        h1 {
          font-size: 16pt; /* Adjust font size for headings */
          margin-top: 20px; /* Add margin to headings */
        }
        hr {
          border: none; /* Remove the default horizontal rule */
          border-top: 1px solid #000; /* Add a custom horizontal rule */
          margin-top: 10px;
        }
        button {
          display: none; /* Hide buttons when printing */
        }
        /* Customize other styles as needed */
      }
    </style>