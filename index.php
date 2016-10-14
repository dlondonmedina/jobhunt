<?php require("header.php"); ?>
   <body>
      <div class="container">

      <h1>Dylan's Job Hunt 2016</h1>
      <div class="row">
         <div class="col-md-8">
            <h2>Enter New Listing</h2>
            <?php
            $db = new Db_Connect();
            $controller = new Controller($db);
            $input = new Input_Form();
            echo $input->output();
            if(isset($_POST["submit"])) {
               $controller->into_database($_POST);
            }
            ?>
         </div>
         <div class="col-md-4">
            <h2>Search the Database</h2>
            <form class="" action="?query" method="post">

            </form>
	   <br>
         </div>
      </div>
      <div class="well well-lg">
         <?php
         $control = new Controller($db);
         $result = $control->retrieve_all("school");
         $array = array('University', 'Title','Announcement', 'Link', 'Website', 'Due Date');
         $output = new Output_view();
         echo $output->output($array, $result);
         ?>
      </div>

   </div>
   </body>
<?php require("footer.php");
