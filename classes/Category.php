<?php
	include_once '../lib/Database.php';
	include_once '../helpers/Format.php';

?>

<?php
	/**
	 * 	Category class
	 */
	class Category {
		
		private $db;
		private $fm;
		function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function catInserst($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName)){
				$msg = "Category field must not be empty !";
				return $msg;
			} else {
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')" ;
				$catInserst = $this->db->insert($query);

				if($catInserst) {
					$msg = "<span class='success'>Category Inserted Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Category not Inserted.</span> ";
					return $msg;
				}
			}
		}

		public function getAllCat(){
			$query = "select * from tbl_category order by catId DESC";

			$result = $this->db->select($query);

			return $result;
		}

		public function getCatById($id){
			$query = "select * from tbl_category where catId = '$id' ";

			$result = $this->db->select($query);

			return $result;
		}


		public function catUpdate($catName, $id){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($catName)){
				$msg = "Category field must not be empty !";
				return $msg;
			} else {
				$query = "UPDATE tbl_category 
						SET 
						catName = '$catName'
						WHERE catId = '$id' ";
				$updated_row = $this->db->update($query);

				if($updated_row) {
					$msg = "<span class='success'>Category Updated Successfully.</span> ";
					return $msg;
				} else {
					$msg = "<span class='error'>Category not Updated.</span> ";
					return $msg;
				}
			}

		}

		public function delCatById($id){
			$query = "DELETE FROM tbl_category WHERE catId = '$id' ";
			$deldata = $this->db->delete($query);

			if($deldata) {
				$msg = "<span class='success'>Category Deleted Successfully.</span> ";
				return $msg;
			} else {
				$msg = "<span class='error'>Category not Deleted.</span> ";
				return $msg;
			}
		}



	}
?>