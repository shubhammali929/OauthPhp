<?php
namespace Miniorange\Lib;
use \Exception;
require_once 'config.php';
require_once 'OAuthApiClient.php';
require_once 'LoginSuccessListener.php'; // Ensure you include this if it’s needed for MyLoginSuccessListener

function authenticateUserWithPasswordGrant($username, $password, $config) {
    $client = new OAuthApiClient($config); // Create OAuthApiClient instance

    try {
        // Automatically gets access token and user info
        $userInfo = $client->getAccessTokenWithPassword($username, $password);

        // Convert array to object
        $userInfoObject = json_decode(json_encode($userInfo));

        // Pass the object to the login success listener
        $loginSuccessListener = new MyLoginSuccessListener();
        $loginSuccessListener->onLoginSuccess($userInfoObject);

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
