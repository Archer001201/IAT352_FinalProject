<?php
function getData($db, $uid, $table, $idType){
    $query = "SELECT * FROM " . $table . " WHERE userID = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('i', $uid);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $Ids = [];
    while ($row = $result->fetch_assoc()){
        $Ids[] = $row[$idType];
    }
    $db->close();
    echo json_encode($Ids);
}

function handleData($db, $uid, $table, $id, $condition){
    $query = "SELECT * FROM " . $table . " WHERE " . $condition . " = ? AND userID = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('ii', $id, $uid);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }

    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    if (mysqli_num_rows($result) > 0) {
        $deleteQuery = "DELETE FROM " . $table . " WHERE " . $condition . " = ? AND userID = ?";
        $deleteStmt = $db->prepare($deleteQuery);
        if (!$deleteStmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            return;
        }
        $deleteStmt->bind_param('ii', $id, $uid);
        if (!$deleteStmt->execute()) {
            echo "Execute failed: (" . $deleteStmt->errno . ") " . $deleteStmt->error;
            return;
        }
        $deleteStmt->close();
    } else {
        $insert = "INSERT INTO " . $table . " (userID, $condition) VALUES (?, ?)";
        $stmt = $db->prepare($insert);
        if (!$stmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            return;
        }
        $stmt->bind_param("ii", $uid, $id);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return;
        }
        $stmt->close();
    }
}
