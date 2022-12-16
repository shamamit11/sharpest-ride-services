@php 
  use App\Models\AppSettings;
  $settings = AppSettings::first();
@endphp

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>{{ $page_title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Qalaqs" name="description" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
@if($settings->favicon)
<link rel="shortcut icon" href="{{ asset('/storage/settings/'.$settings->favicon)}}">
@else
<link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">
@endif
<link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
<link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

</head>
