<?php
    session_start();

    if (!isset($_SESSION["username"]))
    {
        header("Location: index.php");
    }
?>

<?php
$cnx = mysql_connect("localhost:8889", "root", "root");
$dbName = "ucanada";
$db  = mysql_select_db("ucanada");


$sql     = "SHOW TABLES";
$request = mysql_query($sql, $cnx);


?>

<!DOCTYPE html>
<html>

<div id="container">

<div id="header">
    <h1>Database : <?php echo $dbName; ?></h1>
    <a href="index.php?logout" style="color:black">Logout</a>
</div>
        
<div id="primary">  
    <h3>Table Names</h3>
            
<table>

<?php
    
    while ($result = mysql_fetch_object($request)) {
    
        $talbeName = $result->Tables_in_ucanada;
        if (!($talbeName == "utilisateur"))  {
        echo '<tr>';
        echo '<td><a href="?table=' . $talbeName . '">' . $talbeName . '</a></td>';
        echo '</tr>';
    }
    }
   
?>
    </table>
    </div>
        
    <?php

    if (isset($_GET["table"])) {

    $result = mysql_query("SELECT * FROM " . $_GET["table"]);
    
    if (!$result) {
        die("Query to show fields from table failed");
    }
    
    $fields_num = mysql_num_fields($result);

    echo "<table border='1  ' width = '100%' id=content>";
    echo "<tr>";

    // printing table headers
    for ($i = 0; $i < $fields_num; $i++) {
        $field = mysql_fetch_field($result);
        echo "<td>{$field->name}</td>";
    }
    echo "<td>Update</td>";
    echo "<td>Delete</td>";
    echo "</tr>";

    // printing table rows
     //$newResult = mysql_query("SHOW KEYS FROM graduate WHERE Key_name = 'PRIMARY'");
     //$primaryKey = $newResult -> Column_name
    while ($row = mysql_fetch_row($result)) {
       
        
        $data = http_build_query($row);
        echo '<tr>';

        
        // $row is array... foreach( .. ) puts every element
        // of $row to $cell variable
        foreach ($row as $cell)
        echo "<td>$cell</td>";
        echo "<td><a href='?row=".$data."'>Update</a></td>";
        echo "<td>Delete</td>";
        echo "</tr>";
    }
}
echo "</table>";
?>



    <div id="secondary">
        <h3>Modify DB</h3>
         <?php 
         if (isset($_GET["table"])) {
        echo '<form name="insert" action="display.php/?table='.$_GET["table"].'" onsubmit="TRUE" method="POST">';
       
        $newResult = mysql_query("SELECT * FROM " . $_GET["table"]);
        if (!isset($_GET["row"])) {
            $fields_num = mysql_num_fields($newResult);
            for ($i = 0; $i < $fields_num; $i++) {

        $field = mysql_fetch_field($newResult);

        echo "<p>{$field->name}</p>";
        echo "<input type='text' name='{$field->name}'><br>";
    }
            
        }

        

    echo "<input type='submit' value='Insert Row'>";
    echo "</form>";
}
    ?>


    <?php 
    if (isset($_POST["student_id"])){
        $columns = implode(", ",array_keys($_POST));
        $escaped_values = array_map('mysql_real_escape_string', array_values($_POST));
        $values  = implode("', '", $escaped_values);
        $newSql = "INSERT INTO ".$_GET["table"]." ($columns) VALUES ("."'"."$values"."'".")";
        echo $newSql;
        mysql_query($newSql, $cnx);
    }

    ?>
              
    </div>

    </div>
   
    <style>
    #container {
        width: 80%;
        margin: 0 auto;
        height: 700px;
    }

    #primary {
        background-color: grey;
        float: left;
        width: 25%;
        height: 75%;
    }

    #content {
        float: left;
        background-color: lightgrey;
        width:50%;
    }

    #secondary {
        float: right;
        background-color: grey;
        width: 25%;
        height: 75%;
    }	

    #footer {
        display: block;
        /*clear: both;*/
    }
    a {
        color: white;
        text-decoration: none;
        text-transform: capitalize;
        font-size: 20px;
     }
     p{
         color: white;
        text-decoration: none;
        text-transform: capitalize;
        font-size: 15px;
     }

    }

    </style>