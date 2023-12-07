<?php
/*
 * 生成下拉菜单选项
 * $label -> 生成html属性中的label, name, id
 * $displayName -> 下拉菜单显示的名字
 * $options -> 存储下拉菜单选项的array
 */
function showDropdownWithAssoc($label, $displayName, $options){
    echo "<label for='" . $label . "'>";
    echo "<h3>" . $displayName . "</h3>";
    echo "<select name='" . $label . "' id='" . $label . "'>";
    for ($i=0; $i < count($options); $i++){
        $opt = $options[$i];
        if ($i == 0 && !isset($_SESSION[$label]))
            $selected = 'selected';
        else
            $selected = (isset($_SESSION[$label]) && $_SESSION[$label] == $opt['id']) ? 'selected' : '';
        echo "<option value='" . $opt['id'] . "' " . $selected . ">" . $opt['name'] . "</option>";
    }
    echo "</select></label>";
}

function showDropdown($label, $displayName, $options){
    echo "<label for='" . $label . "'>";
    echo "<h3>" . $displayName . "</h3>";
    echo "<select name='" . $label . "' id='" . $label . "'>";
    for ($i=0; $i < count($options); $i++){
        $opt = $options[$i];
        if ($i == 0 && !isset($_SESSION[$label]))
            $selected = 'selected';
        else
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

function showTextBox($label, $displayName, $required){
    echo "<label for='" . $label . "'>";
    echo "<h2>" . $displayName . "</h2>";
    echo "<input type='text' id='" . $label . "' name='" . $label . "'" . ($required ? "required" : ""). ">";
    echo "</label>";
}

function showTextArea($label, $displayName){
    echo "<label for='" . $label . "'>";
    echo "<h2>" . $displayName . "</h2>";
    echo "<textarea id='" . $label . "' name='". $label . "'></textArea>";
    echo "</label>";
}

/*
 * form开始，把form提交的php路径作为参数传递给formStart
 */
function formStart($filePath, $method){
    echo "<form action='$filePath' method='" . $method . "'>";
}

/*
 * form结束
 */
function formEnd(){
    echo "</form>";
}

function showSubmitButton(){
    echo "<input type='submit' name='submit' value='submit'>";
}
