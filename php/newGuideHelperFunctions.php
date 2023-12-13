<?php
/*
 * insert guide data into database
 * $db -> the instance of database
 */
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

/*
 * update session
 */
function updateSession(){
    if (isset($_GET["bestWeapon"])) $_SESSION['bestWeapon'] = $_GET['bestWeapon'];
    if (isset($_GET["replacementWeapon"])) $_SESSION['replacementWeapon'] = $_GET['replacementWeapon'];
    if (isset($_GET["artifacts_1"])) $_SESSION['artifacts_1'] = $_GET['artifacts_1'];
    if (isset($_GET["artifacts_2"])) $_SESSION['artifacts_2'] = $_GET['artifacts_2'];
}
