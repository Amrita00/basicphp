<?php
include('DBconnect.php');
session_start();

class DBfunction
{

    function __construct()
    {

        $this->dbh = DBconnect::getInstance();
    }

    public function emailfree($email)
    {
        try {
            header('Content-Type: application/json');
            //$result = $this->dbh->query("SELECT * FROM tblregister WHERE email = :email'");
            $query = "SELECT email FROM tblregister WHERE email = :email";
            $obj = $this->dbh->prepare($query);
            $params = [
                "email" => $email
            ];
            $obj->execute($params);            
            if ($obj->rowCount() > 0) {
                $response = [
                    "message" => "Email already registered",
                    "status" => "error"
                ];
            } else {
                $response = [
                    "message" => "email available",
                    "status" => "success"
                ];
            }
            return json_encode($response);
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die;
        }
        return false;
    }


    public function usernamefree($username)
    {
        try {
            $query = "SELECT * FROM tblregister WHERE username = :username";
            $ans = $this->dbh->prepare($query);

            $params = [
                "username" => $username
            ];

            return $ans->execute($params);
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die;
        }
        return false;
    }

    public function registration($fname, $lname, $dob, $email, $number, $username, $password)
    {

        try {
            $reg = "INSERT INTO tblregister(firstname, lastname, dob, email, pnumber, username, password)VALUES (:fname, :lname, :dob, :email, :number, :username, :password)";

            $stmt = $this->dbh->prepare($reg);


            $params =  [
                "fname" => $fname,
                "lname" =>  $lname,
                "dob" => $dob,
                "email" => $email,
                "number" => $number,
                "username" => $username,
                "password" => $password

            ];

            return $stmt->execute($params);
        } catch (Throwable $e) {
            //die("Error: could not execute $reg.".$e->getMessage());
            var_dump($e->getMessage());
            die;
        }

        return false;
    }

    public function login($username, $password)
    {
        try {
            $query = "SELECT * FROM tblregister WHERE username = :username AND password = :password ";
            $answer = $this->dbh->prepare($query);
            
            $params = [
                "username" => $username,
                "password" => $password
            ];
            
            $answer->execute($params);
            
            return $answer->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die;
        }
        return false;
    }
    public function getuser(){

        try{
            $query = "SELECT * FROM tblregister";
            $result = $this->dbh->query($query);
            $result->execute();
            return $result->fetchALL(PDO::FETCH_ASSOC);
            

            

        }catch(Throwable $e){
            var_dump($e->getMessage());
            die;
        }
    }
}
