<?php

class Login extends Db {

    private $userName;
    private $pswd;

    public function __construct($userName, $pswd){
        $this->userName = $userName;
        $this->pswd = $pswd;
    }

    public function logInUsers(){

        if ($this->emptyInputLogin() == false){
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        $this-> getUser();
        
    }


    // Checks the user fill all the spaces
    private function emptyInputLogin(){
        $result;
        if(empty($this->userName) || empty($this->pswd)){
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    
    private function getUser(){
        $stmt = $this->connect()->prepare("SELECT users_pswd FROM users WHERE users_name = ? OR users_email = ?;");

        // Checks is there any statement or sql error
        if(!$stmt->execute(array($this->userName, $this->pswd))){
            $stmt = null;
            header("location: ../login.php?error=stmtfaild");
            exit();
        }
        
        // Checking that if we have serial users if we have more than one or 0 throw an error
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?error=stmtfaild");
            exit();
        }

        $pswdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPswd = password_verify($this->pswd, $pswdHashed[0]["users_pswd"]);

        if($checkPswd == false){
            $stmt = null;
            header("location: ../login.php?error=stmtfaild");
            exit();
        }
        elseif ($checkPswd === true){
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE users_name = ? OR users_email = ? AND users_pswd = ?;");

            // Checks is there any statement or sql error
            if(!$stmt->execute(array($this->userName, $this->userName, $this->pswd))){
                $stmt = null;
                header("location: ../login.php?error=stmtfaild");
                exit();
            }

            // Checking that if we have serial users if we have more than one throw an error
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../login.php?error=stmtfaild");
                exit();
            }

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["userid"] = $users[0]["users_id"];
            $_SESSION["useruid"] = $users[0]["users_name"];
            $_SESSION["usertype"] = $users[0]["users_type"];
            $stmt = null;
        }


        $stmt = null;
    }
}