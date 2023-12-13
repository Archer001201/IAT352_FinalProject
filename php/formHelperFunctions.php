<?php
/*
 * echo a html structure that shows a dropdown button with options which are associative array
 * $label -> indicates select name and id
 * $displayName -> button name
 * $options -> options which are associative array
 * (option['id'] will be the value, option['name'] will be displayed)
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

/*
 * echo a html structure that shows a dropdown button with an array options
 * $label -> indicates select name and id
 * $displayName -> button name
 * $options -> array options
 * (option value will be the index of array options)
 */
function showDropdown($label, $displayName, $options){
    echo "<label for='" . $label . "'>";
    echo "<h3>" . $displayName . "</h3>";
    echo "<select name='" . $label . "' id='" . $label . "'>";
    for ($i=0; $i < count($options); $i++){
        $opt = $options[$i];
        echo "<option value='" . $i . "'>" . $opt . "</option>";
    }
    echo "</select></label>";
}

/*
 * echo a html structure that shows a radio button with an array options
 * $label -> indicates input name and id
 * $displayName -> button name
 * $options -> array options
 * (option value will be the index of array options)
 */
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
 * echo a html structure that shows a text input
 * $label -> indicates input name and id
 * $displayName -> text input name
 * $required -> a boolean parameter to determine is this text input mandatory or not
 */
function showTextBox($label, $displayName, $required){
    echo "<label for='" . $label . "'>";
    echo "<h2>" . $displayName . "</h2>";
    echo "<input type='text' id='" . $label . "' name='" . $label . "'" . ($required ? "required" : ""). ">";
    echo "</label>";
}

/*
 * echo a html structure that shows a text area
 * $label -> indicates textarea name and id
 * $displayName -> textarea name
 */
function showTextArea($label, $displayName){
    echo "<label for='" . $label . "'>";
    echo "<h2>" . $displayName . "</h2>";
    echo "<textarea id='" . $label . "' name='". $label . "'></textArea>";
    echo "</label>";
}

/*
 * form start
 */
function formStart($filePath, $method){
    echo "<form action='$filePath' method='" . $method . "'>";
}

/*
 * form end
 */
function formEnd(){
    echo "</form>";
}

/*
 * submit button
 */
function showSubmitButton(){
    echo "<input class='submit-button' type='submit' name='submit' value='submit'>";
}
