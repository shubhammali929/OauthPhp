<?php
namespace Miniorange\Lib;
require_once "OAuthImplicitFlow.php";
require_once "OAuthCodeFlow.php";
require_once "OAuthPkceFlow.php";
function startAuthorisation($config, $grantType){

    $_SESSION['grant_type'] = $grantType;
    $_SESSION['state'] = bin2hex(random_bytes(16)); // Generate a random state for security


    // Handle different grant types
    switch ($grantType) {
        case 'implicit':
            $implicitFlow = new OAuthImplicitFlow($config);
            $implicitFlow->redirectToAuthorization();
            break;

        case 'auth_code':
            $codeFlow = new OAuthCodeFlow($config);
            $codeFlow->redirectToAuthorization();
            break;

        case 'pkce':
            $pkceFlow = new OAuthPkceFlow($config);
            $pkceFlow->redirectToAuthorization();
            break;

        default:
            echo "Invalid grant type!";
            break;
    }
}