<?php
ini_set('include_path', '../');
session_start();

if(empty($_SESSION['intUserAccountId'])){
    header('Location: /inventory/login.php');
}

$config = parse_ini_file('config.ini', true);

$conn = mysql_connect($config['database']['host'], $config['database']['user'], $config['database']['password']);

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

//mysql_query("SET NAMES 'UTF8'");

if (!mysql_select_db($config['database']['name'])) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$action = "add";
if($_GET['action'] == "edit"){
    $action = "edit";
    $sql = "select id,name,description from suppliers where id = ".$_GET['id'];
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    $id = $row['id'];
    $name = $row['name'];
    $description = $row['description'];
}


if(!empty($_POST)){
    if($_POST['action'] == "add"){
        $sql = "insert into suppliers (name,description,created_by,creation_date) values ('".$_POST['name']."','".$_POST['description']."','".$_SESSION['intUserAccountId']."',now())";
        //echo $sql."<br>";
        $result = mysql_query($sql);
    }elseif($_POST['action'] == "edit"){
        $sql = "update suppliers set name = '".$_POST['name']."', description = '".$_POST['description']."', modified_by = '".$_SESSION['intUserAccountId']."' , modified_date = now() where id = '".$_POST['id']."'";
        //echo $sql."<br>";
        $result = mysql_query($sql);
    }
    header('Location: /inventory/admin/suppliers_manage.php');
}

if($_GET['action'] == "delete"){
    $sql = "delete from suppliers where id = ".$_GET['id'];
    $result = mysql_query($sql);
    header('Location: /inventory/admin/suppliers_manage.php');
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Suppliers Manage</title>
</head>
<body>
<?php

$sql_0 = "select user_account_id,username from user_account";
$result_0 = mysql_query($sql_0);
while($row_0 = mysql_fetch_assoc($result_0)){
    $user[$row_0['user_account_id']] = $row_0['username'];
}

$sql = "select * from suppliers";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){
    $list .= "<tr>";
    $list .= "<td>".$row['name']."</td>";
    $list .= "<td>".$row['description']."</td>";
    $list .= "<td>".$user[$row['created_by']]."</td>";
    $list .= "<td>".$row['creation_date']."</td>";
     $list .= "<td>".$user[$row['modified_by']]."</td>";
    $list .= "<td>".$row['modified_date']."</td>";
    $list .= "<td><a href='suppliers_manage.php?action=edit&id=".$row['id']."'>Edit</a></td>";// | <a href='suppliers_manage.php?action=delete&id=".$row['id']."'>Delete</a></td>";
    $list .= "</tr>";
}
?>

<div style="position: relative;">
    <div id="suppliers-list">
        <h2>Suppliers List</h2>
        <table border=1>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Creator
                </th>
                <th>
                    Created Time
                </th>
                <th>
                    Modified By
                </th>
                <th>
                    Modified Time
                </th>
                <th>
                    Operate
                </th>
            </tr>
            <?=$list?>
        </table>
    </div>
    
    <div id="add-suppliers">
        <h2>Add Suppliers</h2>
        <form method="POST">
            Name: <input type="text" name="name" value="<?=$name?>"> <br>
            Description: <textarea rows="5" cols="30" name="description"><?=$description?></textarea><br>
            <input type="hidden" name="id" value="<?=$id?>"/>
            <input type="hidden" name="action" value="<?=$action?>"/>
            <input type="submit"/>
        </form>
    </div>
</div>
</body>
</html>