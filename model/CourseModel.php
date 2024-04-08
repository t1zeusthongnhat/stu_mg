<?php
require_once 'database/database.php';


function countCourses() {
    // Kết nối cơ sở dữ liệu
    $db = mysqli_connect("localhost", "root", "", "students_manager");
    // Truy vấn để đếm số lượng bản ghi
    $sql = "SELECT COUNT(*) FROM courses WHERE deleted_at IS NULL";
    // Thực thi truy vấn
    $result = mysqli_query($db, $sql);
    // Kiểm tra kết quả và trả về số lượng bản ghi
    if ($result) {
        // Lấy dòng kết quả
        $row = mysqli_fetch_array($result);
        
        // Lấy giá trị đếm từ dòng kết quả
        $count = $row[0];

        // Giải phóng bộ nhớ của kết quả
        mysqli_free_result($result);

        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($db);

        // Trả về số lượng bản ghi
        return $count;
    } else {
        // Đóng kết nối cơ sở dữ liệu nếu có lỗi
        mysqli_close($db);

        // Trả về 0 nếu có lỗi trong quá trình truy vấn
        return 0;
    }
}
function getAllDataDCoursesByPage($keyword = null, $start = 0, $limit = 4){
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `courses` WHERE (`name` LIKE :nameCourse ) AND `deleted_at` IS NULL  LIMIT :startData, :limitData";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameCourse', $key, PDO::PARAM_STR);
        $stmt->bindParam(':startData', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limitData', $limit, PDO::PARAM_INT);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}
function getAllDataCourses($keyword = null){
    $db   = connectionDb();
    $key  = "%{$keyword}%";
    $sql  = "SELECT * FROM `courses` WHERE (`name` LIKE :nameCourse) AND `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameCourse', $key, PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}
function CountMemberCourse(){
    $conn = mysqli_connect("localhost", "root", "", "students_manager");
       // Truy vấn SQL để đếm số bản ghi của bảng
       $sql = "SELECT COUNT(*) AS totalRecords FROM `courses` WHERE `deleted_at` IS NULL";
       // Thực thi truy vấn
       $result = mysqli_query($conn, $sql);
    
       // Kiểm tra xem có lỗi không
       if(!$result) {
           // Xử lý lỗi nếu có
           echo "Error: " . mysqli_error($conn);
           return false;
       } else {
           // Lấy số bản ghi đếm được
           $row = mysqli_fetch_assoc($result);
           $totalRecords = $row['totalRecords'];
           return $totalRecords;
       }
     
    disconnectDb($conn);
    }
function addNewCourse($name, $slug, $department_id, $status)
{
   
    $sql = "INSERT INTO courses (name,slug, department_id, status, created_at) 
            VALUES (:name,:slug, :department_id, :status, NOW())";
    $conn = connectionDb();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':department_id', $department_id);
    $stmt->bindParam(':status', $status);
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}
function deleteCourseById($id) {
    $sql = "UPDATE courses SET deleted_at = NOW() WHERE id = :id";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();
    disconnectDb($db);
    return $success;
}


function updateCourseById($name, $slug,$department_id, $status, $id)
{
    $checkUpdate = false;
    $db = connectionDb();
    $sql = "UPDATE courses SET name = :name,slug = :slug , department_id = :department_id, status = :status, updated_at = NOW() WHERE id = :id";
    $stmt = $db->prepare($sql);
    if ($stmt) {
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $checkUpdate = true;
        }
    }
    return $checkUpdate;
}


function getDetailCourseById($id=0){
    $sql = "SELECT * FROM `courses` WHERE `id` = :id AND `deleted_at` IS NULL";
    $db = connectionDb();
    $data=[];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $data = $stmt->fetch(PDO::FETCH_ASSOC); 
        }
    }
    disconnectDb($db);
    return $data;
}



function getAllCourses($keyword=null){
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `courses` WHERE (`name` LIKE :nameCourse OR `leader` LIKE :leader) AND `deleted_at` IS NULL";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameCourse', $key, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $key, PDO::PARAM_STR);
        if($stmt->execute()){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    disconnectDb($db);
    return $data;
}
function getAllCoursesFromDB() {
    $db = connectionDb(); 
    $sql = "SELECT * FROM courses WHERE deleted_at IS NULL";
    $stmt = $db->prepare($sql);
    $stmt->execute();   
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    disconnectDb($db); 
    return $courses; 
}


function insertCourse($name, $departmentId, $status, $beginningDate){
    
    $slug = slug_string($name);

    $sqlInsert = "INSERT INTO courses(`name`, `slug`, `department_id`, `date_beginning`, `status`, `created_at`) VALUES (:nameCourse, :slug, :departmentId, :beginningDate, :statusCourse, :createdAt)";
$checkInsert = false;
    $db = connectionDb();
    $stmt = $db->prepare($sqlInsert);
    $currentDate = date('Y-m-d H:i:s');
    
    if($stmt){
        $stmt->bindParam(':nameCourse', $name, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindParam(':departmentId', $departmentId, PDO::PARAM_INT);
        $stmt->bindParam(':beginningDate', $beginningDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusCourse', $status, PDO::PARAM_INT);
        $stmt->bindParam(':createdAt', $currentDate, PDO::PARAM_STR);
        
        if($stmt->execute()){
            $checkInsert = true;
        }
    }
    disconnectDb($db);
    
   
    return $checkInsert;
}


function searchCoursesByProduct($keyword = null){
    if(isset($_GET['pages'])){
        $pages = $_GET['pages'];
    }
    else{
        $pages=1;
    }
    //so ban ghi tren 1 trang
    $row = 4;
    //vi tri bat dau lay ra cac ban ghi
    $from=($pages-1) * $row;
    $db = connectionDb();
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `courses` WHERE (`name` LIKE :nameCourse) AND `deleted_at` IS NULL LIMIT $from,$row ";
    $stmt = $db->prepare($sql);
    $data =[];
    if($stmt){
        $stmt->bindParam(':nameCourse', $key,PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    }
    disconnectDb($db);
    return $data;
}
// function searchCou($keyword = null){
//     $db = connectionDb();
//     $key = "%{$keyword}%";
//     $sql = "SELECT * FROM `courses` WHERE (`name` LIKE :nameCourse) AND `deleted_at` IS NULL  ";
//     $stmt = $db->prepare($sql);
//     $data =[];
//     if($stmt){
//         $stmt->bindParam(':nameCourse', $key,PDO::PARAM_STR);
//         if($stmt->execute()){
//             if($stmt->rowCount() > 0){
//                 $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//             }
//     }
//     }
//     disconnectDb($db);
//     return $data;
// }



