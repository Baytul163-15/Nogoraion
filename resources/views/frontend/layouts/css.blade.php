<!-- Favicon and Apple Touch Icons -->
<!-- Favicon -->
<?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
@if($admin_favicon == '')
<link rel="shortcut icon" href="{{ voyager_asset('images/logo-icon.png') }}" type="image/png">
@else
<link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
@endif
<!-- Stylesheets -->

<link rel="stylesheet" href="{{ URL::asset('/frontend/css/plugin.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/lightslider.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/site.css') }}">


<!-- Modernizr -->
<!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->