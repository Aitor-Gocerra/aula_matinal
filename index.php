<?php
// Recibir el token por GET si viene del dashboard
$token = $_GET['token'] ?? null;
$cookieToken = $_COOKIE['auth_token'] ?? null;

if ($token) {
    // Si viene por GET, lo guardamos en la cookie
    setcookie("auth_token", $token, time() + (86400 * 30), "/");
    $cookieToken = $token;
}

// Validar que tengamos un token
if (!$cookieToken && !$token) {
    // Redirigir al login principal
    header("Location: https://07.proyectos.esvirgua.com/");
    exit();
}

// Redirigir por defecto a admin (intentamos extraer el rol del JWT)
$jwt = $token ?: $cookieToken;
$parts = explode('.', $jwt);
$redirectTo = 'admin/';

if (count($parts) === 3) {
    $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
    if (isset($payload['data']['rol']) && $payload['data']['rol'] === 'profesor') {
        $redirectTo = 'user/';
    }
}

header("Location: $redirectTo");
exit();
