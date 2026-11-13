$mariadbDir = "C:\Program Files\MariaDB 13.0"
$mysqld = "$mariadbDir\bin\mysqld.exe"
$myIni = "$mariadbDir\data\my.ini"

# Start MariaDB if not already running
$dbProc = Get-Process -Name mysqld -ErrorAction SilentlyContinue
if (-not $dbProc) {
    Write-Host "Starting MariaDB..."
    $dbProc = Start-Process -FilePath $mysqld -ArgumentList "--defaults-file=`"$myIni`"" -PassThru -WindowStyle Hidden
    Start-Sleep -Seconds 3
}

# Find PHP
$phpBin = "php"
if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    $phpBin = "$env:LOCALAPPDATA\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
}

Write-Host "Starting PHP server on 127.0.0.1:8000..."
Set-Location "C:\Users\mr.opsec\Desktop\smmpanel"
& $phpBin -S 127.0.0.1:8000 router.php
