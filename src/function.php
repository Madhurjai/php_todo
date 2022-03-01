<?php
session_start();
function addtask($text)
{
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists']:array();
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $text = array('id' => rand(10, 1000000), 'text' => $text);
    array_push($lists, $text);
    $_SESSION['lists'] = $lists;
    $_SESSION['finallists'] = $finallists;
}
function display()
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $html = " <ul id=incomplete-tasks>";
    if (sizeof($lists)) {
        foreach ($lists as $key => $val) {
            $html .= '<li><input type="hidden" name="listid" value = "'.$key.'" >
            <input type="checkbox" name = "action" value = "checkbox" onchange = "this.form.submit()">
            <label>' . $val['text'] . '</label>
            <button class="edit" name = "action" id = ' .$key. ' value = "edit">Edit</button>
            <button class="delete"  id = ' . $key. ' name = "action" value = "delete">Delete</button></li>';
        }
    }
    $html .= " </ul>";
    return $html;
}
function displaycomplete($uncheck){
    
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    $html = " <ul id=completed-tasks>";
    if (sizeof($finallists)) {
        foreach ($finallists as $key => $val) {
            $html .= '<li><input type="hidden" name="listid1" value = "'.$key.'" >
            <input type="checkbox" name = "action" value = "checkbox1" '.$uncheck.' onchange = "this.form.submit()" >
            <label>' . $val['text'] . '</label></li>';
            // <button class="edit" name = "action" value = "edit">Edit</button>
            // <button class="delete"   name = "action" value = "delete">Delete</button>;
        }
    }
    $html .= " </ul>";
    return $html;
}

function edititem($id)
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    if (sizeof($lists)) {
      $val = $lists[$id];
      $_SESSION['lists'] = $lists ;
      return $val ;
    };
}
function updatetask($listitem)
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    if (sizeof($lists)) {
       
                $lists[$listitem['id']]['text'] = $listitem['text'];
                $_SESSION['lists'] = $lists;
                return $lists;
            
        
    };
}
function deletefromtodo($id)
{   
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    $checkval = $lists[(int)$id];
    array_push($finallists,$checkval);
    array_splice($lists, (int)$id, 1);
    $_SESSION['lists'] = $lists;
    $_SESSION['finallists'] = $finallists;
}
function deletefromcomplete($id)
{ 
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    $un_checkval = $finallists[$id];
    array_push($lists,$un_checkval);
    array_splice($finallists, (int)$id, 1);
    $_SESSION['lists'] = $lists;
    $_SESSION['finallists'] = $finallists;
}
function deletepermanent($id){
    $listid = $_POST['listid'];
    $lists = isset($_SESSION['lists']) ?$_SESSION['lists']:array();
    if (sizeof($lists)) {
       
                array_splice($lists,(int)$id,1);
                $_SESSION['lists'] = $lists;
                // echo sizeof($lists);
                // return $lists ;
    
    };
}