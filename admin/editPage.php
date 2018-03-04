<?php 
	include 'include/header.php';
	if(isset($_POST['editPage'])){
		$page=$obj->getPageDetails($conn,$_GET['pid']); 
		 $title=$_POST['title'];
		 if($title=="")
			 $titleError="Please enter page title !";
		 $contents=$_POST['contents'];
		 if($contents=="")
			 $contentsError="Please enter page contents !";
		 $status=$_POST['status'];
		 if(!$titleError && !$contentsError){
			$obj->updatePage($conn, $title, $contents, $status, $_GET['pid']);
			$successMsg="Page updated successfully.";
		 }
	}
	$page=$obj->getPageDetails($conn,$_GET['pid']); 
?>

<?php 
	include 'include/menu.php'; 
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<small><a href="managePages.php"><i class="fa fa-files-o"></i> Manage Pages</a> /</small> <i class="fa fa-edit"></i> Edit
	</div>
	<div class="panel-body">
		<form class="col-md-8 col-xs-12" method="POST">
			<?php if($successMsg) echo'<p class="text-success"><i class="fa fa-check-circle animated flash"></i> '.$successMsg.'</p>'; ?>
			<div class="form-group">
				<label>Title</label>
				<input type="text" class="form-control" name="title" placeholder="Enter page title" value="<?php echo $page['title']; ?>" />
				<?php if($titleError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$titleError.'</p>'; ?>
			</div>
			<div class="form-group">
				<label>Contents</label>
				<textarea id="editor" class="form-control" name="contents" placeholder="Enter page contents"><?php echo $page['contents']; ?> </textarea>
				<?php if($contentsError) echo'<p class="text-danger"><i class="fa fa-times-circle animated flash"></i> '.$contentsError.'</p>'; ?>
			</div>
			<div class="form-group">
				<?php if($page['status']==1){ ?>
				<label><input type="radio" name="status" value="0" /> Pending</label>
	            <label><input type="radio" name="status" value="1" checked /> Publish</label>
				<?php } else { ?>
				<label><input type="radio" name="status" value="0" checked /> Pending</label>
	            <label><input type="radio" name="status" value="1" /> Publish</label>
				<?php } ?>
			</div>	
			<hr>
			<div class="form-group">
				<button type="submit" name="editPage" class="btn btn-success">Update</button>
			</div>
		</form>
	</div>
</div>

<?php
	include 'include/footer.php';
?>