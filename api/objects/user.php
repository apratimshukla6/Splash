<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $wallet_id;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
        $this->wallet_id = random_int(100000, 999999);
    }
 
    // create new user record
    function create(){
 
    // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                Email_ID = :email,
                Username = :username,
                Password = :password,
                Wallet_ID = :wallet_id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
 
    // bind the values
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':wallet_id', $this->wallet_id);
 
    // hash the password before saving to database
    $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $password_hash);
 
    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

    //if email exists
    // check if given email exist in the database
    function emailExists(){
 
    // query to check if email exists
    $query = "SELECT ID, Email_ID, Username, Password
            FROM " . $this->table_name . "
            WHERE Email_ID = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id = $row['ID'];
        $this->username = $row['Username'];
        $this->email = $row['Email_ID'];
        $this->password = $row['Password'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
    }
 
// update() method will be here
 
}

?>