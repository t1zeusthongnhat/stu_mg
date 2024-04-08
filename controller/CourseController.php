<?php

require 'model/DepartmentModel.php';
require 'model/CourseModel.php';

//m = ten cua ham nam trong thu muc controller
$m = trim($_GET['m'] ?? 'index'); //ham mac dinh trong controller la index
$m = strtolower($m); //viet thuong tat ca ten ham

switch ($m) 
{
    case 'index':
        index();
        break;
    case 'add':
        Add();
        break;
    case 'handle-add':
        handleAdd();
        break;
    case 'delete':
        handleDelete();
        break;
    case 'edit':
        edit();
        break;
    case 'handle-edit':
        handleEdit();
        break;
default:
index();
break;
}
function handleEdit(){
    if(isset($_POST['btnSave'])){

        $id = trim($_GET['id'] ?? null);
        $id = is_numeric($id) ? $id : 0;
        $info = getDetailCourseById($id);

        $name = trim($_POST['name']??null);
        $name = strip_tags($name);

        $department_id = trim($_POST['department_id']??null);
        

        $status = trim($_POST['status']??null);
        $status = $status === '0' || $status === '1' ? $status :0;


    
        //kiem tra thong tin
        $_SESSION['error_course_department'] = [];
        if(empty($name)){
            $_SESSION['error_course_department']['name'] = 'Enter name of course, please';
        } else {
            $_SESSION['error_course_department']['name'] = null;
        }

        $flagCheckingError = false;
        foreach($_SESSION['error_course_department'] as $error){
            if(!empty($error)){
                $flagCheckingError=true;
                break;

            }
        }


        if(!$flagCheckingError){
            //khong co loi-insert du lieu vao dtb
            if(isset($_SESSION['error_course_department'])){
                unset($_SESSION['error_course_department']);
            }

            $slug = slug_string($name);
            $update = updateCourseById($name, $slug,$department_id, $status, $id);
            if($update){
                //update thanh cong
                header("Location:index.php?c=course&state=success");
            } else{
                header("Location:index.php?c=course&m=edit&id={$id}&state=error");
            }
        } 
        else {
            //co loi, cho quay lai form
            header("Location:index.php?c=course&m=edit&id={$id}&state=failure");
        }
    }
    // if(isset($_POST['btnSave'])){
    //     echo '<pre>';
    //     print_r($_POST);
    // }

}

function edit(){
     // phai dang nhap moi duoc su dung chuc nang nay.
     if(!isLoginUser()){
        header("Location:index.php");
        exit();
    }
    
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0; // is_numeric : kiem tra co phai la so hay ko ?
    $info = getDetailCourseById($id); // goi ham trong model
    if(!empty($info)){
        // co du lieu trong database
        // hien thi giao dien - thong tin chi tiet du lieu
        $department = getDataDepartment();
        require 'view/course/edit_view.php';
    } else {
        // khong co du lieu trong database
        // thong bao 1 giao dien loi
        require 'view/error_view.php';
    }
}
function handleDelete(){
    if(!isLoginUser())
    {
        header ("Location:index.php");
        exit();
    }

    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;


    $delete = deleteCourseById($id);
    if($delete){
        //xoa thanh cong
        header("Location:index.php?c=course&state_del=success");
    }
    else{
        //xoa that bai
        header("Location:index.php?c=course&state_del=failure");


    }
}
function handleAdd(){
    
    if(isset($_POST['btnSave'])){
        $name = trim($_POST['name']??null);
        $name = strip_tags($name);

        $department_id = trim($_POST['department_id']??0);
        $status = trim($_POST['status']??null);
        $status = $status === '0' || $status === '1' ? $status :0;

      

        //kiem tra thong tin
        $_SESSION['error_add_course'] = [];
        if(empty($name)){
            $_SESSION['error_add_course']['name'] = 'Enter name of course, please';
        } else {
            $_SESSION['error_add_course']['name'] = null;
        }
        

        $flagCheckingError = false;
        foreach($_SESSION['error_add_course'] as $error){
            if(!empty($error)){
                $flagCheckingError=true;
                break;

            }
        }

        //tien hanh check lai
        if(!$flagCheckingError){
            //tien hanh insert vao dtb
            $slug = slug_string($name);
            $insert = addNewCourse($name, $slug, $department_id, $status);
            if($insert){
                header("Location:index.php?c=course&state=success");
            }
            else{
                header("Location:index.php?c=course&m=add&state=error");

            }
        }
        else{
            //thong bao loi cho ng dung biet
            header("Location:index.php?c=course&m=add&state=fail");
        }
    }
    
}
function index()
{
    //phai dang nhap moi su dung duoc chuc nang nay
    if(!isLoginUser())
    {
        header ("Location:index.php");
        exit();
    }
    $keyword = trim($_GET['search']??null);
    $keyword = strip_tags($keyword);

    $departmentName =[];
    $department = getDataDepartment();
    foreach($department as $departments){
        $departmentName[$departments['id']]=$departments['name'];
    }


    $page = trim($_GET['page'] ?? null);
    $page = (is_numeric($page) && $page > 0) ? $page : 1;
    $linkPage = createLink([
        'c' => 'course',
        'm' => 'index',
        'page' => '{page}',
        'search' => $keyword
    ]);
    $totalItems = getAllDataCourses($keyword); // goi ten ham trong model
    $totalItems = count($totalItems);
    // courses
    $panigate = pagigate($linkPage, $totalItems, $page, $keyword, 2);
    $start = $panigate['start'] ?? 0;
    $courses = getAllDataDCoursesByPage($keyword, $start, 4);
    $htmlPage = $panigate['pagination'] ?? null;
    require ('view/course/index_view.php');
}
function Add(){
        $department = getDataDepartment();
        require 'view/course/add_view.php';
   
}