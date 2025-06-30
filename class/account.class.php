<?php
session_start();
require_once("../model/db.php");

class Account
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    /* protected $repeatPassword;
    protected $passwordHash; */
    protected $role;



    public function register($name, $email, $password, $repeatPassword, $role)
    {


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $this->role = $role;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        


        $errors = array();

        if (empty($this->name) or empty($this->email) or empty($this->password) or empty($repeatPassword)) { //Error : All fields are required
            array_unshift($errors, "All fields are required");
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //Error : Email is not valid
            array_unshift($errors, "Email is not valid");
        }
        if (strlen($this->password) < 8) {
            array_push($errors, "Password must be at least 8 charactes long"); //Error : Password must be at least 8 charactes long
        }
        if ($this->password !== $repeatPassword) {
            $errors[] = "Password does not match"; //Error : Password does not match
        }
        $db = new Db();
        $db->connect();

        $sql = "SELECT * FROM users WHERE email = '$this->email'"; //Error : Email already exists!
        $stmt = $db->connection->query($sql);

        if (mysqli_num_rows($stmt)) {
            array_push($errors, "Email already exists!");
        }

        if (count($errors) > 0) { //Error Counting.
            foreach ($errors as  $error) :
                echo "<div class='alert alert-danger'>$error</div>";
            endforeach;
        } else //Insert In Database
        {
            $sql = "INSERT INTO users (name, email, password, roleId) VALUES (?,?,?,?)";
            $stmt = $db->connection->prepare($sql);

            $stmt->execute([$this->name, $this->email, $passwordHash, $this->role]);

            if ($stmt) {
                header("Location:../include/test.php");
                exit();
            } else {
                die("Something went wrong");
            }
        }
    }

    public function logIn($email, $password)
    {

        $this->email = $email;
        $this->password = $password;

        $db = new Db();
        $db->connect();

        $sql = " SELECT * FROM users WHERE email = '$this->email' ";
        $stmt = $db->connection->query($sql);

        if (mysqli_num_rows($stmt)) {

            $row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);

            if (password_verify($this->password, $row["password"])) {
                $this->id = $row['id'];

                if ($row['roleId'] == 0) {
                    echo "USER";
                    $_SESSION['id'] = $this->id;
                    $_SESSION['role'] = "user";
                    /* header( "Location: index.php" );
                    exit(); */
                } elseif ($row['roleId'] == 1) {
                    echo "ADMIN";
                    $_SESSION['id'] = $this->id;
                    $_SESSION['role'] = "admin";
                    /* header( "Location: admin.php" );
                    exit(); */
                } elseif ($row['roleId'] == 2) {
                    echo "RECEPTIONIST";
                    $_SESSION['id'] = $this->id;
                    $_SESSION['role'] = "receptionist";
                    /*  header( "Location: receptionist.php" );
                    exit(); */
                }
            } else {
                echo "password doesnt match";
            }
        } else {
            echo "Not Avalid Email";
        }
    }


    public function logOut()
    {
        session_destroy();
        header("Location: logIn.php");
        exit();
    }

    public function updateProfile($name, $email, $password)
    {
        $db = new Db();
        $db->connect();
        $this->name = $name;
        $this->email = $email;
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        $stmt = $db->connection->query($sql);
        if (mysqli_num_rows($stmt)) {
            echo " This Email Already exists ";
        } else {

            if (!isset($_POST['password'])) {
                $sql = "UPDATE users SET name = '$this->name',email = '$this->email' WHERE id = '$_SESSION[id]'";
                $db->connection->query($sql);
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET name = '$this->name',email = '$this->email',password = '$passwordHash' WHERE id = '$_SESSION[id]'";
                $db->connection->query($sql);
            }
        }
    }


    public function deleteAccount($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $db = new Db();
        $db->connect();
        $this->id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = '$this->id'";
        $stmt = $db->connection->query($sql);
        $row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
        if ($row['email'] == $this->email && password_verify($this->password, $row['password'])) {
            $sql = "DELETE * FROM users WHERE id = '$this->id'";
            $db->connection->query($sql);
            echo "deleted";
        } else {
            echo "Please Enter A Valid Data";
        }
    }
}

