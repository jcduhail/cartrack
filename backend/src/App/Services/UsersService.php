<?php

namespace App\Services;

use PDO;

class UsersService extends BaseService
{

    public function getOne($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM users WHERE id=?", [(int) $id]);
    }

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM users");
    }

    function save($user)
    {
        $this->db->insert("users", $user);
        return $this->db->lastInsertId();
    }

    function update($id, $user)
    {
        return $this->db->update('users', $user, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("users", array("id" => $id));
    }

    public function login($request) {
        $data = json_decode($request->getContent());
        try {
            $db = $this->db;
            $userData ='';
            $sql = "SELECT user_id, name, email, username FROM users WHERE (username=:username or email=:username) and password=:password ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("username", $data->username, PDO::PARAM_STR);
            $password=hash('sha256',$data->password);
            $stmt->bindParam("password",  $password, PDO::PARAM_STR);
            $stmt->execute();
            $mainCount=$stmt->rowCount();
            $userData = $stmt->fetch(PDO::FETCH_OBJ);
            if(!empty($userData))
            {
                $user_id=$userData->user_id;
                $userData->token = $this->apiToken($user_id);
            }
            $db = null;
            if($userData){
                $userData = json_encode($userData);
                return '{"userData": ' .$userData . '}';
            } else {
                return '{"error":{"text":"Bad request wrong username and password"}}';
            }
            
        }
        catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    
    
    /* ### User registration ### */
    function signup(Request $request) {
        
        $data = json_decode($request->getContent());
        $email=$data->email;
        $name=$data->name;
        $username=$data->username;
        $password=$data->password;
        try {
            $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
            $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
            $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);
            
            if (strlen(trim($username))>0 && strlen(trim($password))>0 && strlen(trim($email))>0 && $email_check>0 && $username_check>0 && $password_check>0)
            {
                $userData = '';
                $sql = "SELECT user_id FROM users WHERE username=:username or email=:email";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("username", $username,PDO::PARAM_STR);
                $stmt->bindParam("email", $email,PDO::PARAM_STR);
                $stmt->execute();
                $mainCount=$stmt->rowCount();
                $created=time();
                if($mainCount==0)
                {
                    /*Inserting user values*/
                    $sql1="INSERT INTO users(username,password,email,name)VALUES(:username,:password,:email,:name)";
                    $stmt1 = $db->prepare($sql1);
                    $stmt1->bindParam("username", $username,PDO::PARAM_STR);
                    $password=hash('sha256',$data->password);
                    $stmt1->bindParam("password", $password,PDO::PARAM_STR);
                    $stmt1->bindParam("email", $email,PDO::PARAM_STR);
                    $stmt1->bindParam("name", $name,PDO::PARAM_STR);
                    $stmt1->execute();
                    $userData=internalUserDetails($email);
                }
                
                if($userData){
                    $userData = json_encode($userData);
                    echo '{"userData": ' .$userData . '}';
                } else {
                    echo '{"error":{"text":"Enter valid data"}}';
                }
                
            }
            else{
                echo '{"error":{"text":"Enter valid data"}}';
            }
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    
    private function apiToken($session_uid)
    {
        $key=md5(SITE_KEY.$session_uid);
        return hash('sha256', $key);
    }
    

}
