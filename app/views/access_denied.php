<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
            padding: 20px;
        }
        body.light-mode {
            background-color: #f4f4f9;
            color: #333;
        }
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        #access-denied-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }
        body.dark-mode #access-denied-container {
            background-color: #1e1e1e;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            color: #ff4b4b;
            font-size: 48px;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .ip-info {
            background: linear-gradient(145deg, #c71f1f, #e04d4d);
            color: #ffffff;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .ip-info:hover {
            background: linear-gradient(145deg, #e04d4d, #f76c6c);
            transform: translateY(-2px);
        }
        .g-signin2 {
            margin-top: 20px;
        }
        .toggle-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .toggle-container button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: inherit;
            
        }

    </style>
    <style>
    /* Import Google Fonts */
@import url("//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

/* Heading */
#access-denied-container h1{
 font-family:'Montserrat', sans-serif;
 font-weight:700;
}
/* Info */
#access-denied-container .ip-info{
 font-weight:600;
}

    </style>
    
</head>
<body class="light-mode">
    
    <div id="access-denied-container">
        <h1>Access Denied</h1>
        <p>Your IP address has been blacklisted. If you believe this is a mistake, please contact the site administrator. </p>
        <hr>
        <div class="ip-info">
            Your IP: <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?>
        </div>
        
    </div>
</body>
</html>