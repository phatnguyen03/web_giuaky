<?php  
class categories{

	//DB params
	private $table = "blog_categories";
	private $conn;

	//Myguests properties
	public $category_id;
	public $category_name;
	public $category_description;
	public $category_date_created;

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
		$sql = "SELECT * FROM $this->table WHERE category_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->category_id);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
		$this->category_description = $row['category_description'];
		$this->category_date_created = $row['category_date_created'];
	}

	//Add record
	public function add(){
		$sql = "INSERT INTO $this->table
				SET category_name = :new_name,
					category_description = :new_description";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_name",$this->category_name);
		$stmt->bindParam(":new_description",$this->category_description);


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
				SET category_name = :new_name,
					category_description = :new_description,
					category_date_created = localtime()
				WHERE category_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_name",$this->category_name);
		$stmt->bindParam(":new_description",$this->category_description);
		$stmt->bindParam(":get_id",$this->category_id);

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
		$sql = "DELETE FROM $this->table WHERE category_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->category_id);

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