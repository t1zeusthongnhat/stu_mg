<?php
require 'model/LoginModel.php'; //import model
//m = ten cua ham nam trong thu muc controller
$m = trim($_GET['m'] ?? 'index'); //ham mac dinh trong controller la index
$m = strtolower($m); //viet thuong tat ca ten ham
switch($m){
    case 'index':
        index();
    break;
    case 'handle':
        handleLogin();
        break;
    // case 'signup'
    //     handleSignUp();
    //     break;
    case 'logout':
        handleLogout();
        break;
    default:
        index();
    break;

}
function handleLogout(){

    if(isset($_POST['btnLogout'])){
        //huy session
        session_destroy();

        //quay ve trang dang nhap
        header("Location:index.php");
    }
}

function index()
{
    if(isLoginUser()){
        header("Location:index.php?c=dashboard");
        exit();
    }
    require  "view/login/index_view.php";
}
function handleSignUp(){
    if(isset($_POST['btnSignup']))
    {
    

        


    }
        else{
            //tk k ton tai
            //quay lai trang dang nhap va thong bao loi
            header ('location:index.php?state=error');
        }
      
    }



function handleLogin()
{
    //kiem tra dung bam submit hay chua
    if(isset($_POST['btnLogin']))
    {
    
        $username = trim($_POST['username'] ?? null);
        $username = strip_tags($username); // strips_tag: xoa the html trong chuoi

        $password = trim($_POST['password'] ?? null);
        $password = strip_tags($password);
        

        $userInfo = checkLoginUser($username, $password);
        if(!empty($userInfo))
        {
            //tai khoan co ton tai
            //luu tt ng dung vao session
            $_SESSION['username'] = $userInfo['username'];
            $_SESSION['password'] = $userInfo['password'];
            $_SESSION['fullname'] = $userInfo['full_name'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['idUser'] = $userInfo['user_id'];
            $_SESSION['roleid'] = $userInfo['role_id'];
            $_SESSION['idAccount'] = $userInfo['id'];
            // cho vao trang quan tri
            header("Location:index.php?c=dashboard");


        }
        else{
            //tk k ton tai
            //quay lai trang dang nhap va thong bao loi
            header ('location:index.php?state=error');
        }
      
    }

}