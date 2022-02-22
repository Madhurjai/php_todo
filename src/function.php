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
            $html .= '<li><input type="hidden" name="listid" value = "'.$val['id'].'" >
            <input type="checkbox" name = "action" value = "checkbox" onchange = "this.form.submit()">
            <label>' . $val['text'] . '</label>
            <button class="edit" name = "action" id = ' .$val['id']. ' value = "edit">Edit</button>
            <button class="delete"  id = ' . $val['id'] . ' name = "action" value = "delete">Delete</button></li>';
        }
    }
    $html .= " </ul>";
    return $html;
}
function displaycomplete()
{
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    $html = " <ul id=completed-tasks>";
    if (sizeof($finallists)) {
        foreach ($finallists as $key => $val) {
            $html .= '<li><input type="hidden" name="listid" value = "'.$val['id'].'" >
            <input type="checkbox" name = "action" value = "checkbox1" onchange = "this.form.submit()">
            <label>' . $val['text'] . '</label>
            <button class="edit" name = "action" value = "edit">Edit</button>
            <button class="delete"   name = "action" value = "delete">Delete</button></li>';
        }
    }
    $html .= " </ul>";
    return $html;
}

function edititem($id)
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    if (sizeof($lists)) {
        foreach ($lists as $key => $val) {
            if ($val['id'] == $id) {
                return $val;
            };
        };
    };
}
function updatetask($listitem)
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    if (sizeof($lists)) {
        foreach ($lists as $key => $val) {
            if ($val['id'] == $listitem['id']) {
                $lists[$key]['text'] = $listitem['text'];
                $_SESSION['lists'] = $lists;
                return $lists;
            };
        };
    };
}
function deletefromtodo($id)
{   
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    if (sizeof($lists)) {
        foreach ($lists as $key => $val){
            if ($val['id'] == $id) {
                array_push($finallists,$val);
                array_splice($lists, $key, 1);
                $_SESSION['lists'] = $lists;
                $_SESSION['finallists'] = $finallists;
                // echo $finallists ;
            };
        };
    };
}
function deletefromcomplete($id)
{
    $lists = isset($_SESSION['lists']) ? $_SESSION['lists'] : array();
    $finallists = isset($_SESSION['finallists']) ? $_SESSION['finallists'] : array();
    if (sizeof($finallists)) {
        foreach ($finallists as $key => $val){
            if ($val['id'] == $id) {
                array_push($lists,$val);
                array_splice($finallists, $key, 1);
                $_SESSION['lists'] = $lists;
                $_SESSION['finallists'] = $finallists;
            };
        };
    };
}
function deletepermanent(){
    $listid = $_POST['listid'];
    $lists = isset($_SESSION['lists']) ?$_SESSION['lists']:array();
    if (sizeof($lists)) {
        foreach ($lists as $key => $val){
            if ($val['id'] == $listid) {
                array_splice($lists,$key,1);
                $_SESSION['lists'] = $lists;
                echo sizeof($lists);
                // return $lists ;
            }
        };
    };
}