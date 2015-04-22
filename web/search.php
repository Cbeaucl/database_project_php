<?php
    session_start();

    if (!isset($_SESSION["username"]))
    {
        header("Location: index.php");
    }
?>

<?php
$cnx = mysql_connect("localhost:8889", "root", "root");
$dbName = "ucanada2";
$db  = mysql_select_db("ucanada2");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ucanada Search Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <h2>Ucanada Search Tool</h2>
    <ul class="nav nav-pills">
      <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
      <li><a data-toggle="pill" href="#menu1">Volumes</a></li>
      <li><a data-toggle="pill" href="#menu2">Researchers</a></li>
      <li><a data-toggle="pill" href="#menu3">Articles</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>

    <div class="tab-content">

      <div id="home" class="tab-pane fade in active">
        <h3>HOME</h3>
        <p>Welcome to the Ucanada Search Tool. This tool allows you to search through the records of articles, researchers and volumes. Note that after clicking search, you must navigate back to the proper tab to view results.</p>
      </div>

      <div id="menu3" class="tab-pane fade">
        <h3>Articles</h3>
        <form class="form-horizontal" role="form">

          <div class="form-group">
            <label class="control-label col-sm-2">Author:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="author">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Volume Name:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="volumeName">
            </div>
          </div>

          <div class="form-group">        
            <label class="control-label col-sm-2">Article Name:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="articleName">
            </div>
          </div>

          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Search</button>
            </div>
          </div>
        </form>
      </div>

      <div id="menu2" class="tab-pane fade">
        <h3>Researchers</h3>
        <form class="form-horizontal" role="form" action="search.php" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2">Sin #:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sin">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Number :</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="number">
            </div>
          </div>

          <div class="form-group">        
            <label class="control-label col-sm-2">Name :</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="name">
            </div>
          </div>
          <div class="form-group">        
            <label class="control-label col-sm-2">Hired :</label>
            <div class="col-sm-10">          
              <input type="date" class="form-control" name="hired">
            </div>
          </div>
          <div class="form-group">        
            <label class="control-label col-sm-2">Salary :</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="salary">
            </div>
          </div>

          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Search</button>
            </div>
          </div>
        </form>
         <div>
          <?php
          $baseSql = "SELECT * FROM researcher WHERE ";
          $sql = "";
          
          if ( !empty($_POST["sin"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(sin = '" .$_POST['sin']."')";
            
          }
          if ( !empty($_POST["number"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."AND (number = '" .$_POST['number']."')";
            
          }
          if ( !empty($_POST["name"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(name = '" .$_POST['name']."')";
            
          }
          if ( !empty($_POST["hired"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(hired = '" .$_POST['hired']."')";
            
          }
          if ( !empty($_POST["salary"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(salary = '" .$_POST['salary']."')";
          
          }
          if (empty($sql))
          {
            $sql = "SELECT * FROM researcher";
          }
          else 
          {
            $sql = $baseSql.$sql;
             
          }
          $result = mysql_query($sql, $cnx);

            if (!$result) {

              die("Query to show fields from table failed");
            }

            $fields_num = mysql_num_fields($result);

            echo "<table class='table'>";
            echo "<tr>";

    // printing table headers
            for ($i = 0; $i < $fields_num; $i++) {
              $field = mysql_fetch_field($result);
              echo "<td>{$field->name}</td>";
            }
            echo "</tr>";

    // printing table rows
     //$newResult = mysql_query("SHOW KEYS FROM graduate WHERE Key_name = 'PRIMARY'");
     //$primaryKey = $newResult -> Column_name
            while ($row = mysql_fetch_row($result)) {


              $data = http_build_query($row);
              echo '<tr>';


        // $row is array... foreach( .. ) puts every element
        // of $row to $cell variable
              foreach ($row as $cell){
                echo "<td>$cell</td>";
              }
              echo "</tr>";
            }
            echo "</table>";

          ?>
        </div> 
              
      </div>

      <div div id="menu1" class="tab-pane fade">
        <h3>Volumes</h3>
        <form class="form-horizontal" role="form" action="search.php"method="POST">
          <div class="form-group">
            <label class="control-label col-sm-2">ISBN:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="isbn">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Publisher:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="publisher">
            </div>
          </div>

          <div class="form-group">        
            <label class="control-label col-sm-2">Class:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="class">
            </div>
          </div>

          <div class="form-group">        
            <label class="control-label col-sm-2">Title:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="title">
            </div>
          </div>
          <div class="form-group">        
            <label class="control-label col-sm-2">Publication:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" name="publication">
            </div>
          </div>

          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Search</button>
            </div>
          </div>
        </form>
        <div>
          <?php
          $baseSql = "SELECT * FROM volume WHERE ";
          $sql = "";
          
          if ( !empty($_POST["isbn"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(isbn = '" .$_POST['isbn']."')";
            
          }
          if ( !empty($_POST["publisher"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(publisher = '" .$_POST['publisher']."')";
            
          }
          if ( !empty($_POST["class"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(class = '" .$_POST['class']."')";
            
          }
          if ( !empty($_POST["title"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(title = '" .$_POST['title']."')";
           
          }
          if ( !empty($_POST["publication"])) {
            if(!empty($sql)){
              $sql = $sql." AND ";
            }
            $sql = $sql."(publication = '" .$_POST['publication']."')";
          }
          if (empty($sql))
          {
            $sql = "SELECT * FROM volume";
          }
          else 
          {
            $sql = $baseSql.$sql;
           
          }
          $result = mysql_query($sql, $cnx);

            if (!$result) {

              die("Query to show fields from table failed");
            }

            $fields_num = mysql_num_fields($result);

            echo "<table class='table'>";
            echo "<tr>";

    // printing table headers
            for ($i = 0; $i < $fields_num; $i++) {
              $field = mysql_fetch_field($result);
              echo "<td>{$field->name}</td>";
            }
            echo "</tr>";

    // printing table rows
     //$newResult = mysql_query("SHOW KEYS FROM graduate WHERE Key_name = 'PRIMARY'");
     //$primaryKey = $newResult -> Column_name
            while ($row = mysql_fetch_row($result)) {


              $data = http_build_query($row);
              echo '<tr>';


        // $row is array... foreach( .. ) puts every element
        // of $row to $cell variable
              foreach ($row as $cell){
                echo "<td>$cell</td>";
              }
              echo "</tr></a>";
            }
          


          ?>
        </div>  
      </div>
    </div>

  </div>

</div>



</body>
</html>