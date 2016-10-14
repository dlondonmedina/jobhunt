<?php
class Input_form {


   public function __construct() {
   }

   public function output() {
      $html = '<form method="post">University Name: <input name="school" size="80"> <br>Job Title: <input name="title" size="80"> <br>Link: <input name="listinglink" size="80"> <br>Website: <input name="website" size="80"> <br>Due Date: <input type="date" name="due" min="2016-07-01" max="2017-08-01"> <br><h3>Announcement:</h3> <br><textarea name="announcement" rows="10" cols="80"></textarea> <br><br><input type="submit" name="submit" value="SUBMIT"></form>';

      return $html;

   }

}
