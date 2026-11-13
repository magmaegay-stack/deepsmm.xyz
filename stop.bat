@echo off
chcp 65001 >nul
title SMM Panel - Arresto
cd /d "%~dp0"

echo ===================================================
echo           SMM PANEL - ARRESTO SERVIZI
echo ===================================================
echo.

echo [*] Chiusura server PHP...
taskkill /f /im php.exe >nul 2>nul

echo [*] Chiusura MariaDB...
taskkill /f /im mysqld.exe >nul 2>nul

echo [OK] Tutti i servizi sono stati arrestati.
ping -n 3 127.0.0.1 >nul
