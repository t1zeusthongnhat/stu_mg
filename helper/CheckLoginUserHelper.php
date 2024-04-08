<?php
if(!function_exists('isLoginUser')){
    function isLoginUser(){
        $idUser =  getSessionIdUser();//nam o file common.php
        $username = getSessionUserName();
        if(empty($idUser) || empty($username)){
            return false;
        }
        return true;
    }
}
