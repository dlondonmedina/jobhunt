<?php

class Controller {

   protected static $db;
   protected $order;

   public function __construct(Db_Connect $database) {
      $this->statement = "";
      self::$db = $database;

   }

   function into_database($array) {
      self::$db->connect();
      self::$db->add_to_db($array);
   }

   function retrieve($col, $table, $index, $value) {
      self::$db->connect();
      $result = self::$db->retrieve_from_db($col, $table, $index, $value);
      return $result;
   }

   function retrieve_list($col, $table) {
       self::$db->connect();
       $result = self::$db->retrieve_list($col, $table);
       return $result;
   }

   function retrieve_all($order) {
      self::$db->connect();
      $this->order = $order;
      $result = self::$db->retrieve_all($order);
      return $result;
   }

   function applied($post_vals) {
      self::$db->connect();
      self::$db->apply($post_vals);
   }

   function update_applied($id, $note, $response) {
       self::$db->connect();
       if (isset($response)) {
           self::$db->add_note($id, $note);
           self::$db->add_response($id, $response);
       } else {
           self::$db->add_note($id, $note);
       }
   }



}
