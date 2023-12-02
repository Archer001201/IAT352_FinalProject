<?php
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

function showTextBox($required){
    echo "<label for='title'>Title";
    echo "<input type='text' id='title' name='title'" . ($required ? "required" : ""). ">";
    echo "</label>";
}

function showTextArea($label, $displayName){
    echo "<label for='" . $label . "'>" . $displayName;
    echo "<textarea id='" . $label . "' name='". $label . "'></textArea>";
    echo "</label>";
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

function showSubmitButton(){
    echo "<input type='submit' value='submit'>";
}
