<?php  
class user{

	//DB params
	private $table = "blog_user";
	private $conn;

	//User properties
	public $user_id;
	public $user_email;
	public $user_password;
	public $user_fullname;
	public $user_phone;
	public $user_image;
	public $user_info;
	public $user_date_created;

	public function __construct($db){
		$this->conn = $db;
	}

	//Read all records
	public function read_all(){
		$sql = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	//Read one record
	public function read(){
		$sql = "SELECT * FROM $this->table WHERE user_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->user_id);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->user_id = $row['user_id'];
		$this->user_email = $row['user_email'];
		$this->user_password = $row['user_password'];
		$this->user_fullname = $row['user_fullname'];
		$this->user_phone = $row['user_phone'];
		$this->user_image = $row['user_image'];
		$this->user_infor = $row['user_infor'];
		$this->user_date_created = $row['user_date_created'];
		return $row;
	}

	//Login
	public function login(){
		$sql = "SELECT * FROM $this->table WHERE user_email = :get_email AND user_password = :get_password";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_email",$this->user_email);
		$stmt->bindParam(":get_password",$this->user_password);
		$stmt->execute();
		return $stmt;	
				
	}

	//Add record
	public function add(){
		$sql = "INSERT INTO $this->table
				SET user_email = :new_email,
					user_password = :new_password,
					user_fullname = :new_fullname,
					user_phone = :new_phone,
					user_image = :new_image,
					user_infor = :new_infor,
					user_date_created = localtime()";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_email",$this->user_email);
		$stmt->bindParam(":new_password",$this->user_password);
		$stmt->bindParam(":new_fullname",$this->user_fullname);
		$stmt->bindParam(":new_phone",$this->user_phone);
		$stmt->bindParam(":new_image",$this->user_image);
		$stmt->bindParam(":new_infor",$this->user_infor);


		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error insert record: <br>".$e->getMessage();
			return false;
		}
	}

	//Update record
	public function update(){
		$sql = "UPDATE $this->table
				SET user_email = :new_email,
					user_password = :new_password,
					user_fullname = :new_fullname,
					user_phone = :new_phone,
					user_image = :new_image,
					user_infor = :new_infor,
					user_date_created = localtime()
				WHERE user_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_email",$this->user_email);
		$stmt->bindParam(":new_password",$this->user_password);
		$stmt->bindParam(":new_fullname",$this->user_fullname);
		$stmt->bindParam(":new_phone",$this->user_phone);
		$stmt->bindParam(":new_image",$this->user_image);
		$stmt->bindParam(":new_infor",$this->user_infor);
		$stmt->bindParam(":get_id",$this->user_id);

		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error update record: <br>".$e->getMessage();
			return false;
		}
	}

	//Delete record
	public function delete(){
		$sql = "DELETE FROM $this->table WHERE user_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->user_id);

		try{
			if($stmt->execute()){
				return true;
			}
		}catch(PDOException $e){
			echo "Error delete record: <br>".$e->getMessage();
			return false;
		}
	}
}
?>