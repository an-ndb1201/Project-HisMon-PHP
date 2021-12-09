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

    function find_category_by_id($id){
        global $db;

        $sql = "SELECT * FROM category WHERE categoryID = '$id'";
        // $sql .= "WHERE category.categoryID='$id'";
        $result = mysqli_query($db, $sql);
        // confirm_query_result($result);
        // $places = mysqli_fetch_assoc($result);
        // mysqli_free_result($result);
        return $result;
    }



    function find_all_places_by_id($id) {
        global $db;

        $sql = "SELECT places.*, image.img, category.namecategory FROM places
                JOIN image ON places.placesID = image.placesID
                JOIN category ON places.categoryID = category.categoryID ";
        $sql .= "WHERE places.placesID='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_query_result($result);
        $places = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $places;
    }


    function find_all_category(){
        global $db;
    
        $sql = "SELECT * FROM category ";
        // $sql .= "ORDER BY name";
        $result = mysqli_query($db, $sql); 
        return $result; 
    }

    function find_all_flaces_by_categoryID($id){
        global $db;

        $sql = "SELECT places.*, image.img, category.namecategory FROM places
                JOIN image ON places.placesID = image.placesID
                JOIN category ON places.categoryID = category.categoryID WHERE category.categoryID = '$id'";
        // $sql .= "WHERE category.categoryID='$id'";
        $result = mysqli_query($db, $sql);
        // confirm_query_result($result);
        // $places = mysqli_fetch_assoc($result);
        // mysqli_free_result($result);
        return $result;
    }

    function find_all_search ($sea){
        global $db;
        $sql = "SELECT places.*, image.* FROM places
                        JOIN image ON places.placesID = image.placesID
                        JOIN category ON places.categoryID = category.categoryID
                        WHERE places.name LIKE '%$sea%'";
         $result = mysqli_query($db, $sql); 
         return $result;                 
    }

?>