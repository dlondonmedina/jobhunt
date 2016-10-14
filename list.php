<?php require("header.php")?>
<body>
 <div class="container">

      <h1>Dylan's Job Hunt 2016</h1>

      <div class="well well-lg">
         <?php
         $retrieve = new Db_Connect();
         $control = new Controller($retrieve);
         $result = $control->retrieve_all("due");
         $array = array('University', 'Title','Announcement', 'Link', 'Website', 'Due Date');
         $output = new Output_view();
         echo $output->output($array, $result);
         ?>
      </div>

   </div>
</body>
<?php require("footer.php") ?>
