<?php 

	// Method Check file
	function validateUploadFile($fileUpload,$uploadPath) {
		// Check dung lượng file (< 8 mb)
		if($fileUpload['size'] > 8*1024*1024) {
			return false;
		}
		// Check kiểu file 
		$validTypes = array("jpg","jpeg","png","bmp","gif");
		$fileType = substr($fileUpload["name"],strrpos($fileUpload["name"],".")+1 );
		if(!in_array($fileType, $validTypes)){
			return false;
		}
		// Check file đã tồn tại
		$num =1;
		$fileName = substr($fileUpload["name"],0,strrpos($fileUpload["name"],"."));
		while (file_exists($uploadPath."/".$fileName.$fileType)) {
			$fileName=$fileName."(".$num.")";
			$num++;
		}
		$fileUpload['name']=$fileName.'.'.$fileType;
		return $fileUpload;
	}
?>