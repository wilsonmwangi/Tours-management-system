<?php 
	include 'include/header.php';
	if(isset($_POST['updateUser'])){
		$user = $obj->getPublicPortfolio($conn, $_GET['uid']);
		$name=$_POST['name'];
		if($name=="" || strlen($name)<3)
			$nameError="Please enter name !";
		$email=$_POST['email'];
		if($email=="" || !$obj->validEmail($email) || $obj->thisemailExist($conn, $email, $user['email']))
			$emailError="Invalid email or already exist !";
		$password=$_POST["password"];
		if($password=="" || strlen($password)<8)
			$passwordError="Please enter valid password !";
		if($password!=$user['password'])
			$password=md5($password);
		$mobile=$_POST['mobile'];
		if($mobile=="")
			$mobileError="Please enter mobile number !";
		$address=$_POST['address'];
		if($address=="")
			$addressError="Please enter address !";
		if(!$nameError && !$emailError && !$passwordError && !$mobileError && !$addressError){
			if(trim($_FILES["dpImg"]["name"]) != "") {
				$base = explode(".", strtolower(basename($_FILES["dpImg"]["name"])));
				$ext  = end($base);
				if($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
					if($user['dp']!="userDp.jpg" and $user['dp']!="companyDp.jpg")
						unlink("../uploads/images/dps/".$user['dp']);
					$image = getimagesize($_FILES["dpImg"]["tmp_name"]);
					$width = $image[0];
					$height = $image[1];
					if($width<340 || $height<340)
						$imgError = "Please select an image with minimum resolution of 340x340 !";
					if(!$imgError) {
						$dp = uniqid()."." . $ext;
						move_uploaded_file($_FILES["dpImg"]["tmp_name"], "../uploads/images/dps/" . $dp);
						$obj->resizeDpAdmin($dp);
					}
				} else {
					$imgError="Invalid image extension !";
				}
			} else {
				$dp=$user['dp'];
			} 
			if(!$imgError){
				$obj->updateUserAdmin($conn, $name, $email, $password, $mobile, $address, $dp, $_GET['uid']);
				$successMsg="User updated successfully.";
			}
		}
	}
	$user = $obj->getPublicPortfolio($conn, $_GET['uid']);
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="manageUsers.php"><i class="fa fa-users"></i> Manage Users</a> /</small> <i class="fa fa-edit"></i> Edit
	</div>
	<div class="panel-body">
	<form class="col-md-8 col-xs-12" method="POST" enctype="multipart/form-data">
		<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" placeholder="Enter name" />
			<?php if($nameError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$nameError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" placeholder="Enter email" />
			<?php if($emailError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$emailError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password" value="<?php echo $user['password']; ?>" placeholder="Enter password" />
			<?php if($passwordError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$passwordError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Mobile</label>
			<input type="text" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>" placeholder="Enter mobile number" />
			<?php if($mobileError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$mobileError.'</p>'; ?>
		</div>
		<div class="form-group">
			<label>Address</label>
			<input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>" placeholder="Enter address" />
			<?php if($addressError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$addressError.'</p>'; ?>
		</div>
		<img class="img-circle" src="../uploads/images/dps/<?php echo $user['dp'];?>" width="100" />
		<hr>
		<div class="form-group">
			<a class="btn btn-info btn-chng">Upload Image</a> 
			<input type="file" name="dpImg" class="dpImgUpload" style="display:none;" onchange="changeDp(this);" /> 
			<button type="submit" name="updateUser" class="btn btn-success">Update</button>
			<?php if($imgError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$imgError.'</p>'; ?>
		</div>
	</form>
	
<?php 
	include 'include/footer.php';
?>