<?php require("header.php"); ?>
<body>
<div class="container">

      <h1>Dylan's Job Hunt 2016</h1>
      <h2>Update University Application</h2>
      <form method="post">
        <div class="form-group">
            <label for="school">University list (select one):</label>
                <select class="form-control" id="school">
                    <?php 
                    $db = new Db_Connect();
                    $control = new Controller($db);
                    $result = $control->retrieve_list("school", "applied");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        foreach($row as $k=>$v) {
                            echo "<option>" . $v . "</option>";
                        }
                    }
                    ?>
                </select>
            <label for="note">Note:</label>
                <input name="note" rows="8" cols="80">
            <label for="response">Response</label>
                <input name="response" rows="8" cols="80">
                <input type="submit" name="submit" value="SUBMIT">
        </form>
        <?php 
        if(isset($_POST["submit"])) {
            $id = $_POST["school"];
            $note = $_POST["note"];
            $response = $_POST["response"];
            $control->update_applied($id, $note, $response);
        }
        ?>
</body>
<?php require("footer.php"); ?>