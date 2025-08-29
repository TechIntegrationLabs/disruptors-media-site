<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>McDonalds-AdminDashboard</title>
    @include('admin/partials/head')
</head>

<body>
    @include('admin/partials/header')
    <div class="container-fluid admin ">
		<div class="row">
        <div class="col-lg-2 col-md-3 sidebar_admin_col">
		@include('admin/partials/sidebar-nav')
        </div>
        <div class="col-lg-10 col-md-9">
            @yield('content')
        </div>
		</div>
    </div>
</body>

</html>