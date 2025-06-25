<?php
session_start();
$idToken = isset($_SESSION['id_token']) ? $_SESSION['id_token'] : null;

// Destroy session
session_unset();
session_destroy();

// Keycloak logout endpoint
$keycloakLogout = 'https://keycloak.bjochym.solutions/realms/terminal-web-app/protocol/openid-connect/logout';
$postLogoutRedirect = 'https://terminal.bjochym.solutions/logout-success.html';
$clientId = 'terminal-web';

// Build query
$params = [
    'post_logout_redirect_uri' => $postLogoutRedirect,
    'client_id'                => $clientId,
];
if ($idToken) {
    $params['id_token_hint'] = $idToken;
}

// Redirect to Keycloak's logout
header("Location: " . $keycloakLogout . '?' . http_build_query($params));
exit;