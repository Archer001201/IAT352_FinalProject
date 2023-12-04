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

        $guideID = $db->insert_id;

        $stmt->close();
        $db ->close();

        $url = "characterDetail.php?id=" . $characterID . "#guideID_" . $guideID;
        header('Location: ' . $url);
        exit();
    }
}

function updateSession(){
    session_start();
    if (isset($_GET["bestWeapon"])) $_SESSION['bestWeapon'] = $_GET['bestWeapon'];
    if (isset($_GET["replacementWeapon"])) $_SESSION['replacementWeapon'] = $_GET['replacementWeapon'];
    if (isset($_GET["artifacts_1"])) $_SESSION['artifacts_1'] = $_GET['artifacts_1'];
    if (isset($_GET["artifacts_2"])) $_SESSION['artifacts_2'] = $_GET['artifacts_2'];
}

function showImageByQueryId($db, $table, $name, $list){
    if(isset($_SESSION[$name])) $item = queryPrimaryKey($db, $table, $_SESSION[$name]);
    else $item = queryPrimaryKey($db, $table, $list[0]['id']);

    if ($table == "weapons")
        echo "<img id='" . $name . "_image' src='../res/WeaponImages/" . $item['image'] . "' width=100>";
    if ($table == "artifacts")
        echo "<img id='" . $name . "_image' src='../res/ArtifactImages/" . $item['image'] . "' width=100>";
}
