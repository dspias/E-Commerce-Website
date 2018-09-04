<?php
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

?>

<?php
	/**
	 * 	Brand class
	 */
	class Brand {
		
		private $db;
		private $fm;
		function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function brandInserst($brandName){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if(empty($brandName)){
				$msg = "Brand field must not be empty !";
				return $msg;
			} else {
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')" ;
				$brandInserst = $this->db->insert($query);

				if($brandInserst) {
					$msg = "<span class='success'>brand Inserted Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Brand not Inserted.</span> ";
					return $msg;
				}
			}
		}

		public function getAllBrand(){
			$query = "select * from tbl_brand order by brandId DESC";

			$result = $this->db->select($query);

			return $result;
		}

		public function getBrandById($id){
			$query = "select * from tbl_brand where brandId = '$id' ";

			$result = $this->db->select($query);

			return $result;
		}

		public function brandUpdate($brandName, $id){

			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id        = mysqli_real_escape_string($this->db->link, $id);

			if(empty($brandName)){
				$msg = "Brand field must not be empty !";
				return $msg;
			} else {
				$query = "UPDATE tbl_brand
						SET 
						brandName = '$brandName'
						WHERE brandId = '$id' ";
				$updated_row = $this->db->update($query);

				if($updated_row) {
					$msg = "<span class='success'>Brand Updated Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Brand not Updated.</span> ";
					return $msg;
				}
			}

		}

		public function delBrandById($id){
			$query = "DELETE FROM tbl_brand WHERE brandId = '$id' ";
			$deldata = $this->db->delete($query);

			if($deldata) {
					$msg = "<span class='success'>Brand Deleted Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Brand not Deleted.</span> ";
					return $msg;
				}
		}
}

?>