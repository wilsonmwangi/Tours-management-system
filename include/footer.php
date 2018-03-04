			</div>
		</div>
	</div>
	<?php 
		$social=$obj->manegeSocial($conn); 
	?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p class="socialMedia">
						<a href="<?php echo $social['facebook']; ?>"><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/facebook.png" /></a>
						<a href="<?php echo $social['twitter']; ?>"><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/twitter.png" /></a>
						<a href="<?php echo $social['googlePlus']; ?>"><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/googlePlus.png" /></a>
						<a href="<?php echo $social['linkedIn']; ?>"><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/linkedIn.png" /></a>
					</p>
				</div>
				<div class="col-md-7 col-xs-12 aboutWeb">
					<h4><img src="<?php echo $obj->rootpath($conn); ?>/uploads/images/<?php echo $obj->logo($conn); ?>" height="30" /> <?php echo $obj->title($conn)?></h4>
					<p>
						<?php echo $language['shortDetailsAboutWeb']; ?>
					</p>
				</div>
				<div class="col-xs-12">
					<hr>
				</div>
				<div class="col-md-6 col-xs-12">
					<p class="copRight">
						© <b><?php echo $obj->title($conn); ?></b> <?php echo date("Y"); ?> <?php echo $language['poweredBy']; ?> <a href="http://picxellabs.com">Picxellabs</a>, <?php echo $language['allRights']; ?>
					</p>
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="pages">
					<?php echo $obj->getPages($conn); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/jquery.js"></script>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/bootstrap.js"></script>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/jquery-ui.js"></script>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/editor/ckeditor.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyCfzweY4gsAE7oEElrQFvJtqz8024peXXY"></script>
	<script src="<?php echo $obj->rootpath($conn); ?>/js/script.php"></script>
	</body>
</html>