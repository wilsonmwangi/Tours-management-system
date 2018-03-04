<?php 
	include 'include/header.php'; 
	$page=1;
	$limit=10;
	$next=2;
	$prev=1; 
	if(isset($_GET['srch']) && $_GET['srch']!="")
		$sql = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE uid=".$logedInUser['id']." AND name LIKE '%".$_GET['srch']."%' OR email LIKE '%".$_GET['srch']."%' OR mobile LIKE '%".$_GET['srch']."%' OR address LIKE '%".$_GET['srch']."%'");
	else
		$sql = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE uid=".$logedInUser['id']."");
	$sql->execute();
	$rows = $sql->fetchColumn();
	$last = ceil($rows/$limit);
	if(isset($_GET['page']) && $_GET['page']!='' && ($_GET['page']>=1 && $_GET['page']<=$last)) {
		$page=$_GET['page'];
		if($page>1)
			$prev=$page-1;
		else
			$prev=$page;
		if($page<$last)
			$next=$page+1;
		else
			$next=$page;
	}
	if(isset($_GET['deleteBooking'])){
		$obj->deleteBooking($conn, $_GET['deleteBooking']);
		header("Location: ".$obj->rootpath($conn)."/profile/myBookings/1/");
	}
	if($_GET['values']){
		$values = explode(",",$_GET['values']);
		foreach($values as $value){ 
			$obj->deleteBooking($conn, $value);
		}
		header("Location: ".$obj->rootpath($conn)."/profile/myBookings/1/");
	}
	if(isset($_POST['updateUser'])){
		$name=$_POST['name'];
		if($name=="")
			$nameError=$language['nameError'];
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email) || $obj->thisemailExist($conn, $email, $logedInUser['email']))
			$emailError=$language['emailError'];
		$password=$_POST['password'];
		if($password=="" || strlen($password)<8)
			$passwordError=$language['passwordError'];
		if($password!=$logedInUser['password'])
			$password=md5($password);
		$mobile=$_POST['mobile'];
		if($mobile=="")
			$mobileError=$language['mobileError'];
		$address=$_POST['address'];
		if($address=="")
			$addressError=$language['addressError'];
		if(!$nameError && !$emailError && !$passwordError && !$mobileError && !$addressError){
			$obj->updateUser($conn, $name, $email, $password, $mobile, $address, $uid);
			$_SESSION['sessionEmail']=$email;
			$successMsg=$language['updateUserSuccess'];
		}
	}
	if(trim($_FILES["dpImg"]["name"]) != "") {
		$base = explode(".", strtolower(basename($_FILES["dpImg"]["name"])));
		$ext  = end($base);
		if($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			if($logedInUser['dp']!="userDp.jpg")
				unlink('uploads/image/dps/'.$logedInUser['dp']);
			$dp = uniqid()."." . $ext;
			$image = getimagesize($_FILES["dpImg"]["tmp_name"]);
			$width = $image[0];
			$height = $image[1];
			if($width<340 || $height<340)
				$imgError = $language['imgError'];
			if(!$imgError){
				move_uploaded_file($_FILES["dpImg"]["tmp_name"], "uploads/images/dps/" . $dp);
				$obj->resizeDp($dp);
				$obj->updateDps($conn, $dp, $uid);
				header('Location: '.$obj->rootpath($conn).'/profile/myBookings/1/');
			}
		} else {
			$imgError=$language['imgError1'];
		}
	}
	$logedInUser=$obj->getPublicPortfolio($conn, $uid);
?>

	</div>
</div>

