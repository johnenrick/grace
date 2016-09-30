<?php

/* Created by John Enrick Pleños */
function generateToken($userID, $userType, $username){
    $CI =& get_instance();
    $tokenContent = array(
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "date_created" => time(),
        "max_life" => 60*60*4, //4 hours life
        "user_ID" => $userID,
        "user_type" => $userType,
        "username" => $username
    );
    return $CI->encryption->encrypt(json_encode($tokenContent));
}
function decodeToken($token){
    if($token){
        $CI =& get_instance();
        $token = json_decode($CI->encryption->decrypt($token), true);
        if((time() - $token["date_created"]*1) <= $token["max_life"]){
            return $token;
        }else{//Expired Token
            return -1;
        }
    }else{
        return false;
    }
}
