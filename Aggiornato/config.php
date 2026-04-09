<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) { session_start(); }
date_default_timezone_set('Europe/Rome');
const DB_HOST='localhost'; const DB_NAME='snorlax'; const DB_USER='root'; const DB_PASS=''; const DB_CHARSET='utf8mb4';
function db(): PDO { static $pdo=null; if($pdo instanceof PDO){return $pdo;} $dsn='mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET; $pdo=new PDO($dsn, DB_USER, DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]); return $pdo; }
function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function is_logged_in(): bool { return isset($_SESSION['user']['id_utente']); }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_login(): void { if(!is_logged_in()){ header('Location: '.url_with_lang('login.php')); exit; } }
function redirect(string $url): void { header('Location: '.$url); exit; }
function flash_set(string $type,string $message): void { $_SESSION['flash']=['type'=>$type,'message'=>$message]; }
function flash_get(): ?array { if(!isset($_SESSION['flash'])) return null; $f=$_SESSION['flash']; unset($_SESSION['flash']); return $f; }
function menu_active(string $key,string $current): string { return $key===$current ? 'active' : ''; }
function available_languages(): array {
    return [
        'it' => 'Italiano',
        'en' => 'English',
        'es' => 'Español',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'pt' => 'Português',
    ];
}
function current_lang_code(): string {
    static $langCode = null;
    if ($langCode !== null) return $langCode;
    $available = available_languages();
    $requested = $_GET['lang'] ?? $_SESSION['lang'] ?? 'it';
    $langCode = array_key_exists($requested, $available) ? $requested : 'it';
    $_SESSION['lang'] = $langCode;
    return $langCode;
}
function load_lang(string $langCode): array {
    $file = __DIR__ . '/lang/' . $langCode . '.php';
    if (!file_exists($file)) $file = __DIR__ . '/lang/it.php';
    $lang = require $file;
    return is_array($lang) ? $lang : [];
}
function lang_data(): array {
    static $lang = null;
    if ($lang !== null) return $lang;
    $lang = load_lang(current_lang_code());
    return $lang;
}
function t(string $key, array $replace = []): string {
    $text = lang_data()[$key] ?? $key;
    foreach ($replace as $k => $v) {
        $text = str_replace('{' . $k . '}', (string)$v, $text);
    }
    return $text;
}
function url_with_lang(string $path, array $extraQuery = []): string {
    $query = array_merge($_GET, $extraQuery, ['lang' => current_lang_code()]);
    return $path . '?' . http_build_query($query);
}
function current_page_url_for_lang(string $langCode): string {
    $path = basename($_SERVER['PHP_SELF'] ?? 'home.php');
    $query = $_GET;
    $query['lang'] = $langCode;
    return $path . '?' . http_build_query($query);
}
