<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

class user {

    public $db;

    public function __construct()
    {
        $servername = "localhost";
        $dbname = "loculus_db";
        $username = "root";
        $password = "davesoul77";

        
        //connection
        try{
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);

            //set PDO error mode to exception
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
            #echo "connection successful";
        }catch(PDOException $e){
            #echo "connection failed: " .$e -> getMessage();
        }
    }


    public function validate_input($data){
        //validate user input by removing unnecessary chars
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    //signup
    public function signup($data){
        $username = $this->validate_input($data["username"]);
        $email = $this->validate_input($data["email"]);
        $password = $this->validate_input($data["password"]);


        //check potential existence of username and email in the database
        $namecheck = "select * from users where username = '$username'";

        $nameMatch = $this->manage_sql($namecheck);

        $emailcheck = "select * from users where email = '$email'";

        $emailMatch = $this->manage_sql($emailcheck);

        if ($nameMatch->rowcount() > 0 && $emailMatch->rowcount() > 0){
            $message = "username and password already used";
            return $message;
        }
        elseif ($nameMatch->rowcount() > 0){
            $message = "username already used";
            return $message;
            
        }
        elseif ($emailMatch->rowcount() > 0){
            $message = "email already used";
            echo $message;
            return $message;
            
        }

        try{
            $stmt = $this->db->prepare("insert into users (username, email, password) values (:username, :email, :password)");

            $stmt->bindparam(':username', $username);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':password', $password);

            $stmt->execute();

            mkdir("/Directories/$username");

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }


    //login
    public function login($data){
        $user = $this->validate_input($data["username_email"]);
        $password = $this->validate_input($data["password"]);
        echo $user;
        try{
            $stmt = $this->db->prepare("select * from users where username=:u and password=:p or email=:u and password=:p limit 1");

            $stmt->bindparam(':u', $user);
            $stmt->bindparam(':p', $password);
            $stmt->execute();

            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowcount() > 0){
                // session_start();
                echo $user;
                $_SESSION['id']=$result['user_id'];
                echo $_SESSION['id'];
                $_SESSION['username']=$result['username'];
                $_SESSION['email']=$result['email'];
                $_SESSION['password']=$result['password'];
                header('location: menu.php');
            }else{
                if(isset($_SESSION['log_attempt'])){
                    $_SESSION['log_attempt'] += 1;

                    if($_SESSION['log_attempt'] = 3){
                        $_SESSION['lock'] = time();
                    }

                }else{
                    $_SESSION['lock'] = 1;
                }

                $message = "invalid user credentials";
                echo $message;
                return $message;
            }

        }catch(PDOException $e){
            $e->getMessage();
            echo $e;
        }
    }


    public function logout() {   
        // session_start();
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
    }



    //bind parameters to sql statement and execute the query
    public function manage_sql($stmt0){

        try{
            $stmt = $this->db->prepare($stmt0);
            
            $stmt->execute();
            
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

class item{
    public function find_element(){
        $user = new user();

        $stmt = "select * from user";
        $user->manage_sql($stmt);
    }

    public function upload(){

        // echo $_FILES["toUpload"]["name"];
        // $_FILES["toUpload"] = $data;
        $target_dir = "../";
        $target_file = $target_dir.basename($_FILES["toUpload"]["name"]);
        echo $target_file;
        // $uploadOk = 1;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // $file_all = strtolower(pathinfo($target_file, PATHINFO_ALL));
        


        //check if file exist
        if (file_exists($target_file)){
            echo "sorry, file already exists.";
            $uploadOk = 0;
        }else{
            if(move_uploaded_file($_FILES["toUpload"]["tmp_name"], $target_file)){
                echo $_FILES["toUpload"]["tmp_name"]."has been uploaded";
            }
            else{
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// echo str_replace('.', ' ', "It.2017.TRUEFRENCH.BDRip.XviD-GZR.avi")


?>
