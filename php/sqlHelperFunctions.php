<?php
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


