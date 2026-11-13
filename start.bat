@echo off
chcp 65001 >nul
title SMM Panel - Avvio Server
cd /d "%~dp0"

echo ===================================================
echo           SMM PANEL - AVVIO AUTOMATICO
echo ===================================================
echo.

:: 1. Ricerca eseguibile PHP
set "PHP_BIN=php"
where php >nul 2>nul
if %errorlevel% neq 0 (
    if exist "%LOCALAPPDATA%\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" (
        set "PHP_BIN=%LOCALAPPDATA%\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
    ) else (
        echo [!] Errore: PHP non trovato nel sistema.
        pause
        exit /b 1
    )
)

set "MARIADB_DIR=C:\Program Files\MariaDB 13.0"
set "MYSQLD=%MARIADB_DIR%\bin\mysqld.exe"
set "MYSQL_CLI=%MARIADB_DIR%\bin\mysql.exe"
set "MY_INI=%MARIADB_DIR%\data\my.ini"

:: 2. Controllo e avvio MariaDB
echo [*] Verifica stato MariaDB...
tasklist /fi "imagename eq mysqld.exe" | findstr /i "mysqld.exe" >nul
if %errorlevel% neq 0 (
    echo [*] Avvio servizio MariaDB in background...
    if exist "%MYSQLD%" (
        start "MariaDB Database" /B "%MYSQLD%" --defaults-file="%MY_INI%"
        ping -n 4 127.0.0.1 >nul
    ) else (
        echo [!] MariaDB non trovato in %MYSQLD%.
    )
) else (
    echo [OK] MariaDB e' gia' in esecuzione.
)

:: 3. Verifica / applicazione automatica patch database se presenti
if exist "%MYSQL_CLI%" (
    echo [*] Verifica integrita' database smmpanel...
    "%MYSQL_CLI%" -h 127.0.0.1 -P 3306 -u root -proot smmpanel < "%~dp0schema_patch.sql" >nul 2>nul
)

:: 4. Controllo e avvio server PHP
echo [*] Verifica server PHP sulla porta 8000...
netstat -ano | findstr ":8000 " >nul
if %errorlevel% neq 0 (
    echo [*] Avvio server PHP su http://127.0.0.1:8000...
    start "SMM Panel Web Server (NON CHIUDERE)" "%PHP_BIN%" -S 127.0.0.1:8000 router.php
    ping -n 3 127.0.0.1 >nul
) else (
    echo [OK] Server PHP gia' in ascolto sulla porta 8000.
)

:: 5. Apertura automatica browser
echo [*] Apertura browser su http://127.0.0.1:8000...
start "" "http://127.0.0.1:8000"

:: 6. Riepilogo credenziali
echo.
echo ===================================================
echo   Pannello SMM AVVIATO con successo!
echo.
echo   - Sito Web:        http://127.0.0.1:8000
echo   - Registrazione:   http://127.0.0.1:8000/signup
echo   - Admin Panel:     http://127.0.0.1:8000/admin
echo.
echo   Credenziali ADMIN:
echo   - Email:           admin@admin.com
echo   - Password:        admin
echo.
echo   Credenziali CLIENT (Utente di prova):
echo   - Username:        admin
echo   - Password:        admin
echo ===================================================
echo.
echo Premi un tasto o chiudi questa finestra quando hai finito.
echo Per arrestare tutti i servizi puoi eseguire "stop.bat".
echo.
pause
