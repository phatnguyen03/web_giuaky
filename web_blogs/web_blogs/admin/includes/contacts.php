<?php 
	class contacts{

	
		//DB params
		private $table = "blog_contact";
		private $conn;

		//blog_contact properties
		public $c_contact_id;
		public $c_fullname;
		public $c_email;
		public $c_phone;
		public $c_message;
		public $c_date_created;
		public $c_contact_status;

		public function __construct ($db){
			$this->conn=$db;
		}
		//Read all records
		public function read_all(){
			$sql = "SELECT * FROM $this->table";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
		public function total (){
			$sql = "SELECT COUNT(*) FROM $this->table";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$number_record = $stmt->fetchColumn();
			return $number_record;
		}
		//Read one record
		public function read(){
			$sql = "SELECT * FROM $this->table WHERE c_contact_id = :get_id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":get_id",$this->c_contact_id);
			$stmt->execute();
			$row = $stmt->fetch();

			$this->c_contact_id = $row['c_contact_id'];
			$this->c_fullname = $row['c_fullname'];
			$this->c_email = $row['c_email'];
			$this->c_phone = $row['c_phone'];
			$this->c_message = $row['c_message'];
			$this->c_date_created = $row['c_date_created'];
			$this->c_contact_status = $row['c_contact_status'];
		}
		//Add record
		public function add(){
			$sql = "INSERT INTO $this->table
					SET c_fullname = :new_fullname,
						c_email = :new_email,
						c_phone = :new_phone,
						c_message = :new_message,
						c_date_created = localtime(),
						c_contact_status=1";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":new_fullname",$this->c_fullname);
			$stmt->bindParam(":new_email",$this->c_email);
			$stmt->bindParam(":new_phone",$this->c_phone);
			$stmt->bindParam(":new_message",$this->c_message);


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
					SET
						c_fullname = :new_fullname,
						c_email = :new_email,
						c_phone = :new_phone,
						c_message = :new_message,
						c_date_created = localtime(),
						c_contact_status=:new_contact_status
					WHERE c_contact_id= :get_id";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":new_fullname",$this->c_fullname);
			$stmt->bindParam(":new_email",$this->c_email);
			$stmt->bindParam(":new_phone",$this->c_phone);
			$stmt->bindParam(":new_message",$this->c_message);
			$stmt->bindParam(":new_contact_status",$this->c_contact_status);
			$stmt->bindParam(":get_id",$this->c_contact_id);
			try{
				if($stmt->execute()){
					return true;
				}
			}catch(PDOException $e){
				echo "Error insert record: <br>".$e->getMessage();
				return false;
			}
		}
		//Delete record
		public function delete(){
			$sql = "DELETE FROM $this->table WHERE c_contact_id = :get_id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":get_id",$this->c_contact_id);

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