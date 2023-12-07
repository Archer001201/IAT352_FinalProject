<?php
function getData($db, $uid, $table){
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

    $guideIds = [];
    while ($row = $result->fetch_assoc()){
        $guideIds[] = $row['guideID'];
    }
    $db->close();
    echo json_encode($guideIds);
}

function handleData($db, $uid, $table, $guideId){
    $query = "SELECT * FROM " . $table . " WHERE guideID = ? AND userID = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('ii', $guideId, $uid);
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
        $deleteQuery = "DELETE FROM " . $table . " WHERE guideID = ? AND userID = ?";
        $deleteStmt = $db->prepare($deleteQuery);
        if (!$deleteStmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            return;
        }
        $deleteStmt->bind_param('ii', $guideId, $uid);
        if (!$deleteStmt->execute()) {
            echo "Execute failed: (" . $deleteStmt->errno . ") " . $deleteStmt->error;
            return;
        }
        $deleteStmt->close();
    } else {
        $insert = "INSERT INTO " . $table . " (userID, guideID) VALUES (?, ?)";
        $stmt = $db->prepare($insert);
        if (!$stmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            return;
        }
        $stmt->bind_param("ii", $uid, $guideId);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return;
        }
        $stmt->close();
    }
}
