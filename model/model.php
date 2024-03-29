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


    // check permissions
    public function checkPermission($user_id, $dir_id){
        $stmt = "SELECT * FROM user_directory WHERE user_id = $user_id AND directory_id = $dir_id";
        // $stmt = "SELECT * FROM user_directory a LEFT JOIN directories b on a.directory_id = b.directory_id JOIN user_preferences c ON a.user_id = c.user_id WHERE b.directory_name = 'user_$id'  AND a.user_id = $id";

        $results = $this->manage_sql($stmt);

        return $results;
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

            $lastID = $this->db->prepare('select last_insert_id()');
            $lastID->execute();
            $row0 = $lastID->fetch(PDO::FETCH_ASSOC);

            // create home directory for new user
            mkdir("../../../Directories/user_".$row0['last_insert_id()']."", 0755, true);

            //insert into directories
            $homeFolder = "user_".$row0['last_insert_id()'];
            $homePath = "../Directories/user_".$row0['last_insert_id()'];
            $uploadtodb = $this->db->prepare("insert into directories (directory_name, path) values (:a, :b)");
            $uploadtodb->bindParam(":a", $homeFolder);
            $uploadtodb->bindParam(":b", $homePath);
            $uploadtodb->execute();
            $lastID1 = $this->db->prepare('select last_insert_id()');

            $lastID1->execute();
            $row = $lastID1->fetch(PDO::FETCH_ASSOC);

            // insert into user_directory
            $permission = 1;
            $uploadtodb = $this->db->prepare("insert into user_directory (user_id, directory_id, permission_id) values (:a, :b, :c)");
            $uploadtodb->bindParam(":a", $row0['last_insert_id()']);
            $uploadtodb->bindParam(":b", $row['last_insert_id()']);
            $uploadtodb->bindParam(":c", $permission);

            $uploadtodb->execute();


            // insert into user_preferences
            $uploadtodb = $this->db->prepare("insert into user_preferences (user_id) values (:a)");
            $uploadtodb->bindParam(":a", $row0['last_insert_id()']);

            $uploadtodb->execute();


            // insert into history
            $action = "create account";
            $uploadtodb = $this->db->prepare("insert into history (user_id, action) values (:a, :b)");
            $uploadtodb->bindParam(":a", $row0['last_insert_id()']);
            $uploadtodb->bindParam(":b", $action);

            $uploadtodb->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }


    //login
    public function login($data){
        $user = $this->validate_input($data["username_email"]);
        $password = $this->validate_input($data["password"]);

        try{
            $stmt = $this->db->prepare("select * from users where username=:u and password=:p or email=:u and password=:p limit 1");

            $stmt->bindparam(':u', $user);
            $stmt->bindparam(':p', $password);
            $stmt->execute();

            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowcount() > 0){

                if(isset($_SESSION['log_attempt'])){
                    unset($_SESSION['log_attempt']);
                }

                // session_start();
                $_SESSION['id']=$result['user_id'];
                $_SESSION['username']=$result['username'];
                $_SESSION['email']=$result['email'];
                $_SESSION['password']=$result['password'];
                
            }else{
                if(isset($_SESSION['log_attempt'])){
                    $_SESSION['log_attempt'] += 1;
                    $message = "invalid user credentials";
                    

                    if($_SESSION['log_attempt'] == 3){

                        $_SESSION['lock'] = time();

                        $message = "Too many login attempts. Wait for 3 min";
                    }

                }else{
                    $_SESSION['log_attempt'] = 1;
                    
                    $message = "Invalid user credentials";
                }

                return $message;
            }

        }catch(PDOException $e){
            $e->getMessage();
            echo $e;
        }
    }


    public function logout() {   
        // session_start();
        // unset($_SESSION['id']);
        // unset($_SESSION['username']);
        // unset($_SESSION['email']);
        // unset($_SESSION['password']);
        session_unset();
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
        $this->manage_sql($stmt);
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
