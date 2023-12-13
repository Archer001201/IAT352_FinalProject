<?php

/*
 * connect database and return a instance of database
 */
function connectDatabase(){
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "genshinGuides";
    $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
    if ($db->connect_errno) {
        echo "Database connection error: " . $db->connect_error;
        exit();
    }
    return $db;
}

/*
 * execute a sql query by primary key and return a query result
 * $db -> the instance of database
 * $table -> table name matched database
 * $id -> the value of primary key
 * $key -> the name of primary key
 */
function queryById($db, $table, $id, $key){
    if (!is_numeric($id)) {
        echo "Invalid ID";
        return null;
    }

    $stmt = $db->prepare('SELECT * FROM ' . $table . ' WHERE ' . $key . ' = ?');
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }

    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    return $result->fetch_assoc();
}


/*
 * execute a sql query by foreign key and return a query result in an array
 * $db -> the instance of database
 * $table -> table name matched database
 * $foreignKey -> the value of foreign key
 * $condition -> the name of foreign key
 */
function queryForeignKey($db, $table, $condition ,$foreignKey){
    if (!is_numeric($foreignKey)) {
        echo "Invalid foreign key";
        return null;
    }

    $stmt = $db->prepare("SELECT * FROM " . $table . " WHERE " . $condition ." = ?");
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }

    $stmt->bind_param('i', $foreignKey);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }

    return $allRows;
}

/*
 * return all data from a table
 * $db -> the instance of database
 * $table -> table name matched database
 */
function queryAllFromTable($db, $table){
    $query = "SELECT * FROM " . $table;
    $result = $db->query($query);

    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }

    return $allRows;
}

/*
 * return a sorted data by count
 * $db -> the instance of database
 * $table1 -> main table name
 * $table2 -> sub query table name (like user_like, user_favorite)
 * $selectId -> the id name which is used to combine two tables
 * $order -> sorting order, sql command
 * $id -> query condition value
 * $condition -> query condition name
 */
function sortingDataByCount($db, $table1, $table2, $selectId,  $order, $id, $condition){
    $query = "SELECT g.*, COALESCE(i.count, 0) AS count ";
    $query .= "FROM " . $table1 . " g ";
    $query .= "LEFT JOIN (";
    $query .= "SELECT " . $selectId . ", COUNT(*) as count ";
    $query .= "FROM " . $table2;
    $query .= " GROUP BY " . $selectId . ") ";
    $query .= "i ON g." . $selectId . " = i." . $selectId . " ";
    $query .= "WHERE g." . $condition . " = " . $id . " ORDER BY i.count " . $order;
//    echo $query;
    $result = $db->query($query);
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }
    return $allRows;
}

/*
 * return a sorted data by time
 * $db -> the instance of database
 * $order -> sorting order, sql command
 * $id -> query condition value
 * $time -> time data from database
 * $key -> query condition name
 * $table -> table name matched database
 */
function sortingDataByTime($db, $order, $id, $time, $key, $table){
    $query = "SELECT * FROM " . $table . " WHERE " . $key . " = ? ORDER BY " . $time . " "  . $order;
//    echo $query;
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }

    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $allRows = [];
    while ($row = $result->fetch_assoc()) {
        $allRows[] = $row;
    }

    return $allRows;
}

/*
 * query amount for like or favorite list
 * $db -> the instance of database
 * $table -> table name matched database
 * $guideId -> the condition value
 * $condition -> the condition name
 */
function showUserAmount($db, $table, $guideId, $condition){
    $query = "SELECT COUNT(*) AS count FROM " . $table . " WHERE " . $condition . " = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('i', $guideId);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }
    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $row = $result->fetch_assoc();
    return $row['count'];
}


