<?php require("header.php"); 
?>
<body>
<div class="container">

      <h1>Dylan's Job Hunt 2016</h1>
      <h2>Update University Application</h2>
      <?php
      $db = new Db_Connect();
      $control = new Controller($db);
      $results = $control->retrieve_all("id");
      ?>
      <form method="post">
        <div class="form-group">
            <label for="school">University list (select one):</label>
                <select class="form-control" name="school">
                    <?php
                    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                        foreach ($row as $k=>$v) {
                            if ($k == "id") {
                                echo '<option value ="' . $v . '">';
                            } elseif ($k == "school") {
                                echo $v . "</option>";
                            }
                        }
                    } 
                    $db = null;
                    $control == null;
                     ?>
                </select>
            <label for="notes">Note:</label>
                <input name="notes" rows="8" cols="80">
            <label for="response">Response</label>
                <input name="response" rows="8" cols="80">
                <input type="submit" name="submit" value="SUBMIT">
        </form>
        <?php 
        $database = new Db_Connect();
        $con = new Controller($database);
        if(isset($_POST["submit"])) {
            $con->applied($_POST);
        }
        ?>
</body>
<?php require("footer.php"); ?>
