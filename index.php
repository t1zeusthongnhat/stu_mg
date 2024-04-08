<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
} 
require 'helper/UploadFileHelper.php';
require 'helper/Common.php';
require 'helper/CheckLoginUserHelper.php';

define("ROOT_PATH","index.php");
if(file_exists("route/web.php"))
{
    require "route/web.php";
}
else
{
    die("Sory, website can not access");
    
}