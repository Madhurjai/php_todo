<?php
session_start();
// session_destroy();
include('function.php');
$action = isset($_GET['action'])?$_GET['action']:'';
$editlistitem = array();

if(isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    $text = $_REQUEST['list'];
    // $id = $_REQUEST['id'];
    $global = array();
    $listid = $_POST['listid'];
    $listid1 = $_POST['listid1'];
    $uncheck = 'checked';

    $updateitem = array('id'=> $listid, 'text' => $text);
    switch($action) {
        case 'add':
            addtask($text);
            break;
        case 'edit':
            $editlistitem = edititem($listid);
            // print_r($editlistitem) ;
            break;
        case 'update':
            updatetask($updateitem);
            break ;
        case 'delete':
            deletepermanent($listid);
            break ;
        case 'checkbox':
           deletefromtodo($listid);
           break ;
        case 'checkbox1':
            $uncheck = '';
            deletefromcomplete($listid1);
           break ;

    }
    // echo $editlistitem;
}

?>
<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <form action="" method="POST">
            <p>
                <input id="new_task" type="text" name = 'list' <?php if (sizeof($editlistitem)) : ?> value = "<?php echo $editlistitem['text'] ?>" <?php endif ;?> >
                    <?php if (sizeof($editlistitem)) : ?>
                <input type="submit" value="update" name="action">
                <?php  else:?>
                    <input type="submit" value="add" name="action" id = "addbtn">
                    <?php endif ; ?>
            </p>
    
            <h3>Todo</h3>
            
           
    
            <?php  echo display(); ?>
            <h3>Completed</h3>
            <?php  echo displaycomplete($uncheck);
           ?>
            </form>
        </div>
        
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="php.js"></script>
</html>