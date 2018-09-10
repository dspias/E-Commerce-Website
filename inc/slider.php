<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

			<?php
				$getIphone = $pd->latetestFromIphone();

				if ($getIphone) {
					while ($riphone = $getIphone->fetch_assoc()) {
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $riphone['productId'];?>"> <img src="admin/<?php echo $riphone['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $riphone['productName'];?></h2>
						<p><?php echo $fm->textShorten($riphone['body'],40);?>.</p>
						<div class="button"><span><a href="details.php?productId=<?php echo $riphone['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			<?php } } ?>


			<?php
				$getSumsung = $pd->latetestFromSumsung();

				if ($getSumsung) {
					while ($rSumsung = $getSumsung->fetch_assoc()) {
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $rSumsung['productId'];?>"> <img src="admin/<?php echo $rSumsung['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $rSumsung['productName'];?></h2>
						<p><?php echo $fm->textShorten($rSumsung['body'],40);?>.</p>
						<div class="button"><span><a href="details.php?productId=<?php echo $rSumsung['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>

			</div>
			<div class="section group">
				<?php
				$getAsus = $pd->latetestFromAsus();

				if ($getAsus) {
					while ($rAsus = $getAsus->fetch_assoc()) {
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $rAsus['productId'];?>"> <img src="admin/<?php echo $rAsus['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $rAsus['productName'];?></h2>
						<p><?php echo $fm->textShorten($rAsus['body'],40);?>.</p>
						<div class="button"><span><a href="details.php?productId=<?php echo $rAsus['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			<?php } } ?>


			<?php
				$getCannon = $pd->latetestFromCannon();

				if ($getCannon) {
					while ($rCannon = $getCannon->fetch_assoc()) {
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $rCannon['productId'];?>"> <img src="admin/<?php echo $rCannon['image'];?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $rCannon['productName'];?></h2>
						<p><?php echo $fm->textShorten($rCannon['body'],40);?>.</p>
						<div class="button"><span><a href="details.php?productId=<?php echo $rCannon['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>