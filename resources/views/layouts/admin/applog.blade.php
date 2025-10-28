<!DOCTYPE html>
<html lang="en">

<head>

   <style>
    body {
        background: url('{{ asset('assets/assets-admin/images/auth/bg.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-form-light {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        max-width: 450px; /* agar tidak terlalu sempit */
        width: 100%;
    }

    .content-wrapper.auth {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin - Login</title>
    <!-- plugins:css -->
   @include('layouts.admin.csslog')

</head>

<body>
    @yield('content')
    <!-- plugins:js -->
    @include('layouts.admin.jslog')
</body>

</html>
