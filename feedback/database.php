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

function insert_feedback($feedback) {
    global $db;
   
    $sql = "INSERT INTO feedback";
    $sql .= "(email, feedback, time)";
    $sql .= "VALUES (";
    $sql .= "'" . $feedback['email'] . "',";
    $sql .= "'" . $feedback['feedback'] . "',";
    $sql .= "'" . $feedback['time'] . "'";
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

function find_all_feedback(){
    global $db;

    $sql = "SELECT * FROM feedback ";
    $sql .= "ORDER BY id";
    $result = mysqli_query($db, $sql); 
    return $result; 
} 

function find_feedback_by_ID($feedID) {
    global $db;
  
    $sql = "SELECT * FROM feedback ";
    $sql .= "WHERE id='" . $feedID . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $feedback = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $feedback; // returns an assoc. array
  }
  
function delete_feedback($feedback) {
    global $db;

    $sql = "DELETE FROM feedback ";
    $sql .= "WHERE id='" . $feedback . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
    

?>