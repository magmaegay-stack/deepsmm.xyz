<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo htmlspecialchars($settings['site_name']); ?> · Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background: #070a12;
            color: #f1f5f9;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0) 70%);
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(5, 150, 105, 0.1) 0%, rgba(5, 150, 105, 0) 70%);
            bottom: -50px;
            right: 10%;
            pointer-events: none;
        }
        
        #login-container {
            background: linear-gradient(180deg, #0f172a 0%, #0a0f1d 100%);
            border-radius: 24px;
            padding: 44px 38px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(16, 185, 129, 0.2);
            position: relative;
            z-index: 2;
            backdrop-filter: blur(20px);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo {
            max-height: 52px;
            max-width: 200px;
            object-fit: contain;
            margin-bottom: 12px;
            filter: drop-shadow(0 4px 14px rgba(16, 185, 129, 0.35));
        }

        .badge-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        h2 {
            text-align: center;
            margin-top: 14px;
            margin-bottom: 6px;
            color: #ffffff;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -0.02em;
        }

        p.subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 24px;
        }
        
        .input-container {
            position: relative;
            margin-bottom: 16px;
        }
        
        .input-container input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            font-size: 14px;
            background-color: rgba(15, 23, 42, 0.6);
            transition: all 0.25s ease;
            color: #f1f5f9;
            font-weight: 500;
        }
        
        .input-container input:focus {
            border-color: #10b981;
            background-color: #0c121e;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.18);
            outline: none;
        }
        
        .input-container input::placeholder {
            color: #64748b;
        }
        
        .input-container .input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 15px;
            transition: color 0.25s ease;
        }
        
        .input-container input:focus + .input-icon {
            color: #10b981;
        }
        
        .form-check-label {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
        }
        
        .form-check-input {
            background-color: #1e293b;
            border-color: rgba(255, 255, 255, 0.15);
        }

        .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
        
        .login-form-btn {
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            margin: 22px 0 10px;
            color: #ffffff;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .login-form-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -5px rgba(16, 185, 129, 0.55);
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
        }
        
        .login-form-btn:active {
            transform: translateY(0);
        }
        
        .password-container {
            position: relative;
        }
        
        .password-container input {
            padding-right: 44px;
        }
        
        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 16px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
            transition: color 0.25s ease;
            font-size: 15px;
        }
        
        .password-container .toggle-password:hover {
            color: #10b981;
        }
        
        .alert {
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 600;
            border: none;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .back-link {
            text-align: center;
            margin-top: 14px;
        }

        .back-link a {
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: #10b981;
        }
    </style>
</head>
<body>
    <div id="login-container">
        <div class="brand-header">
            <div>
                <img src="/public/Eternity/logo.png" alt="DeepSMM" class="brand-logo" onerror="this.src='/public/Eternity/deepsmm-logo.png'">
            </div>
            <span class="badge-admin"><i class="fas fa-shield-alt"></i> Area Amministratore</span>
            <h2>Accesso Pannello</h2>
            <p class="subtitle">Inserisci le credenziali di amministrazione</p>
        </div>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle me-1"></i> <?php echo $successText; ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-1"></i> <?php echo $errorText; ?></div>
        <?php endif; ?>
        
        <form name="login-form" action="#" method="post">
            <div class="input-container">
                <input class="login-form-input" type="email" name="email" placeholder="Email admin" value="admin@admin.com" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>
            
            <div class="input-container password-container">
                <input class="login-form-input" type="password" name="password" placeholder="Password" value="admin" required>
                <i class="fas fa-lock input-icon"></i>
                <i class="fas fa-eye toggle-password"></i>
            </div>
            
            <div class="input-container" style="display:none;">
                <input class="login-form-input" type="number" name="two_factor_code" placeholder="Codice 2FA (se attivo)">
                <i class="fas fa-key input-icon"></i>
            </div>
            
            <div class="form-check d-flex align-items-center">
                <input type="checkbox" class="form-check-input" name="remember" id="remember-me" checked>
                <label class="form-check-label ms-2" for="remember-me">Resta connesso</label>
            </div>
            
            <button class="login-form-btn" type="submit" name="submit">
                <i class="fas fa-sign-in-alt"></i> Accedi come Admin
            </button>
        </form>

        <div class="back-link">
            <a href="/"><i class="fas fa-arrow-left me-1"></i> Torna al sito principale</a>
        </div>
    </div>
    
    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('input[name="password"]');
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>
</html>
