<?php
require_once 'database/database.php';


function getAllDepartments(){
    
    $sql = "SELECT id, name FROM departments WHERE deleted_at IS NULL";
    $db = connectionDb();
    $data = [];
    $stmt = $db->prepare($sql);
    if($stmt){
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}

function getCourseById($course_id){
    $sql = "SELECT * FROM courses WHERE id = :course_id";
    $db = connectionDb();
    $data = [];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':course_id', $key, PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;

    
}
function getAllDataDepartmentsByPage($keyword = null, $start = 0, $limit = 4){
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `departments` WHERE (`name` LIKE :nameDepartment OR `leader` LIKE :leader ) AND `deleted_at` IS NULL  LIMIT :startData, :limitData";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameDepartment', $key, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $key, PDO::PARAM_STR);
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
function account(){
     // Kết nối cơ sở dữ liệu
     $db = mysqli_connect("localhost", "root", "", "students_manager");
     // Truy vấn để đếm số lượng bản ghi
     $sql = "SELECT COUNT(*) FROM accounts WHERE deleted_at IS NULL";
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
function countUser() {
    // Kết nối cơ sở dữ liệu
    $db = mysqli_connect("localhost", "root", "", "students_manager");
    // Truy vấn để đếm số lượng bản ghi
    $sql = "SELECT COUNT(*) FROM users WHERE deleted_at IS NULL";
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
function countDepartments() {
    // Kết nối cơ sở dữ liệu
    $db = mysqli_connect("localhost", "root", "", "students_manager");
    // Truy vấn để đếm số lượng bản ghi
    $sql = "SELECT COUNT(*) FROM departments WHERE deleted_at IS NULL";
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





function updateDepartmentById( $name,$slug,$leader,$status,$beginDate, $logo,$id){
    $checkUpdate = false;
    $db = connectionDb();
    $sql = "UPDATE `departments` SET `name` = :nameDepartment, `slug` = :slug, `leader` = :leader, `date_beginning` = :beginDate, `status` = :statusDepartment, `logo` = :logo, `updated_at` = :updated_at WHERE `id` = :id AND `deleted_at` IS NULL";
    $updateTime = date('Y-m-d H:i:s');
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':nameDepartment',$name, PDO::PARAM_STR);
        $stmt->bindParam(':slug',$slug, PDO::PARAM_STR);
        $stmt->bindParam(':leader',$leader, PDO::PARAM_STR);
        $stmt->bindParam(':beginDate',$beginDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusDepartment',$status, PDO::PARAM_INT);
        $stmt->bindParam(':logo',$logo, PDO::PARAM_STR);
        $stmt->bindParam(':updated_at',$updateTime, PDO::PARAM_STR);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkUpdate = true;
        }
    }
    disconnectDb($db);

    return $checkUpdate;
}
function getDetailDepartmentById($id = 0){
   
    $sql = "SELECT * FROM `departments` WHERE `id` = :id AND `deleted_at` IS NULL";
    $db = connectionDb();
    $data = [];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}


function deleteDepartmentById($id = 0 ){
    $sql ="UPDATE `departments` SET `deleted_at` = :deleted_at WHERE `id` = :id";
    $db = connectionDb();
    $checkDelete = false;
    $deleteTime = date("Y-m-d H:i:s");
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':deleted_at', $deleteTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete =true;
        }
    }
    disconnectDb($db);
    return $checkDelete;
}
function CountMember(){
$conn = mysqli_connect("localhost", "root", "", "students_manager");
   // Truy vấn SQL để đếm số bản ghi của bảng
   $sql = "SELECT COUNT(*) AS totalRecords FROM `departments` WHERE `deleted_at` IS NULL";
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
function getDataDepartment(){
    $db = connectionDb();
    $sql = "SELECT * FROM `departments` WHERE `deleted_at` IS NULL ";
    $stmt = $db->prepare($sql);
    $data =[];
    if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    disconnectDb($db);
    return $data;
}

function getAllDataDepartments($keyword = null){
    $db   = connectionDb();
    $key  = "%{$keyword}%";
    $sql  = "SELECT * FROM `departments` WHERE (`name` LIKE :nameDepartment OR `leader` LIKE :leader ) AND `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameDepartment', $key, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $key, PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}
function insertDepartment($name,$slug,$leader,$status,$logo,$beginningDate)
{
 //viet cau lenh sql insert vao bang departments
 $sqlInsert = "INSERT INTO `departments`(`name`,`slug`,`leader`,`date_beginning`,`status`,`logo`,`created_at`) 
 VALUES(:nameDepartment, :slug, :leader, :beginDate, :statusDepartment, :logo,:createdAt)";
 $checkInsert = false;
 $db = connectionDb();
 $stmt = $db -> prepare($sqlInsert);
 $currentDate = date('Y-m-d H:i:s'); 
 if($stmt){
    $stmt->bindParam(':nameDepartment',$name, PDO::PARAM_STR);
    $stmt->bindParam(':slug',$slug, PDO::PARAM_STR);
    $stmt->bindParam(':leader',$leader, PDO::PARAM_STR);
    $stmt->bindParam(':beginDate',$beginningDate, PDO::PARAM_STR);
    $stmt->bindParam(':statusDepartment',$status, PDO::PARAM_INT);
    $stmt->bindParam(':logo',$logo, PDO::PARAM_STR);
    $stmt->bindParam(':createdAt',$currentDate, PDO::PARAM_STR);
    if($stmt->execute()){
        $checkInsert = true;
    }

 }
 disconnectDB($db); //ngat knoi toi dtb
 //tra ve tru insert thanh cong va ngc lai
 return $checkInsert;
}
   