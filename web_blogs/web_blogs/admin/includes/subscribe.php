<?php 
class subscribes {

	//DB params
		private $table = "blog_subscriber";
		private $conn;
	//blog_subscribe properties
		public $s_sub_id;
		public $s_sub_email;
		public $s_date_created;
		public $s_sub_status;

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
		// Select total record
		public function total (){
			$sql = "SELECT COUNT(*) FROM $this->table";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$number_record = $stmt->fetchColumn();
			return $number_record;
		}
		//Read one record
		public function read(){
			$sql = "SELECT * FROM $this->table WHERE s_sub_id = :get_id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":get_id",$this->s_sub_id);
			$stmt->execute();
			$row = $stmt->fetch();

			$this->s_sub_id = $row['s_sub_id'];
			$this->s_sub_email = $row['s_sub_email'];
			$this->s_date_created = $row['s_date_created'];
			$this->s_sub_status = $row['s_sub_status'];
		}

		//Add record
		public function add(){
			$sql = "INSERT INTO $this->table
					SET s_sub_email = :new_sub_email,
						s_date_created = localtime(),
						s_sub_status=1";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":new_sub_email",$this->s_sub_email);

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
						s_sub_email = :new_sub_email,
						s_date_created = localtime(),
						s_sub_status=:new_sub_status
						
					WHERE s_sub_id= :get_id";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":new_sub_email",$this->s_sub_email);
			$stmt->bindParam(":new_sub_status",$this->s_sub_status);
			$stmt->bindParam(":get_id",$this->s_sub_id);
			try{
				if($stmt->execute()){
					return true;
				}
			}catch(PDOException $e){
				echo "Error insert record: <br>".$e->getMessage();
				return false;
			}
		}
		public function delete(){
			$sql = "DELETE FROM $this->table WHERE s_sub_id = :get_id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(":get_id",$this->s_sub_id);

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