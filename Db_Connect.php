<?php
class Db_Connect {
   private static $db;
   private static $uname;
   private static $password;
   private static $host;
   protected $conn;

   function __construct() {
      $config = parse_ini_file('../jobhunt_sec/config.ini');
      self::$host = $config['Host'];
      self::$db = $config['Database'];
      self::$uname = $config['Username'];
      self::$password = $config['Password'];

   }

   function connect() {
      try {
         $this->conn = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db . ';port=5282;charset=utf8', self::$uname, self::$password);
         return $this->conn;
      } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
         die();
      }
   }

   function add_to_db($stmts) {
      $conn = $this->conn;
      $stmt = $conn->prepare("INSERT INTO positions (school, title, announcement, listinglink, website, due) VALUES (:school, :title, :announcement, :listinglink, :website, :due)");
      $stmt->bindParam(':school', $stmts['school']);
      $stmt->bindParam(':title', $stmts['title']);
      $stmt->bindParam(':announcement', $stmts['announcement']);
      $stmt->bindParam(':listinglink', $stmts['listinglink']);
      $stmt->bindParam(':website', $stmts['website']);
      $stmt->bindParam(':due', $stmts['due']);
      $stmt->execute();
      echo "success";
   }

   function retrieve_from_db($col, $table, $index, $value) {
      $conn = $this->conn;
      $stmt = $conn->prepare("SELECT :" . $col . " FROM :" . $table . " WHERE :" . $index . "= :" . $value);
      $stmt->bindParam(':'. $col, $col);
      $stmt->bindParam(':'. $table, $table);
      $stmt->bindParam(':'. $index, $index);
      $stmt->bindParam(':'. $value, $value);
      $result = $stmt->execute();
      return $result;
   }

   function retrieve_list($col, $table) {
       $conn = $this->conn;
       $stmt = $conn->prepare("SELECT :" . $col . " FROM :" . $table);
       $stmt->bindParam(':' . $col, $col);
       $stmt->bindParam(':'. $table, $table);
       $result = $stmt->execute();
       return $result;
   }

   function retrieve_all($order) {
      $conn = $this->conn;
      $sql = "SELECT * FROM positions ORDER BY " . $order;
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return $stmt;
   }

   function retrieve_applied() {
       $conn = $this->conn;
       $sql = "SELECT a.*, p.school FROM applied a LEFT JOIN positions p on a.id = p.id";
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       return $stmt;
   }

   function apply($position, $notes) {
      $conn = $this->conn;
      $sql = "INSERT INTO applied (id, response, notes) VALUES (:id, :response, :notes)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id', $position);
      $stmt->bindParam(':response', $d_response);
      $stmt->bindParam(':notes', $notes);
      $stmt->execute();
      echo "Success!";
   }

   function add_notes($id, $note) {
       $conn = $this->conn;
       $old = retrieve_from_db("notes", "applied", "school", $school);
       $new = $old . " // " . $note;
       $sql = "UPDATE applied set notes=:note WHERE school=:school";
       $stmt = $conn->prepare($sql);
       $stmt->bindParam(':note', $new);
       $stmt->bindParam(':school', $school);
       $stmt->execute();
       echo "Success!";
   }

   function add_response($school, $response) {
       $conn = $this->conn;
       $sql = "UPDATE applied set response=:response WHERE school=:school";
       $stmt = $conn->prepare($sql);
       $stmt->bindParam(':response', $response);
       $stmt->bindParam(':school', $school);
       $stmt->execute();
       echo "Success!";
   }
}
