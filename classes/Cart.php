<?php

	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php

/**
 * 	Cart class start
 */
class Cart {
	
	private $db;
	private $fm;
	function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function addToCart($quantity, $id){
		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);

		$productId = mysqli_real_escape_string($this->db->link, $id);

		$sId = session_id();

		$squery = "SELECT * FROM tbl_product WHERE productId = '$productId' ";

		$result = $this->db->select($squery)->fetch_assoc();

		$productName = $result['productName'];

		$price 		 = $result['price'];

		$image 		 = $result['image'];

		$chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' ";

		// $getPro = $this->db->select($chquery)->fetch_assoc();

		// if ($getPro) {
		// 	$msg = "Product allready added";
		// 	return $msg;
		// } else{

			$query = "INSERT INTO tbl_cart ( sId, productId, productName, price, quantity, image ) VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image' )";

			$inserted_row = $this->db->insert($query);

			if($inserted_row) {
				header("Location:cart.php");
			} else {
				header("Location:404.php");
			}

		//}
	}

	public function getCartProduct(){

		$sId = session_id();

		$query = "select * from tbl_cart where sId = '$sId' ";

		$result = $this->db->select($query);

		return $result;
	}

	public function updateCartById($quantity, $cartId){
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$cartId = mysqli_real_escape_string($this->db->link, $cartId);

		$query = "UPDATE tbl_cart 
						SET 
						quantity = '$quantity'
						WHERE cartId = '$cartId' ";
		$updated_row = $this->db->update($query);

		if($updated_row) {
			$msg = "<span class='success'>quantity Updated Successfully.</span> ";
			return $msg;
		} else {
			$msg = "<span class='error'>quantity not Updated.</span> ";
			return $msg;
		}
	}

	public function deleteCartProductById($id){
		$cartId = mysqli_real_escape_string($this->db->link, $id);

		$query = "DELETE FROM tbl_cart WHERE cartId = '$cartId' ";
		$deldata = $this->db->delete($query);

		if($deldata) {
			echo "<script>window.location = 'cart.php'</script>";
		} else {
			$msg = "<span class='error'>Product not Deleted.</span> ";
			return $msg;
		}
}
}
?>