<?php 
	include 'include/header.php';
	if(isset($_POST['addPage'])){
		 $title=$_POST['title'];
		 if($title=="")
			 $titleError="Please enter page title !";
		 $contents=$_POST['contents'];
		 if($contents=="")
			 $contentsError="Please enter page contents !";
		 $status=$_POST['status'];
		 if(!$titleError && !$contentsError){
			$obj->addPage($conn, $title, $contents, $status);
			$successMsg="New page saved successfully.";
		 }
	}
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="managePages.php"><i class="fa fa-files-o"></i> Manage Pages</a> /</small> <i class="fa fa-plus"></i> Add New
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Title</label>
				<input type="text" class="form-control" name="title" placeholder="Enter page title" value="<?php echo $_POST['title']; ?>" />
				<?php if($titleError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$titleError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Contents</label>
				<textarea id="editor" class="form-control" name="contents" placeholder="Enter page contents"><?php echo $_POST['contents']; ?> </textarea>
				<?php if($contentsError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$contentsError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label><input type="radio" name="status" value="0" checked /> Pending</label>
	            <label><input type="radio" name="status" value="1" /> Publish</label>
			</div>	
			<hr>
			<div class="form-group">
				<button type="submit" name="addPage" class="btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>