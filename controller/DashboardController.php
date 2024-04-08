<?php
//m = ten cua ham nam trong thu muc controller
$m = trim($_GET['m'] ?? 'index'); //ham mac dinh trong controller la index
$m = strtolower($m); //viet thuong tat ca ten ham

switch ($m) 
{
    case 'index':
        index();
        break;
default:
index();
break;
}
function index()
{
    //phai dang nhap moi su dung duoc chuc nang nay
    if(!isLoginUser())
    {
        header ("Location:index.php");
        exit();
    }
    require ('view/dashboard/index_view.php');
}