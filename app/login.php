<?php
session_start();

require __DIR__ . '/vendor/autoload.php'; 
use Jumbojett\OpenIDConnectClient;

try {
    $oidc = new OpenIDConnectClient(
        'https://keycloak.bjochym.solutions/realms/terminal-web-app',
        'terminal-web',                                // Client ID from keycloak
        'https://terminal.bjochym.solutions/login-php.php' // Redirect URI
        'tajne moze kiedys podam'              // Client Secret from keycloak
    );

    $oidc->setTokenEndpointAuthMethodsSupported(['client_secret_post']);

    $oidc->addScope(['openid','email','profile']);

    // (Optional) If needed, set a specific redirect:
    // $oidc->setRedirectURL('https://terminal.bjochym.solutions/login.php');

    $oidc->authenticate();

    // Fetch user info
    $username = $oidc->requestUserInfo('preferred_username');
    $idToken  = $oidc->getIdToken();

    $_SESSION['user']     = $username;
    $_SESSION['id_token'] = $idToken;

    header('Location: choose.php');
    exit;
} catch (\Exception $e) {
    error_log("OIDC Error: ".$e->getMessage());
    header('Location: error.php');
    exit;
}