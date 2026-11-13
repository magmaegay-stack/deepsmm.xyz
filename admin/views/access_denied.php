<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 20px;
            position: relative;
        }

        body.light-mode {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #333;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #121212 0%, #1a1a1a 100%);
            color: #e0e0e0;
        }

        #access-denied-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.05);
            position: relative;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        body.dark-mode #access-denied-container {
            background: #1e1e1e;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 1px 3px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        #access-denied-container:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 1px 3px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode #access-denied-container:hover {
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.4),
                0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .icon-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #ff4b4b, #e04d4d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(255, 75, 75, 0.3);
            position: relative;
            overflow: hidden;
        }

        .icon-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .icon-container:hover::before {
            left: 100%;
        }

        .icon-container i {
            font-size: 36px;
            color: white;
            z-index: 1;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #ff4b4b;
            font-size: 48px;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(255, 75, 75, 0.1);
            line-height: 1.1;
        }

        .subtitle {
            color: #666;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        body.dark-mode .subtitle {
            color: #b0b0b0;
        }

        .ip-info {
            background: linear-gradient(135deg, #c71f1f, #e04d4d);
            color: #ffffff;
            padding: 18px 28px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            box-shadow: 
                0 8px 24px rgba(199, 31, 31, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .ip-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .ip-info:hover::before {
            left: 100%;
        }

        .ip-info:hover {
            background: linear-gradient(135deg, #e04d4d, #f76c6c);
            transform: translateY(-2px);
            box-shadow: 
                0 12px 32px rgba(199, 31, 31, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 32px 0;
            border: none;
        }

        body.dark-mode .divider {
            background: linear-gradient(90deg, transparent, #374151, transparent);
        }

        .google-signin-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .g_id_signin {
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.1));
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .g_id_signin:hover {
            transform: translateY(-2px);
            filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.15));
        }

        .toggle-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .toggle-container button {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            width: 48px;
            height: 48px;
            cursor: pointer;
            font-size: 18px;
            color: #666;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .toggle-container button {
            background: #2a2a2a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .toggle-container button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: #f8f9fa;
        }

        body.dark-mode .toggle-container button:hover {
            background: #333;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            #access-denied-container {
                padding: 32px 24px;
                margin: 16px;
                border-radius: 16px;
            }

            h1 {
                font-size: 40px;
            }

            .subtitle {
                font-size: 16px;
            }

            .icon-container {
                width: 64px;
                height: 64px;
                margin-bottom: 20px;
            }

            .icon-container i {
                font-size: 28px;
            }

            .ip-info {
                padding: 16px 24px;
                font-size: 15px;
            }

            .toggle-container {
                top: 16px;
                right: 16px;
            }

            .toggle-container button {
                width: 44px;
                height: 44px;
                font-size: 16px;
            }
        }

        /* Animation for page load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #access-denied-container {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Google Sign-in styling */
        .g_id_signin div {
            border-radius: 8px !important;
        }

        .g_id_signin div span {
            font-family: 'Inter', sans-serif !important;
            font-weight: 500 !important;
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        function handleCredentialResponse(response) {
            const responsePayload = decodeJwtResponse(response.credential);
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'google_token';
            input.value = response.credential;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        function decodeJwtResponse(token) {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            return JSON.parse(jsonPayload);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggle-mode');
            const body = document.body;
            const currentMode = localStorage.getItem('mode') || 'light-mode';
            body.classList.add(currentMode);

            toggleButton.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                body.classList.toggle('light-mode');
                const newMode = body.classList.contains('dark-mode') ? 'dark-mode' : 'light-mode';
                localStorage.setItem('mode', newMode);
                toggleButton.innerHTML = newMode === 'dark-mode' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            });

            toggleButton.innerHTML = currentMode === 'dark-mode' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });
    </script>
</head>
<body class="light-mode">
    <div class="toggle-container">
        <button id="toggle-mode" aria-label="Toggle dark mode">
            <i class="fas fa-moon"></i>
        </button>
    </div>
    
    <div id="access-denied-container">
        <div class="icon-container">
            <i class="fas fa-shield-alt"></i>
        </div>
        
        <h1>Access Denied</h1>
        <p class="subtitle">Your IP address is not authorized to access this page.</p>
        
        <div class="ip-info">
            <i class="fas fa-map-marker-alt"></i>
            Your IP: <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?>
        </div>
        
        
        
        <div class="d-flex justify-content-center">
            <div class="google-signin-wrapper">
                <div id="g_id_onload"
                     data-client_id="<?php echo htmlspecialchars($google_client_id); ?>"
                     data-callback="handleCredentialResponse">
                </div>
                <div class="g_id_signin" data-type="standard"></div>
            </div>
        </div>
    </div>
</body>
</html>