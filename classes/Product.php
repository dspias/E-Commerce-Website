<?php
	include_once '../lib/Database.php';
	include_once '../helpers/Format.php';

?>

<?php

/**
 * 	Product class
 */
class Product {
	
	private $db;
	private $fm;
	function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function productInserst($data, $file){

		$productName = $this->fm->validation($data['productName']);
		$productName = mysqli_real_escape_string($this->db->link, $productName);

		$catId = $this->fm->validation($data['catId']);
		$catId = mysqli_real_escape_string($this->db->link, $catId);

		$brandId = $this->fm->validation($data['brandId']);
		$brandId = mysqli_real_escape_string($this->db->link, $brandId);

		$body = $this->fm->validation($data['body']);
		$body = mysqli_real_escape_string($this->db->link, $body);

		$price = $this->fm->validation($data['price']);
		$price = mysqli_real_escape_string($this->db->link, $price);

		$type = $this->fm->validation($data['type']);
		$type = mysqli_real_escape_string($this->db->link, $type);


		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
		

		if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == "" ){
			$msg = "<span class='error'>field must not be empty !</span> ";
			return $msg;
		} elseif ($file_size >1048567) {
		     echo "<span class='error'>Image Size should be less then 1MB!</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		} else {
			move_uploaded_file($file_temp, $uploaded_image);

			$query = "INSERT INTO tbl_product ( productName, catId, brandId, body, price, image, type ) VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type' )";

			$inserted_row = $this->db->insert($query);

				if($inserted_row) {
					$msg = "<span class='success'>Product Inserted Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not Inserted.</span> ";
					return $msg;
				}
		}
	}

	public function getAllProduct() {
		$query = "SELECT  tbl_product.*, tbl_category.catName, tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId
		 		ORDER BY tbl_product.productId DESC" ;

		$result = $this->db->select($query);

		return $result;
	}

	public function getProductById($id){
		$query = "select * from tbl_product where productId = '$id' ";

			$result = $this->db->select($query);

			return $result;
	}

	public function productUpdate($data, $file, $id){


		$productName = $this->fm->validation($data['productName']);
		$productName = mysqli_real_escape_string($this->db->link, $productName);

		$catId = $this->fm->validation($data['catId']);
		$catId = mysqli_real_escape_string($this->db->link, $catId);

		$brandId = $this->fm->validation($data['brandId']);
		$brandId = mysqli_real_escape_string($this->db->link, $brandId);

		$body = $this->fm->validation($data['body']);
		$body = mysqli_real_escape_string($this->db->link, $body);

		$price = $this->fm->validation($data['price']);
		$price = mysqli_real_escape_string($this->db->link, $price);

		$type = $this->fm->validation($data['type']);
		$type = mysqli_real_escape_string($this->db->link, $type);


		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
		

		if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" ){
			$msg = "<span class='error'>field must not be empty !</span> ";
			return $msg;
		} else{

			if(!empty($file_name)){
				if ($file_size >1048567) {
				     echo "<span class='error'>Image Size should be less then 1MB!</span>";
				} elseif (in_array($file_ext, $permited) === false) {
				    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
				} else {
					move_uploaded_file($file_temp, $uploaded_image);

					$query = " UPDATE tbl_product
							SET
							productName = '$productName',
							catId 		= '$catId',
							brandId		= '$brandId',
							body 		= '$body',
							price 		= '$price',
							image = '$uploaded_image',
							type = '$type'
							WHERE productId = '$id' ";

					$updated_row = $this->db->update($query);

					if($updated_row) {
						$msg = "<span class='success'>Product updated Successfully.</span> ";
						return $msg;
					} else {
						$msg = "<span class='error'>Product not Updated.</span> ";
						return $msg;
					}
				}
			} else{

				$query = " UPDATE tbl_product
							SET
							productName = '$productName',
							catId 		= '$catId',
							brandId		= '$brandId',
							body 		= '$body',
							price 		= '$price',
							type = '$type'
							WHERE productId = '$id' ";

				$updated_row = $this->db->update($query);

				if($updated_row) {
					$msg = "<span class='success'>Product updated Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not Updated.</span> ";
					return $msg;
				}
			}
		}

	}


	public function delProductById($id){

		$delquery = "SELECT * FROM tbl_product WHERE productId = '$id' ";
		$getData = $this->db->select($delquery);

		if($getData){
			while ($delImg = $getData->fetch_assoc()) {
				$dellink = $delImg['image'];
				unlink($dellink);
			}
		}

		$query = "DELETE FROM tbl_product WHERE productId = '$id' ";
		$deldata = $this->db->delete($query);

		if($deldata) {
			$msg = "<span class='success'>Product Deleted Successfully.</span> ";
			return $msg;
		} else {
			$msg = "<span class='error'>Product not Deleted.</span> ";
			return $msg;
		}
	}

}
?>