<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "historicalmonuments");

function db_connect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db=db_connect();

function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit; //terminate php
    } else {
        return $result;
    }
  }

function db_disconnect($connection){
    if(isset($connection)){
        mysqli_close($connection);
    }
}

function insert_admins($admin) {
    global $db;
   
    $sql = "INSERT INTO admin";
    $sql .= "(name, email, phone, address, password)";
    $sql .= "VALUES (";
    $sql .= "'" . $admin['name'] . "',";
    $sql .= "'" . $admin['email'] . "',";
    $sql .= "'" . $admin['phone'] . "',";
    $sql .= "'" . $admin['address'] . "',";
    $sql .= "'" . md5($admin['password']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if($result){
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_all_admin(){
    global $db;

    $sql = "SELECT * FROM admin ";
    $sql .= "ORDER BY name";
    $result = mysqli_query($db, $sql); 
    return $result; 
} 

function find_book_by_admID($admID) {
    global $db;
  
    $sql = "SELECT * FROM admin ";
    $sql .= "WHERE adminID='" . $admID . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }
  
  function update_admin($admin) {
    global $db;
  
    $sql = "UPDATE admin SET ";
    $sql .= "name='" . $admin['name'] . "', ";
    $sql .= "email='" . $admin['email'] . "', ";
    $sql .= "phone='" . $admin['phone'] . "', ";
    $sql .= "address='" . $admin['address'] . "', ";
    $sql .= "password='" . md5($admin['password']) . "' ";
    $sql .= "WHERE adminID='" . $admin['adminID'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
  }
  
function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admin ";
    $sql .= "WHERE adminID='" . $admin . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function check_login($tk,$mk){
    global $db;
    $sql = "SELECT * FROM admin ";
    $sql .= "WHERE name='" . $tk . "' ";
    $sql .= "AND password='" . $mk . "'";
    $rows = mysqli_query($db, $sql);
    $count = mysqli_num_rows($rows);
    
    return $count;
   
} 
    

?>