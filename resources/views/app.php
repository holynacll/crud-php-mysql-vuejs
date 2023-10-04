<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
        <title>Manage Users</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 flex">
        <?php 
            if(str_contains($_SERVER['REQUEST_URI'], '/address.php'))
                include 'pages/address.php';
            else
                include 'pages/home.php';
        ?>
    </body>
</html>
