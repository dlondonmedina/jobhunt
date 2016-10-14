
<?php
class Output_view {

   protected $content;

   public function output($headings, $results) {
      echo '<table class="table table-striped"><thead><tr><th></th>';
      foreach ($headings as $heading) {echo "<th>".$heading."</th>";}
      echo '</tr></thead><tbody>';
      while($row = $results->fetch(PDO::FETCH_ASSOC)) {
      	echo '<tr>';
	foreach($row as $k=>$v) {
		if ($k == 'announcement') {
			echo '<td>' . substr($v, 0, 144) . '</td>';
		} elseif ($k == 'listinglink' || $k == 'website') {
	 		echo '<td><a href="' . $v . '">' . substr($v, 0, 20) . '</a></td>';
		} else {	 
			echo '<td>' . $v . '</td>';
		}
	}
	echo '</tr>';
      } 
      echo '</tbody></table>';	
   }
   
}
