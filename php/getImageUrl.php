<?php

require_once ("sqlHelperFunctions.php");
$db = connectDatabase();

getImageUrl("bestWeapon", $db, "weapons", "id");
getImageUrl("replacementWeapon", $db, "weapons", "id");
getImageUrl("artifacts_1", $db, "artifacts", "id");
getImageUrl("artifacts_2", $db, "artifacts", "id");

$db->close();

/*
 * echo a html structure that shows image by sql query
 * $get -> the keyword of $_GET
 * $db -> the instance of database
 * $table -> the table name matched database
 * $condition -> the condition statement for sql query
 */
function getImageUrl($get, $db, $table, $condition){
    if (!isset($_GET[$get])) return;
    $itemId = $_GET[$get];
    $result = queryById($db, $table, $itemId, $condition);
    $myUrl = "../res/";
    if ($table == "artifacts") $myUrl .= "ArtifactImages/";
    else if ($table == "weapons") $myUrl .= "WeaponImages/";
    else{
        return;
    }

    if (count($result) > 0) {
        echo $myUrl . $result['image'];
    } else {
        echo "No image found";
    }
}