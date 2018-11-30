<?php

  class User extends Password{

    private $db;

    public function __construct($db) {
      $this->db = $db;
    }

    public function is_logged_in() {
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        return true;
      }
    }

    private function get_user_hash($username) {

      try {
        $stmt = $this->db->prepare("SELECT memberID, username, password FROM blog_members WHERE username = :username");
        $stmt->execute(array(":username"=>$username));
        return $stmt->fetch();
      } catch(PDOException $e) {
        echo "<p>".$e->getMessage()."</p>";
      }

    }

    public function login($username, $password) {
      $hashed = $this->get_user_hash($username);

      if($this->password_verify($password, $hashed['password']) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['memberID'] = $hashed['memberID'];
        $_SESSION['username'] = $hashed['username'];
        return true;
      }
    }

}

?>
