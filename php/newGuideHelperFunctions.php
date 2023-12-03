<?php

function redirect_to_if($url, $condition, $loginRequestPage){
    if (!$condition) return;
    $_SESSION['loginRequestPage'] = $loginRequestPage;
    header('Location: ' . $url);
    exit();
}

function createGuideData($db){
    if (isset($_REQUEST['submit'])) {
        $uid = $_SESSION['valid_user'];
        $characterID = $_SESSION['characterID'];
        $title = $_REQUEST['title'];
        $bestWeapon = $_REQUEST['bestWeapon'];
        $replacementWeapon = $_REQUEST['replacementWeapon'];
        $artifacts_1 = $_REQUEST['artifacts_1'];
        $artifacts_2 = $_REQUEST['artifacts_2'];
        $description = $_REQUEST['description'];
        $insertStr = "INSERT INTO guides (userID, characterID, guideTitle, guideDescription, bestWeaponID, replacementWeaponID, artifactID_1, artifactID_2) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($insertStr);
        if (!$stmt) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        }
        $stmt->bind_param("iissiiii", $uid, $characterID, $title, $description, $bestWeapon, $replacementWeapon, $artifacts_1, $artifacts_2);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->close();
        $db ->close();

        $url = "characterDetail.php?id=" . $characterID;
        header('Location: ' . $url);
        exit();
    }
}
