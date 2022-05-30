<?php

class Signin extends Db {

    private $userName;
    private $email;
    private $pswd;
    private $pswdRepeat;

    public function __construct($userName, $email, $pswd, $pswdRepeat){
        $this->userName = $userName;
        $this->email = $email;
        $this->pswd = $pswd;
        $this->pswdRepeat = $pswdRepeat;
    }

    public function signInUsers(){

        if ($this->emptyInputSignin() == false){
            header("location: ../signin.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false){
            header("location: ../signin.php?error=invalidemail");
            exit();
        }
        if ($this->pswdMatch() == false){
            header("location: ../signin.php?error=pswdnotmatch");
            exit();
        }
        if ($this->userExists() == false){
            header("location: ../signin.php?error=userExist");
            exit();
        }

        $this-> createUser();
        
    }


    // Checks the user fill all the spaces
    private function emptyInputSignin(){
        $result;
        if(empty($this->userName) || empty($this->email) || empty($this->pswd) || empty($this->pswdRepeat)){
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }
    
    // Checks the email valid or not
    private function invalidEmail(){
        $result;
        if(!filter_var($this-> email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    
    // Checks the passwords match or not
    private function pswdMatch(){
        $result;
        if($this-> pswd !== $this-> pswdRepeat){
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    private function userExists(){
        $stmt = $this->connect()->prepare("SELECT users_name FROM users WHERE users_name = ? OR users_email = ?;");
        // Checks is there any statement or sql error
        if(!$stmt->execute(array($this-> userName, $this-> email))){
            $stmt = null;
            header("location: ../signin.php?error=stmtfaild");
            exit();
        }

        $resultCheck;
        
        if($stmt->rowCount()>0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;
    }

    
    private function createUser(){
        $stmt = $this->connect()->prepare("INSERT INTO users (users_name, users_email, users_pswd) VALUES (?, ?, ?);");

        $hashedPswd = password_hash($this->pswd, PASSWORD_DEFAULT);

        // Checks is there any statement or sql error
        if(!$stmt->execute(array($this->userName, $this->email, $hashedPswd))){
            $stmt = null;
            header("location: ../signin.php?error=stmtfaild");
            exit();
        }
        $stmt = null;
    }

    
    public static function editProfile($oldUserName, $userName ,$email ,$pswd){
        // Checks if the inputs empty or not
        if(empty($oldUserName) || empty($userName) || empty($email) || empty($pswd)){
            $stmt = null;
            header("location: ../profile.php?error=emptyinput");
            exit();
        }

        $db = new Db();
        $stmt = $db->connect()->prepare("UPDATE users SET users_name = ?, users_email = ?, users_pswd = ? WHERE users_name = '$oldUserName';");
        
        $hashedPswd = password_hash($pswd, PASSWORD_DEFAULT);

        // Checks is there any statement or sql error
        if(!$stmt->execute(array($userName ,$email ,$hashedPswd))){
            $stmt = null;
            header("location: ../profile.php?error=stmtfaild");
            exit();
        }
        
        // Checking that if we have serial users if we have more than one or 0 throw an error
        if($stmt->rowCount() <= 0){
            $stmt = null;
            header("location: ../profile.php?error=stmtfaild");
            exit();
        }
        $stmt = null;

        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
        exit();
    }
}