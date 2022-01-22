<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script type="text/javascript">
        var baseurl = "<?php echo url('/'); ?>";
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>


    @include('frontend.layouts.css')
    @include('frontend.layouts.js_head')

    @yield('headcss')

</head>

<body style="background:#DFF0F9 !important;">
    @include('frontend.layouts.header')

    <div class="frontend_content">
        <div class="extra_pad">
            @yield('content')
        </div>
    </div>

    @include('frontend.layouts.footer')
    @include('frontend.layouts.js')
    @yield('cusjs')
</body>

</html>