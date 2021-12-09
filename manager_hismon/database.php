<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "historicalmonuments");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}
function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
}
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
$db = db_connect();

function insert_category ($category) {
    global $db;

    $sql = "INSERT INTO category ";
    $sql .= "(namecategory) ";
    $sql .= "VALUES (";
    $sql .= "'" . $category['category'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit; //terminate php
    }
}
function find_all_category(){
    global $db;

    $sql = "SELECT * FROM category ";
    // $sql .= "ORDER BY name";
    $result = mysqli_query($db, $sql); 
    return $result; 
}
function find_category_by_id($id) {
    global $db;

    $sql = "SELECT * FROM category ";
    $sql .= "WHERE categoryID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category;
}
function update_category($category) {
    global $db;

    $sql = "UPDATE category SET ";
    $sql .= "namecategory='" . $category['namecategory'] . "' ";
    $sql .= "WHERE categoryID='" . $category['categoryID'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_category($id) {
    global $db;

    $sql = "DELETE FROM category ";
    $sql .= "WHERE categoryID = '" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}


function insert_places ($places) {
    global $db;

    $sql = "INSERT INTO places ";
    $sql .= "(name, country, content, categoryID) ";
    $sql .= "VALUES (";
    $sql .= "'" . $places['namehismon'] . "',";
    $sql .= "'" . $places['country'] . "',";
    $sql .= "'" . $places['content'] . "',";
    $sql .= "'" . $places['categoryID'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit; //terminate php
    }
}

function insert_img($places){
    global $db;

    $sql = "INSERT INTO image ";
    $sql .= "(placesID, img) ";
    $sql .= "VALUES (";
    $sql .= "'" . $places['placesID'] . "',";
    $sql .= "'" . $places['img'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit; //terminate php
    }
}
function find_all_places(){
    global $db;

    $sql = "SELECT places.*, image.* FROM places join image ON places.placesID = image.placesID";
    $result = mysqli_query($db, $sql); 
    // For SELECT statements, $result is a set of data
    return $result; 
}
function find_places_by_id($id) {
    global $db;

    $sql = "SELECT places.*, image.* FROM places join image ON places.placesID = image.placesID ";
    $sql .= "WHERE places.placesID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $places = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $places; // returns an assoc. array
}
function update_places($places) {
    global $db;

    $sql = "UPDATE places SET ";
    $sql .= "name='" . $places['name'] . "', ";
    $sql .= "country='" . $places['country'] . "', ";
    $sql .= "content='" . $places['content'] . "', ";
    $sql .= "categoryID='" . $places['categoryID'] . "' ";
    $sql .= "WHERE placesID='" . $places['placesID'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_img($places){
    global $db;

    $sql = "UPDATE image SET ";
    $sql .= "img='" . $places['img'] . "' ";
    $sql .= "WHERE placesID='" . $places['placesID'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_img($id) {
    global $db;

    $sql = "DELETE FROM image ";
    $sql .= "WHERE placesID = '" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_places($id) {
    global $db;

    $sql = "DELETE FROM places ";
    $sql .= "WHERE placesID = '" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
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

function delete_places_by_categoryID($id){
    global $db;

    $sql = "DELETE FROM places ";
    $sql .= "WHERE categoryID = '" . $id . "' ";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_img_by_placesID($id){
    global $db;

    $sql = "DELETE FROM image ";
    $sql .= "WHERE placesID = '" . $id . "' ";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function select_places_by_categoryID($id){
    global $db;

    $sql = "SELECT * FROM places ";
    $sql .= "WHERE categoryID = '" . $id . "' ";
    $result = mysqli_query($db, $sql); 
    // For SELECT statements, $result is a set of data
    return $result; 
}
?>