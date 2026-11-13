<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 Not Found</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Apply Montserrat font globally */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            text-align: center;
            padding: 50px;
        }

        /* 404 Error Number */
        .error-title {
            font-size: 100px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        /* Error Message */
        .error-text {
            font-size: 22px;
            font-weight: 400;
            color: #666;
            margin-bottom: 40px;
        }

        /* Back Button */
        .btn-404 {
            background: linear-gradient(145deg, #007bff, #0056b3);
            color: #ffffff;
            padding: 14px 28px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.2s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-404:hover {
            background: linear-gradient(145deg, #0056b3, #003c82);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    
    <div>
        <h1 class="error-title">404</h1>
        <p class="error-text">Oops! The page you're looking for doesn't exist.</p>
        <a href="/" class="btn-404">Go to Home</a>
    </div>

    <!-- JS Files -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
