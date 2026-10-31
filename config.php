<?php
// Update these settings to match your local MySQL configuration.
define('DB_HOST', 'localhost');
define('DB_NAME', 'capacity_connect');
define('DB_USER', 'root');
define('DB_PASS', '');
if (session_status() === PHP_SESSION_NONE) session_start();
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
    return $pdo;
}
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function logged_in(): bool { return isset($_SESSION['user']); }
function current_user(): array { return $_SESSION['user'] ?? []; }
function require_login(): void { if (!logged_in()) { header('Location: login.php'); exit; } }
function require_role(string ...$roles): void { require_login(); if (!in_array(current_user()['role'] ?? '', $roles, true)) { http_response_code(403); exit('Access denied.'); } }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if ($_SERVER['REQUEST_METHOD'] === 'POST' && !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(419); exit('Session expired. Please go back and try again.'); } }
function flash(string $message, string $type='success'): void { $_SESSION['flash'] = ['message'=>$message, 'type'=>$type]; }
function redirect(string $url): never { header('Location: '.$url); exit; }
