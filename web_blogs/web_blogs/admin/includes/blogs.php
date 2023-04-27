<?php  
class blogs{

	//DB params
	private $table = "blog_post";
	private $conn;

	//blog_post properties
	public $blog_id;
	public $category_id;
	public $blog_name;
	public $blog_summary;
	public $blog_content;
	public $blog_main_image;
	public $blog_alt_image;
	public $blog_place;
	public $blog_status;
	public $blog_date_created;


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
	public function total (){
		$sql = "SELECT COUNT(*) FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$number_record = $stmt->fetchColumn();
		return $number_record;
	}
	//Read records homeplace
	public function read_homeplace(){
		$sql = "SELECT * FROM $this->table WHERE blog_place !=0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	//Read one record
	public function read(){
		$sql = "SELECT * FROM $this->table WHERE blog_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->blog_id);
		$stmt->execute();
		$row = $stmt->fetch();

		$this->blog_id = $row['blog_id'];
		$this->category_id = $row['category_id'];
		$this->blog_name = $row['blog_name'];
		$this->blog_summary = $row['blog_summary'];
		$this->blog_content = $row['blog_content'];
		$this->blog_main_image = $row['blog_main_image'];
		$this->blog_alt_image = $row['blog_alt_image'];
		$this->blog_place = $row['blog_place'];
		$this->blog_status = $row['blog_status'];
		$this->blog_date_created = $row['blog_date_created'];
	}

	//Add record
	public function add(){
		$sql = "INSERT INTO $this->table
				SET category_id = :new_category_id,
					blog_name = :new_blog_name,
					blog_summary = :new_blog_summary,
					blog_content = :new_blog_content,
					blog_main_image = :new_blog_main_image,
					blog_alt_image = :new_blog_alt_image,
					blog_place = :new_blog_place,
					blog_status = 1,
					blog_date_created = localtime()";

	
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_category_id",$this->category_id);
		$stmt->bindParam(":new_blog_name",$this->blog_name);
		$stmt->bindParam(":new_blog_summary",$this->blog_summary);
		$stmt->bindParam(":new_blog_content",$this->blog_content);
		$stmt->bindParam(":new_blog_main_image",$this->blog_main_image);
		$stmt->bindParam(":new_blog_alt_image",$this->blog_alt_image);
		$stmt->bindParam(":new_blog_place",$this->blog_place);


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
				SET category_id = :new_category_id,
					blog_name = :new_blog_name,
					blog_summary = :new_blog_summary,
					blog_content = :new_blog_content,
					blog_main_image = :new_blog_main_image,
					blog_alt_image = :new_blog_alt_image,
					blog_place = :new_blog_place,
					blog_status = :new_blog_status,
					blog_date_created = localtime()
				WHERE blog_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":new_category_id",$this->category_id);
		$stmt->bindParam(":new_blog_name",$this->blog_name);
		$stmt->bindParam(":new_blog_summary",$this->blog_summary);
		$stmt->bindParam(":new_blog_content",$this->blog_content);
		$stmt->bindParam(":new_blog_main_image",$this->blog_main_image);
		$stmt->bindParam(":new_blog_alt_image",$this->blog_alt_image);
		$stmt->bindParam(":new_blog_place",$this->blog_place);
		$stmt->bindParam(":new_blog_status",$this->blog_status);
		$stmt->bindParam(":get_id",$this->blog_id);

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
		$sql = "DELETE FROM $this->table WHERE blog_id = :get_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->blog_id);

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