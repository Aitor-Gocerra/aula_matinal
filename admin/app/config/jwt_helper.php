<?php

/**
 * Decodifica el payload de un JWT sin verificar firma.
 * Solo para extraer datos de presentación (nombre, email).
 */
function jwt_get_payload(string $token): ?array {
    $parts = explode('.', $token);
    if (count($parts) !== 3) return null;

    $payload = base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1]));
    if ($payload === false) return null;

    $decoded = json_decode($payload, true);
    return is_array($decoded) ? $decoded : null;
}

/**
 * Resuelve el token: primero desde $_GET['token'] (llegada desde la intranet),
 * luego desde la cookie. Si llega por URL lo persiste como cookie de sesión.
 */
function jwt_resolve_token(): ?string {
    if (!empty($_POST['token'])) {
        $token = $_POST['token'];
        // Persiste en cookie para el resto de navegación en este dominio
        setcookie('auth_token', $token, 0, '/', '', isset($_SERVER['HTTPS']), true);
        $_COOKIE['auth_token'] = $token;
        return $token;
    }

    return !empty($_COOKIE['auth_token']) ? $_COOKIE['auth_token'] : null;
}

/**
 * Devuelve el nombre del usuario desde el token (URL o cookie).
 */
function jwt_get_nombre(): ?string {
    $token = jwt_resolve_token();
    if (!$token) return null;

    $payload = jwt_get_payload($token);
    if (!$payload) return null;

    return $payload['data']['nombre'] ?? $payload['data']['email'] ?? null;
}
