<?php
//changing ini settings

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

//change cookie parameters
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, //only useable in safe browsers
    'httpOnly' => true //keeps users from changing the setting with code
]);
session_start();

if(isset($_SESSION["id"])){
    if (!isset($_SESSION["last_regeneration"])) {//checking if this session does not exists
        regenerate_session_id_loggedin();
    
    }else{ //else to update every 30 min
        $interval = 60 * 30;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }

}else{ //cookie regeneration function to verify that a the last session id does not exit then update session cookie id every 30 min to prevent attackers from gaining accessa and limit the use to 30 minutes.
    if (!isset($_SESSION["last_regeneration"])) {//checking if this session does not exists
        session_id_regenerate();//checks when the last id was generated
    
    }else{ //else to update every 30 min
        $interval = 60 * 30;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            session_id_regenerate();
        }
    }
}

function regenerate_session_id_loggedin(){
    session_regenerate_id(true);

    $userId = $_SESSION["id"];
    $newSessionId = session_create_id();
    $sessionId=$newSessionId . "_" . $userId;
    session_id($sessionId);
    
    $_SESSION['last_regeneration'] = time(); 
};

function session_id_regenerate(){
    session_regenerate_id(True);
    $_SESSION['last_regeneration'] = time(); 
};

