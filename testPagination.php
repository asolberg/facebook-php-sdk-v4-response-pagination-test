<?php

const FACEBOOK_APP_ID = '';
const FACEBOOK_APP_SECRET = '';
const USER_ACCESS_TOKEN = '';
const MAX_PAG_LOOPS = 2;

require_once './vendor/autoload.php';
Facebook\FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);

$fb_token = new Facebook\Entities\AccessToken(USER_ACCESS_TOKEN);
$fb_session = new Facebook\FacebookSession($fb_token);

$response = (new Facebook\FacebookRequest(
    $fb_session,
    'GET',
    '/me/photos/uploaded'
))->execute();

$i = 0;
while ($next_request = $response->getRequestForNextPage()){
    $response = $next_request->execute();
    $i++;
    if($i > MAX_PAG_LOOPS){
        break;
    }
}



?>