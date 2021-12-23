<?php
class Coment {
   private $user_id;
   private $textc;
   private $timec;

   public function __construct($user_id = '', $textc = '', $timec = '')
   {
       $this->user_id = $user_id;
       $this->textc = $textc;
       $this->timec = $timec;
   }

   public function add($conn, $for_id = 0) {
       $sql = "INSERT INTO coments (user_id, textc, timec, for_id)
           VALUES ('$this->user_id', '$this->textc','$this->timec', '$for_id')";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public function edit($conn, $id) {
       $sql = "UPDATE coments SET textc='$this->textc' WHERE id=$id;";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
   }

   public static function all($conn, $id) {
       $sql = "SELECT * FROM coments WHERE for_id=$id";
       $result = $conn->query($sql); //виконання запиту
       if ($result !== false && $result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }

   public static function delete($conn, $id) {
       $sql = "DELETE FROM coments WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
          return true;
   }
}

public static function byId($conn, $id) {
       $sql = "SELECT * FROM coments WHERE id=$id";
       $result = $conn->query($sql); //виконання запиту
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr[0];
       } else {
           return [];
       }
   }
}