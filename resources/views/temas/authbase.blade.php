<!DOCTYPE html>
<html lang="es">

<head>
    <title>Mi Vinculamos</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="Bootstrap 5 based Social Media Network and Community Theme">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/vendor/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Theme CSS -->
    <link id="style-switch" rel="stylesheet" type="text/css"
        href="{{ asset('public/css/style.css') }}">

</head>

<body>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- Container START -->
        @yield('auth-content')
        <!-- Container END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->


    <!-- =======================
JS libraries, plugins and custom scripts -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>

    <!-- Vendors -->
    <script src="{{ asset('public/vendor/pswmeter/pswmeter.min.js') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('public/js/functions.js') }}"></script>

</body>

</html>
