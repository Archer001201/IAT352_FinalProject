<?php
/*
 * 显示单个info card的<a>，点击之后进入对应的detail页面，在showInfoCard中调用
 * $table -> 数据库中table的名字 ($name和$image通过$table获取)
 * $name -> info card显示的名字
 * $image -> info card图片的url
 */
function showInfoCard($table, $name, $image, $id){
    $resRoot = null;
    $hrefStr = "#";
    if ($table == "characters"){
        $resRoot = "../res/CharacterImages/";
        $hrefStr = "characterDetail.php?id=" . $id;
    }
    else if ($table == "weapons") $resRoot = "../res/WeaponImages/";
    else if ($table == "artifacts") $resRoot = "../res/ArtifactImages/";

    echo "<a class='card' href=$hrefStr>";
    if ($resRoot == null){
        echo $table . " is invalid";
        return;
    }

    echo "<img src='" . $resRoot . $image . "' width=150>";
    echo "<p>$name</p>";
    echo "</a>";
}

/*
 * 启动并更新Session，在ajax运行之前调用以即使更新Session数据
 */
function updateSession(){
    session_start();
    if (isset($_GET["characterRarity"])) $_SESSION['characterRarity'] = $_GET['characterRarity'];
    if (isset($_GET["region"])) $_SESSION['region'] = $_GET['region'];
    if (isset($_GET["elementType"])) $_SESSION['elementType'] = $_GET['elementType'];

    if (isset($_GET["weaponRarity"])) $_SESSION['weaponRarity'] = $_GET['weaponRarity'];
}

/*
 * 通过数据库查询和showInfoCard函数把所有info cards载入到id为cardContainer的<div>中
 * 查询过程将characters和weapons两个table分开进行，避免数据干扰
 * $db -> 数据库名字
 * $table -> 数据库中table的名字
 */
function showInfoCards($db, $table){
    $query_str = 'SELECT * FROM ' . $table;
    $conditions = array();
    $params = array();
    $types = '';

    if ($table == "weapons"){
        if (isset($_SESSION['weaponRarity']) && $_SESSION['weaponRarity'] != "All") {
            $conditions[] = "weaponRarity = ?";
            $params[] = $_SESSION['weaponRarity'];
            $types .= 's';
        }
    }

    if ($table == "characters") {
        if (isset($_SESSION['characterRarity']) && $_SESSION['characterRarity'] != "All") {
            $conditions[] = "characterRarity = ?";
            $params[] = $_SESSION['characterRarity'];
            $types .= 's';
        }
        if (isset($_SESSION['region']) && $_SESSION['region'] != "All") {
            $conditions[] = "region = ?";
            $params[] = $_SESSION['region'];
            $types .= 's';
        }
        if (isset($_SESSION['elementType']) && $_SESSION['elementType'] != "All") {
            $conditions[] = "elementType = ?";
            $params[] = $_SESSION['elementType'];
            $types .= 's';
        }
    }

    if (count($conditions) > 0) {
        $query_str .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $db->prepare($query_str);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        exit();
    }

    if ($types != '') {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        exit();
    }

    $res = $stmt->get_result();
    echo "<div class='cardContainer' id='cardContainer'>";
    if ($res === false) {
        echo "Query error: " . $db->error;
        exit();
    }

    while ($row = $res->fetch_assoc()) {
        showInfoCard($table, $row['name'], $row['image'], $row['id']);
    }
    echo "</div>";

    $res->free_result();
}


/*
 * 生成下拉菜单选项
 * $label -> 生成html属性中的label, name, id
 * $displayName -> 下拉菜单显示的名字
 * $options -> 存储下拉菜单选项的array
 */
function showDropdown($label, $displayName, $options){
    echo "<label for='" . $label . "'>" . $displayName;
    echo "<select name='" . $label . "' id='" . $label . "'>";
    foreach ($options as $opt){
        $selected = (isset($_SESSION[$label]) && $_SESSION[$label] == $opt) ? 'selected' : '';
        echo "<option value='" . $opt . "' " . $selected . ">" . $opt . "</option>";
    }
    echo "</select></label>";
}

function showRadioButton($label, $displayName, $options){
    echo "<div class='radioButtons'><h3>" . $displayName ."</h3>";
    $index = 0;
    foreach ($options as $opt){
        $selected = (isset($_SESSION[$label]) && $_SESSION[$label] == $opt) ? 'checked' : '';
        $id = $label . $index;
        echo "<label for='" . $id . "'>";
        echo "<input type='radio' id='" . $id . "' name='" . $label . "' value='" . $opt . "' " . $selected . ">";
        echo $opt . "</label>";
        $index++;
    }
    echo "</div>";
}


/*
 * form开始，把form提交的php路径作为参数传递给formStart
 */
function formStart($filePath){
    echo "<form action='$filePath'>";
}

/*
 * form结束
 */
function formEnd(){
    echo "</form>";
}
