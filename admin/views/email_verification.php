
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($settings['site_name']); ?> Admin Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        /* Import Google Fonts */
        @import url("//fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap");

        /* Auth container */
        .auth-container {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8f9fa; /* Light theme background */
            color: #333333; /* Darker text */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .auth-header h5, .auth-header h6 {
            margin-bottom: 10px;
        }

        .auth-header h5 {
            font-weight: 600;
        }

        .input-group .form-label {
            font-weight: 500;
            color: #555;
            text-align: left;
            display: block;
        }

        .form-control {
            box-shadow: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-primary, .btn-warning {
            font-size: 1rem;
            padding: 12px 20px;
            font-weight: 500;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #0056b3, #004494); /* Darker gradient on hover */
            transform: translateY(-2px);
        }

        .alert {
            margin-top: 15px;
        }

        /* Button */
        .form-container form .btn-primary {
            background-color: #0d6efd;
        }

        /* Strong Tag */
        .form-container p strong {
            color: #0d6efd !important;
        }

        /* Heading */
        .form-container form h5 {
            font-weight: 600;
        }

        /* Paragraph */
        .form-container form p {
            font-weight: 600;
        }

        /* Strong Tag */
        .form-container p strong {
            font-weight: 600;
        }

        /* Button */
        .form-container .d-grid a {
            background: linear-gradient(145deg, #c71f1f, #e04d4d); /* Gradient background for a professional look */
            color: #ffffff; /* Text color */
            padding: 14px 28px;
            font-size: 14px; /* Font size */
            font-weight: 500; /* Font weight */
            border: none; /* Remove default border */
            border-radius: 5px; /* Slightly rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
            transition: background 0.3s ease, transform 0.2s ease; /* Smooth transition for hover effects */
        }

        .form-container .d-grid a:hover {
            color: #ffffff !important; /* Text color */
            background: linear-gradient(145deg, #e04d4d, #f76c6c); /* Darker gradient on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }
        .form-container .d-grid a {
   
    font-size: unset !important;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="form-container">
            <form action="<?php echo site_url("$rentaladmin/email_verification")?>" method="POST">
                <h5>Verify Your Identity</h5>
                <h6>Please enter the OTP sent to your email to complete the login process.</h6>
                <div class="mb-3">
                    <label class="form-label" for="otp">Enter OTP :</label>
                    <input id="otp" type="text" class="form-control" name="otp" placeholder="OTP" autocomplete="off">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Verify</button>
                    <a class="btn btn-warning" href="<?= site_url("$rentaladmin/logout") ?>">Logout</a>

                </div>
                <?php if (isset($error) && $error == 1): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $errorText; ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>