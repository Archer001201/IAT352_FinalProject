<?php

function redirect_to_if($url, $condition, $loginRequestPage){
    if (!$condition) return;
    $_SESSION['loginRequestPage'] = $loginRequestPage;
    header('Location: ' . $url);
    exit();
}

function getAllName($weaponList){
    $weaponNameList = [];
    foreach ($weaponList as $weapon){
        $weaponNameList[] = $weapon['name'];
    }
    return $weaponNameList;
}

function createGuideData($db){
    $email = $_SESSION['valid_user'];
    echo $email;
//    if (isset($_POST['submit'])) {
//        $email = $_SESSION['valid_user'];
//        echo $email;
//    }
}
