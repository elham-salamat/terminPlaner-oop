<?php

class user
{
    public $userId;
    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $pwd;
    public $regionId;
    public $userStatus;
    private $hashedPwd;

    public function __construct(array $input = array())
    {
        $this->userDetails($input);
    }

    protected function userDetails($input)
    {
        foreach ($input as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }


    public function existanceCheck()
    {

        $userName = $this->userName;
        $sqlRead = "SELECT * FROM user";
        $db = new databank();
        $result = $db->read($sqlRead);
        $string = "";

        for ($i = 0; $i < count($result); $i++) {

            if (strtoupper($userName) === strtoupper($result[$i]["userName"])) {
                $string .= "user already exists";

                return $result[$i]["userId"];
            }
        }
        return $string;
    }

    private function pwdHashing()
    {
        $this->hashedPwd = password_hash($this->pwd, PASSWORD_DEFAULT);
    }

    public function saveUser()
    {
        $string = "";

        if ($this->existanceCheck() === "") {
            $this->pwdHashing();

            $sqlInsert = "INSERT INTO user (firstName, lastName, userName, email, pwd, regionId) VALUES ('" . $this->firstName . "','" . $this->lastName . "','" . $this->userName . "','" . $this->email . "','" . $this->hashedPwd . "','" . $this->regionId . "')";

            $db = new databank();
            $result = $db->create($sqlInsert);
            return $result;
        } else {
            $string .= "user exists already!";
        }
        return $string;
    }
    public function userSignIn()
    {
        $enteredPwd = $this->pwd;

        if ($this->existanceCheck() !== "") {
            $userId = $this->existanceCheck();
            $this->getUser($userId);
            if (password_verify($enteredPwd, $this->pwd)) {
                // echo "successfuly signed in!";
                $_SESSION["userName"] = $this->userName;
                $_SESSION["userId"] = $this->userId;
                $_SESSION["signinstatus"] = "signedin";
                header("location: /" . BASIC_PATH . "/dashboard");
                exit();
            } else {
                echo "incorrect password!";
            }
        } else {
            echo "you should sign up first!";
        }
    }

    public function updateUser()
    {
        $this->pwdHashing();
        $sqlUpdate = "
                        UPDATE user SET
                        firstName = '" . $this->firstName . "', 
                        lastName = '" . $this->lastName . "',
                        email = '" . $this->email . "',
                        pwd = '" . $this->hashedPwd . "',
                        regionId = '" . $this->regionId . "',
                        userStatus = '" . $this->userStatus . "'
                        WHERE userId = " . $this->userId;

        $db = new databank();
        $result = $db->update($sqlUpdate);
        return $result;
    }

    public function getUser($userId)
    {
        $sqlRead = "SELECT * FROM user WHERE userId =" . $userId;
        $db = new databank();
        $result = $db->read($sqlRead);
        $this->userDetails($result[0]);
    }
}