<div class="page-heading">
	<img class="dp" src="<?php echo $obj->rootpath($conn); ?>/uploads/images/dps/<?php echo $logedInUser['dp']; ?>" />
	<div class="btn-changeDp">
		<button class="btn btn-success btn-chng btn-xs"><i class="fa fa-camera"></i></button>
		<form method="POST" enctype="multipart/form-data" id="dpForm">
			<input type="file" name="dpImg" class="dpImgUpload" style="display:none;" onchange="changeDp(this);" /> 
		</form>
	</div>
	<?php echo $logedInUser['name']; ?> 
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php if($imgError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $imgError; ?></p><?php } ?>
			<?php if($imgError1) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $imgError1; ?></p><?php } ?>
			<ul class="nav nav-tabs" role="tablist">
				<?php if($_GET['tab']=="myBookings"){ ?>
				<li role="presentation" class="active"><a href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/1/"><?php echo $language['myBookings']; ?></a></li> 
				<?php } else { ?>
				<li role="presentation"><a href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/1/"><?php echo $language['myBookings']; ?></a></li> 
				<?php } ?>
				<?php if($_GET['tab']=="settings"){ ?>
				<li role="presentation" class="active"><a href="<?php echo $obj->rootpath($conn); ?>/profile/settings/updating/"><?php echo $language['settings']; ?></a></li>
				<?php } else { ?>
				<li role="presentation"><a href="<?php echo $obj->rootpath($conn); ?>/profile/settings/updating/"><?php echo $language['settings']; ?></a></li>
				<?php } ?>
				<li role="presentation"><a href="<?php echo $obj->rootpath($conn); ?>/index.php?logOutUser=yes"><?php echo $language['logout']; ?></a></li>
			</ul>
			<div class="tab-content">
				<?php if($_GET['tab']=="myBookings"){ ?>
				<div role="tabpanel" class="tab-pane row active">
					<div class="col-md-8 col-xs-12">
						<a href="<?php echo $obj->rootpath($conn); ?>/makeABooking" class=" btn btn-success"><?php echo $language['makeABooking']; ?></a>
						<button class="btn btn-danger btn-ds deleteSelected" id="deleteSelectedBookings" title="Delete"><?php echo $language['deleteSelected']; ?></button>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="pull-right">
							<div class="input-group">
								<input type="text" class="form-control search-field" value="<?php echo $_GET['srch']; ?>" placeholder="<?php echo $language['findABooking']; ?>">
							<span class="input-group-btn">
							<button type="submit" class="btn btn-success btn-search"><i class="fa fa-search"></i></button>
							</span>
							</div>
						</div>
					</div>
					<?php if($rows>0) { ?>
						<div class="col-xs-12">
							<div class="table-responsive">
								<table class="table table-hover table-striped table-bordered">
								<thead><th><input type="checkBox" id="checkAll" /> <?php echo $language['name']; ?></th><th><?php echo $language['email']; ?></th><th><?php echo $language['from']; ?> - <?php echo $language['to']; ?></th><th><?php echo $language['paymentStatus']; ?></th><th class="text-center"><?php echo $language['action']; ?></th></thead>
									<?php 
									$start = ($page-1)*$limit;
									echo $obj->myBookings($conn, $_GET['srch'], $start, $limit, $uid, $language); 
									?>
								</table>
							</div>	
							<ul class="pagination">
							<?php if($prev==1) { ?>
								<li><span><i class="fa fa-chevron-left"></i></span></li>
								<?php } else { ?>
								<li><a href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/<?php echo $prev; ?>/<?php echo $_GET['srch']; ?>"><i class="fa fa-chevron-left"></i></a></li>
								<?php } if ($page>1 && $last>4) {
								$i=((int)$page/4)*4-1;
								if (!($i+4>$last)) {
								$temp_last = $i+4;
								} else {
								$i = $last - 4;
								$temp_last = $last;
								}
								} else {
								$i=1;
								if (!($i+4>$last)) {
								$temp_last = 4;
								} else {
								$temp_last = $last;
								}
								}
								for ($i; $i<=$temp_last; $i++) {
								if ($i==$page) {
								echo '<li class="active accent"><a href="'.$obj->rootpath($conn).'/profile/myBookings/'.$i.'/'.$_GET['srch'].'">'.$i.'</a></li>';
								} else {
								echo'<li><a href="'.$obj->rootpath($conn).'/profile/myBookings/'.$i.'/'.$_GET['srch'].'">'.$i.'</a></li>';
								}
								} 
								if($page==$last) { ?>
								<li><span><i class="fa fa-chevron-right"></i></span></li>
								<?php } else { ?>
								<li><a href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/<?php echo $next; ?>/<?php echo $_GET['srch']; ?>"><i class="fa fa-chevron-right"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					<?php } else { ?>
						<div class="col-xs-12">
							<div class="notFound">
							<i class="fa fa-folder-o"></i> <?php echo $language['nothingToShowHere']; ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php } else if($_GET['tab']=="settings"){ ?>
				<div role="tabpanel" class="tab-pane row active">
					<form method="POST" class="col-md-8 col-xs-12">
						<?php if($successMsg) { ?> <p class="text-success"><i class="fa fa-check"></i> <?php echo $successMsg; ?></p><?php } ?>
						<div class="form-group">
							<label><?php echo $language['name']; ?></label>
							<input type="text" class="form-control" name="name" value="<?php echo $logedInUser['name']; ?>"  placeholder="<?php echo $language['namePlaceholder']; ?>" />
							<?php if($nameError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $nameError; ?></p><?php } ?>
						</div>
						<div class="form-group">
							<label><?php echo $language['email']; ?></label>
							<input type="email" class="form-control" name="email" value="<?php echo $logedInUser['email']; ?>"  placeholder="<?php echo $language['emailPlaceholder']; ?>" />
							<?php if($emailError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $emailError; ?></p><?php } ?>
						</div>
						<div class="form-group">
							<label><?php echo $language['password']; ?></label>
							<input type="password" class="form-control" name="password" value="<?php echo $logedInUser['password']; ?>"  placeholder="<?php echo $language['passwordPlaceholder']; ?>" />
							<?php if($passwordError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $passwordError; ?></p><?php } ?>
						</div>						
						<div class="form-group">
							<label><?php echo $language['mobile']; ?></label>
							<input type="text" class="form-control" name="mobile" value="<?php echo $logedInUser['mobile']; ?>"  placeholder="<?php echo $language['mobilePlaceholder']; ?>" />
							<?php if($mobileError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $mobileError; ?></p><?php } ?>
						</div>
						<div class="form-group">
							<label><?php echo $language['address']; ?></label>
							<input type="text" class="form-control" name="address" value="<?php echo $logedInUser['address']; ?>"  placeholder="<?php echo $language['addressPlaceholder']; ?>" />
							<?php if($addressError) { ?> <p class="text-danger"><i class="fa fa-times"></i> <?php echo $addressError; ?></p><?php } ?>
						</div>
						<div><hr></div>
						<div class="form-group">
							<button type="submit" name="updateUser" class="btn btn-success"><?php echo $language['update']; ?></button>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
		</div>

<?php 
	include 'include/footer.php'; 
?>