<?php 
	include 'include/resize/resize/ThumbLib.inc.php';
	include 'include/resize/resize.php';
	include 'include/class.phpmailer.php';
	
	class functions{
		
		function connection($server, $dbName, $dbUser, $dbPassword){
			if(!isset($_SESSION))
				session_start();
			@ob_start();
			$dsn = "mysql:dbname=$dbName;host=$server";
			error_reporting(E_ERROR);
			try {
				$conn = new PDO($dsn, $dbUser, $dbPassword);
				return $conn;
			} catch (PDOException $e) {
				return false;
				
			}
		}
		
		function hits($conn) {
			$date=date('Y-m-d');
			$query = $conn->prepare("SELECT * FROM statistics WHERE date='$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				$query = $conn->prepare("UPDATE statistics SET hits=hits+1 WHERE date='$date'");
				$query->execute();
			} else {
				$query = $conn->prepare("INSERT INTO statistics(hits, date) VALUES(1,'$date')");
				$query->execute();
			}
		}
		
		function views($conn) {
			$date=date('Y-m-d');
			$query = $conn->prepare("SELECT * FROM statistics WHERE date='$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				$query = $conn->prepare("UPDATE statistics SET views=views+1 WHERE date='$date'");
				$query->execute();
			} else {
				$query = $conn->prepare("INSERT INTO statistics(views, date) VALUES(1,'$date')");
				$query->execute();
			}
		}
		
		function dailyHits($conn){
			$date=date('Y-m-d');
			$query=$conn->prepare("SELECT SUM(hits) as hits FROM statistics WHERE date='$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['hits'];
			} else {
				return 0;
			}
		}
		
		function dailyViews($conn){
			$date=date('Y-m-d');
			$query=$conn->prepare("SELECT SUM(views) as views FROM statistics WHERE date='$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['views'];
			} else {
				return 0;
			}
		}
		
		function dailyUser($conn){
			$date=date('Y-m-d');
			$query=$conn->prepare("SELECT COUNT(id) as users FROM users WHERE joinDate='$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['users'];
			} else {
				return 0;
			}
		}
		
		function weeklyHits($conn){
			$date=date('Y-m-d');
			$week=date('Y-m-d',(time()-(60*60*24*7)));
			$query=$conn->prepare("SELECT SUM(hits) as hits FROM statistics WHERE date BETWEEN '$week' AND '$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['hits'];
			} else {
				return 0;
			}
		}
		
		function weeklyViews($conn){
			$date=date('Y-m-d');
			$week=date('Y-m-d',(time()-(60*60*24*7)));
			$query=$conn->prepare("SELECT SUM(views) as views FROM statistics WHERE date BETWEEN '$week' AND '$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['views'];
			} else {
				return 0;
			}
		}
		
		function weeklyUsers($conn){
			$date=date('Y-m-d');
			$week=date('Y-m-d',(time()-(60*60*24*7)));
			$query=$conn->prepare("SELECT COUNT(id) as users FROM users WHERE joinDate BETWEEN '$week' AND '$date'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['users'];
			} else {
				return 0;
			}
		}
		
		function allTimeHits($conn){
			$query=$conn->prepare("SELECT SUM(hits) as hits FROM statistics");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['hits'];
			} else {
				return 0;
			}
		}
		
		function allTimeViews($conn){
			$query=$conn->prepare("SELECT SUM(views) as views FROM statistics");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['views'];
			} else {
				return 0;
			}
		}
		
		function allTimeUsers($conn){
			$query=$conn->prepare("SELECT COUNT(id) as users FROM users");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['users'];
			} else {
				return 0;
			}
		}
		
		function rootpath($conn) {
			$query = $conn->prepare("SELECT rootpath FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['rootpath'];
		}
		
		function title($conn) {
			$query = $conn->prepare("SELECT title FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['title'];
		}
		
		function description($conn) {
			$query = $conn->prepare("SELECT description FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['description'];
		}
		
		function keywords($conn) {
			$query = $conn->prepare("SELECT keyword FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['keyword'];
		}
		
		function logo($conn) {
			$query = $conn->prepare("SELECT logo FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['logo'];
		}

		function favicon($conn) {
			$query = $conn->prepare("SELECT favicon FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['favicon'];
		}
		
		function adminEmail($conn) {
			$query = $conn->prepare("SELECT email FROM admin WHERE type='super-Admin'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['email'];
		}
		
		function manageGenralSettings($conn){
			$query = $conn->prepare("SELECT * FROM generalsetting");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if(!empty($row))
				return $row;
		}
		
		function updateGeneralSetting($conn,$title,$description,$keyword,$rootpath,$logo,$favicon){
			$query = $conn->prepare("UPDATE generalsetting SET title='$title', description='$description', keyword='$keyword', rootpath='$rootpath', logo='$logo', favicon='$favicon'");
			$query->execute();
		}
		
		function addSubAdmin($conn, $userName, $email, $password, $status, $type){
			$query = $conn->prepare("INSERT INTO admin (userName, email, password, status, type) VALUES (:userName, :email, :password, :status, :type)");
			$query->execute(array(':userName'=>$userName, ':email'=>$email, ':password'=>$password, ':status'=>$status, ':type'=>$type));
		} 
		
		function subAdminUsernameExist($conn, $userName){
			$query = $conn->prepare("SELECT * FROM admin WHERE userName = :userName");
			$query->bindValue(':userName', $userName);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function subAdminEmailExist($conn, $email){
			$query = $conn->prepare("SELECT * FROM admin WHERE email = :email");
			$query->bindValue(':userName', $email);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function thisSubAdminUsernameExist($conn, $userName, $thisUserName) {
			$query = $conn->prepare("SELECT email FROM admin WHERE userName !='$thisUserName' AND userName='$userName'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function thisSubAdminEmailExist($conn, $email, $thisEmail) {
			$query = $conn->prepare("SELECT email FROM admin WHERE email !='$thisEmail' AND email='$email'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function subAdminResetIdExist($conn, $email) {
			$query = $conn->prepare("SELECT email FROM admin WHERE userName='$email' OR email='$email'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return $row['email'];
		}
		
		function manageSubAdmin($conn, $srch, $start, $limit){
			if($srch=="")
				$sql = "SELECT * FROM admin WHERE type!='super-Admin' LIMIT $start, $limit";
			else 
				$sql = "SELECT * FROM admin WHERE type!='super-Admin' AND userName LIKE '%$srch%' LIMIT $start, $limit";
			foreach ($conn->query($sql) as $row) {
			echo '
			<tr>
			<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['userName'].'</td>
			<td>'.$row['email'].'</td>
			<td class="text-center animated flipInX">
			<a href="editSubAdmin.php?id='.$row['id'].'" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
			<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
			</td>
			</tr>
			<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
			</div>
			<div class="modal-body">
			Are you sure you want to delete this item.
			</div>
			<div class="modal-footer">
			<a href="manageSubAdmin.php?deleteSubAdmin='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
			<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
			</div>
			</div>
			</div>
			</div>
			';
			}
		}

		function getSubAdminDetails($conn, $id){
			$query = $conn->prepare("SELECT * FROM admin WHERE id=$id");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if(!empty($row))
				return $row;
		}
		
		function updateSubAdmin($conn, $id, $userName, $email, $password, $status) {
			$query = $conn->prepare("UPDATE admin SET userName='$userName', email='$email', password='$password', status=$status WHERE id=$id");
			$query->execute();
		}

		function deleteSubAdmin($conn, $id){
			$query = $conn->prepare("DELETE FROM admin WHERE id=$id");
			$query->execute();
		}

		function getAdminType($conn, $id){
			$query = $conn->prepare("SELECT type FROM admin WHERE userName='$id' OR email='$id'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
				if (!empty($row))
					return $row['type'];
		}

		
		function validEmail($email){
			return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
		}
		
		function manageAdminLoginSettings($conn, $id) {
			$query = $conn->prepare("SELECT * FROM admin WHERE userName='$id' OR email='$id'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return $row;
		}
		
		function AdminLoginCheck($conn, $id, $password) {
			$query = $conn->prepare("SELECT * FROM admin WHERE (userName='$id' OR email='$id') AND password='$password' AND status=1");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function adminLogout() {
			unset($_SESSION['sessionID']);
			header('Location: login.php');
		}
		
		function resetPasswordAdmin($conn, $mail, $email, $path, $themeColors) {
			$password=uniqid();
			$mail->Subject = "New Password";
			$message = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			New Password
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>Your New Password is : '.$password.' Please login here: '.$path.'/admin/login</p>
			</div>
			</div>
			';
			$mail->Body = $message;
			$mail->AddAddress($email);
			$mail->Send();
			$password=md5($password);
			$query = $conn->prepare("UPDATE admin SET password='$password' WHERE email='$email'");
			$query->execute();
		}
		
		function getThemeColors($conn) {
			$query = $conn->prepare("SELECT * FROM theme");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function saveMsg($conn, $subject, $email, $message){
			$query = $conn->prepare("INSERT INTO inbox (subject, email, message, enterDate) VALUES (:subject, :email, :message, :enterDate)");
			$query->execute(array(':subject'=>$subject, ':email'=>$email, ':message'=>$message, ':enterDate'=>date("Y-m-d")));
		}
		
		function manageInbox($conn, $srch, $start, $limit){
			if($srch=="")
				$sql = "SELECT * FROM inbox LIMIT $start, $limit";
			else 
				$sql = "SELECT * FROM inbox WHERE subject LIKE '%$srch%' LIMIT $start, $limit";
			foreach ($conn->query($sql) as $row) {
			echo '
			<tr>
			<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> <a href="viewMail.php?id='.$row['id'].'">'.$row['subject'].'</a></td>
			<td>'.$row['email'].'</td>
			<td class="text-center animated flipInX">
			<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
			</td>
			</tr>
			<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
			</div>
			<div class="modal-body">
			Are you sure you want to delete this item.
			</div>
			<div class="modal-footer">
			<a href="manageInbox.php?deleteEmail='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
			<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
			</div>
			</div>
			</div>
			</div>
			';
			}
		}
		
		function getSubMailDetails($conn, $id){
			$query = $conn->prepare("SELECT * FROM inbox WHERE id=$id");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if(!empty($row))
				return $row;
		}
		
		function deleteEmail($conn, $id){
			$query = $conn->prepare("DELETE FROM inbox WHERE id=$id");
			$query->execute();
		}
		
		function emailNotifications($conn){
				$sql = "SELECT * FROM inbox ORDER BY id DESC LIMIT 6";
			foreach ($conn->query($sql) as $row) {
				echo '
				<li>
				<a href="viewMail.php?id='.$row['id'].'">
				<div>
				<strong>';
				if(strlen($row['subject'])>25)
					echo substr($row['subject'],0,25)."...";
				else 
					echo $row['subject'];
				echo 
				'</strong>
				<span class="pull-rightz text-muted">
				<em class="pull-right">'.date("d, M Y", strtotime($row['enterDate'])).'</em>
				</span>
				</div>
				<div><small>';
				if(strlen($row['message'])>100)
					echo substr($row['message'],0,100)."...";
				else 
					echo $row['message'];
				echo '
				</small>
				</div>
				</a>
				</li>
				<li class="divider"></li>
				';
			}
		}
		
		function updateTheme($conn, $dark, $defaultColor, $success, $danger, $warning, $info, $successText, $dangerText, $warningText, $infoText) {
			$query = $conn->prepare("UPDATE theme SET dark='$dark', defaultColor='$defaultColor', success='$success', danger='$danger', warning='$warning', info='$info', successText='$successText', dangerText='$dangerText', warningText='$warningText', infoText='$infoText'");
		$query->execute();
		}
		
		function manegeSocial($conn){
			$query = $conn->prepare("SELECT * FROM social");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if(!empty($row))
				return $row;
		}
		
		function updateSocial($conn, $facebook, $twitter, $google, $linkedIn) {
			$query = $conn->prepare("UPDATE social SET facebook='$facebook', twitter='$twitter', googlePlus='$google', linkedIn='$linkedIn'");
			$query->execute();
		}
		
		function addPage($conn, $title, $contents, $status) {
			$query = $conn->prepare("INSERT INTO pages (title, contents, status) VALUES (:title, :contents, :status)");
			$query->execute(array(':title'=>$title, ':contents'=>$contents, ':status'=>$status));
		}
		
		function managePages($conn, $srch, $start, $limit) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM pages WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM pages ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM pages WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM pages ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['title'].'</td>
					<td class="text-center animated flipInX">
					<a href="editPage.php?pid='.$row['id'].'" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="managePages.php?deletePage='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					</td>
					</tr>
					';
					$hash++;
				}
			}
		}
		
		function updatePage($conn, $title, $contents, $status, $id) {
			$query = $conn->prepare("UPDATE pages SET title='$title', contents='$contents', status=$status WHERE id=$id");
			$query->execute();
		}
		
		function deletePage($conn, $id) {
			$query = $conn->prepare("DELETE FROM pages WHERE id='$id'");
			$query->execute();
		}
		
		function getPageDetails($conn, $id) {
			$query = $conn->prepare("SELECT * FROM pages WHERE id = :id");
			$query->bindValue(':id', $id);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function getPages($conn) {
			$sql = "SELECT * FROM pages WHERE status=1";
			foreach ($conn->query($sql) as $row) {
				echo 
				' <a class="link-text" href="'.$this->rootpath($conn).'/page/'.$row['id'].'">'.$row['title'].'</a>';
			}
		}
		
		function addUser($conn, $name, $email, $password, $mobile, $address, $dp, $status){
			$query = $conn->prepare("INSERT INTO users (name, email, password, mobile, address, dp, status, joinDate) VALUES (:name, :email, :password, :mobile, :address, :dp, :status, :joinDate)");
			$query->execute(array(':name'=>$name, ':email'=>$email, ':password'=>$password, ':mobile'=>$mobile, ':address'=>$address, ':dp'=>$dp, ':status'=>$status, ':joinDate'=>date("Y-m-d")));
		}
		
		function emailExist($conn, $email) {
			$query = $conn->prepare("SELECT email FROM users WHERE email = :email");
			$query->bindValue(':email', $email);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function thisemailExist($conn, $email, $thisEmail) {
			$query = $conn->prepare("SELECT email FROM users WHERE email = :email AND email!=:thisEmail");
			$query->bindValue(':email', $email);
			$query->bindValue(':thisEmail', $thisEmail);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function manageUsers($conn, $srch, $start, $limit){
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM users WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM users ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM users WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM users ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['name'].'</td>
					<td>'.$row['email'].'</td>
					<td class="text-center">
					<a href="editUser.php?uid='.$row['id'].'" class="animated flipInX btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a href="" class="animated flipInX btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageUsers.php?deleteUser='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					</td>
					</tr>
					';
					$hash++;
				}
			}
		}
		
		function getPublicPortfolio($conn, $eid) {
			$query = $conn->prepare("SELECT * FROM users WHERE id = :id");
			$query->bindValue(':id', $eid);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return $row;
		}
		
		function getLogedInuserDetails($conn, $email) {
			$query = $conn->prepare("SELECT * FROM users WHERE email = :email");
			$query->bindValue(':email', $email);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return $row;
		}
		
		function loginUser($conn, $email, $password) {
			$query = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password AND status=1");
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function logoutUser($conn) {
			unset($_SESSION['sessionEmail']);
			header('Location: '.$this->rootpath($conn).'/');
		}
		
		function updateUser($conn, $name, $email, $password, $mobile, $address, $id) {
			$query = $conn->prepare("UPDATE users SET name='$name', email='$email', password='$password', mobile='$mobile', address='$address' WHERE id=$id");
			$query->execute();
		}
		
		function updateUserAdmin($conn, $name, $email, $password, $mobile,  $address, $dp, $id) {
			$query = $conn->prepare("UPDATE users SET name='$name', email='$email', password='$password', mobile='$mobile', address='$address', dp='$dp' WHERE id=$id");
			$query->execute();
		}
			
		function deleteUser($conn, $id){
			$query = $conn->prepare("DELETE FROM users WHERE id='$id'");
			$query->execute();
		}
		
		function resetPassword($conn, $mail, $email, $path, $themeColors) {
			$password=uniqid();
			$mail->Subject = "New Password";
			$message = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			New Password
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>Your New Password is : '.$password.' Please login here: '.$path.'/login</p>
			</div>
			</div>
			';
			$mail->Body = $message;
			$mail->AddAddress($email);
			$mail->Send();
			$password=md5($password);
			$query = $conn->prepare("UPDATE users SET password='$password' WHERE email='$email'");
			$query->execute();
		}
		
		function updateDps($conn, $dp, $uid){
			$query = $conn->prepare("UPDATE users SET dp='$dp' WHERE id=$uid");
			$query->execute();
		}
		
		function addLocation($conn, $name) {
			$query = $conn->prepare("INSERT INTO locations (name) VALUES (:name)");
			$query->execute(array(':name'=>$name));
		}
		
		function manageLocations($conn, $srch, $start, $limit) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM locations WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM locations ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM locations WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM locations ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['name'].'</td>
					<td class="text-center animated flipInX">
					<a href="editLocation.php?lid='.$row['id'].'" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					</td>
					</tr>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageLocations.php?deleteLocation='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					';
					$hash++;
				}
			}
		}
		
		function updateLocation($conn, $name, $id) {
			$query = $conn->prepare("UPDATE locations SET name='$name' WHERE id=$id");
			$query->execute();
		}
		
		function deleteLocation($conn, $id) {
			$query = $conn->prepare("DELETE FROM locations WHERE id='$id'");
			$query->execute();
		}
		
		function getLocationDetails($conn, $id) {
			$query = $conn->prepare("SELECT * FROM locations WHERE id = :id");
			$query->bindValue(':id', $id);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function locationList($conn){
			$sql = "SELECT * FROM locations";
			foreach ($conn->query($sql) as $row) {
				$locations.= '"'.$row['name'].'",';
			}
			return substr($locations,0,-1);
		}
		
		function addFleet($conn, $name, $details, $img) {
			$query = $conn->prepare("INSERT INTO fleets (name, details, img) VALUES (:name, :details, :img)");
			$query->execute(array(':name'=>$name, ':details'=>$details, ':img'=>$img));
		}
		
		function fleetNameExist($conn, $name){
			$query = $conn->prepare("SELECT * FROM fleets WHERE name = :name");
			$query->bindValue(':name', $name);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function thisfleetNameExist($conn, $name, $thisName) {
			$query = $conn->prepare("SELECT * FROM fleets WHERE name !='$thisName' AND name='$name'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
				return true;
		}
		
		function manageFleets($conn, $srch, $start, $limit) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM fleets WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM fleets ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM fleets WHERE name LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM fleets ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> <img src="../uploads/fleets/'.$row['img'].'" width="20" /> '.$row['name'].'</td>
					<td class="text-center animated flipInX">
					<a href="editFleet.php?fid='.$row['id'].'" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					</td>
					</tr>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageFleets.php?deleteFleet='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					';
					$hash++;
				}
			}
		}
		
		function fleets($conn) {
			$sql = "SELECT * FROM fleets";
			foreach ($conn->query($sql) as $row) {
				echo '
				<div class="col-md-3 col-sm-4 col-xs-12">
					<a href="'.$this->rootpath($conn).'/viewFleet/'.$row['id'].'">
					<div class="thumbnail fleets">
						<img src="'.$this->rootpath($conn).'/uploads/fleets/'.$row['img'].'" />
						<div class="caption">
							<h4 class="caption-title">
							';
							if(strlen($row['name'])>20)
								echo substr($row['name'], 0, 20)."...";
							else 
								echo $row['name'];
							echo '
							</h4>
							</a>
							<p>
							';
							if(strlen($row['details'])>200)
								echo substr($row['details'], 0, 200)."...";
							else 
								echo $row['name'];
							echo '
							</p>
						</div>
					</div>
				</div>
				';
			}
		}
		
		function updateFleet($conn, $name, $details, $img, $id) {
			$query = $conn->prepare("UPDATE fleets SET name='$name', details='$details', img='$img' WHERE id=$id");
			$query->execute();
		}
		
		function deleteFleet($conn, $id) {
			$query = $conn->prepare("DELETE FROM fleets WHERE id='$id'");
			$query->execute();
		}
		
		function getFleetDetails($conn, $id) {
			$query = $conn->prepare("SELECT * FROM fleets WHERE id = :id");
			$query->bindValue(':id', $id);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function getFleetDetailsByName($conn, $name) {
			$query = $conn->prepare("SELECT * FROM fleets WHERE name = :name");
			$query->bindValue(':name', $name);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function fleetsList($conn){
			$sql = "SELECT * FROM fleets";
			foreach ($conn->query($sql) as $row) {
				echo '<li><a id="'.$row['name'].'"><img src="'.$this->rootpath($conn).'/uploads/fleets/'.$row['img'].'" width="50" /> '.$row['name'].'</a></li>';
			}
		}
		
		function addFare($conn, $pickfrom, $dropto, $fleet, $fare) {
			$query = $conn->prepare("INSERT INTO fares (pickfrom, dropto, fleet, fare) VALUES (:pickfrom, :dropto, :fleet, :fare)");
			$query->execute(array(':pickfrom'=>$pickfrom, ':dropto'=>$dropto, ':fleet'=>$fleet, ':fare'=>$fare));
		}
		
		function manageFares($conn, $srch, $start, $limit) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM fares WHERE pickfrom LIKE '%$srch%' OR dropto LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM fares ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM fares WHERE pickfrom LIKE '%$srch%' OR dropto LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM fares ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['pickfrom'].'</td>
					<td>'.$row['dropto'].'</td>
					<td>'.$row['fleet'].'</td>
					<td>'.$row['fare'].'</td>
					<td class="text-center animated flipInX">
					<a href="editFare.php?fid='.$row['id'].'" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-edit"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					</td>
					</tr>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageFares.php?deleteFares='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					';
					$hash++;
				}
			}
		}
		
		function updateFare($conn, $pickfrom, $dropto, $fleet, $fare, $id) {
			$query = $conn->prepare("UPDATE fares SET pickfrom='$pickfrom', dropto='$dropto', fleet='$fleet', fare='$fare' WHERE id=$id");
			$query->execute();
		}
		
		function deleteFares($conn, $id) {
			$query = $conn->prepare("DELETE FROM fares WHERE id='$id'");
			$query->execute();
		}
		
		function getFareDetails($conn, $id) {
			$query = $conn->prepare("SELECT * FROM fares WHERE id = :id");
			$query->bindValue(':id', $id);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function getFare($conn, $pickfrom, $dropto, $fleet) {
			$query = $conn->prepare("SELECT fare FROM fares WHERE (pickfrom='$pickfrom' OR pickfrom='$dropto') AND (dropto='$dropto' OR pickfrom='$dropto') AND fleet='$fleet'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row['fare'];
		}
		
		function addBooking($conn, $uid, $pickdate, $picktime, $pickfrom, $dropto, $fleet, $fare, $name, $email, $mobile, $address, $payment) {
			$query = $conn->prepare("INSERT INTO bookings (uid, pickdate, picktime, pickfrom, dropto, fleet, fare, name, email, mobile, address, payment, status) VALUES (:uid, :pickdate, :picktime, :pickfrom, :dropto, :fleet, :fare, :name, :email, :mobile, :address, :payment, :status)");
			$query->execute(array(':uid'=>$uid, ':pickdate'=>$pickdate, ':picktime'=>$picktime, ':pickfrom'=>$pickfrom, ':dropto'=>$dropto, ':fleet'=>$fleet, ':fare'=>$fare, ':name'=>$name, ':email'=>$email, ':mobile'=>$mobile, ':address'=>$address, ':payment'=>$payment, ':status'=>0));
			return $conn->lastInsertId();
		}
		
		function manageBookings($conn, $srch, $start, $limit) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM bookings WHERE name LIKE '%$srch%' OR email LIKE '%$srch%' OR mobile LIKE '%$srch%' OR address LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM bookings ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM bookings WHERE name LIKE '%$srch%' OR email LIKE '%$srch%' OR mobile LIKE '%$srch%' OR address LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM bookings ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['name'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['pickfrom'].' - '.$row['dropto'].'</td>
					<td>
					';
					if($row['payment']!="0")
						echo 'OK';
					else 
						echo 'Pay Cash to Driver';
					echo '
					</td>
					<td class="text-center animated flipInX">
					<a href="viewBooking.php?bid='.$row['id'].'" class="btn btn-xs btn-info" title="View"><i class="fa fa-eye"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					</td>
					</tr>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageBookings.php?deleteBooking='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					';
					$hash++;
				}
			}
		}
		
		function notificationCount($conn){
			$date=date('Y-m-d');
			$query=$conn->prepare("SELECT COUNT(id) as noti FROM bookings WHERE status=0");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				return $row['noti'];
			} else {
				return 0;
			}
		}
		
		function bookingsNotification($conn) {
			$sql = "SELECT * FROM bookings WHERE status=0 ORDER BY id DESC";
			foreach ($conn->query($sql) as $row) {
				echo '
				<li><a class="thisNoti" id="'.$row['id'].'" href="viewBooking.php?bid='.$row['id'].'"><div>New Booking Request For <b>'.$row['fleet'].'</b></div></a></li>
				<li class="divider"></li>
				';	
			}
		}
		
		function notiChecked($conn, $id) {
			$query = $conn->prepare("UPDATE bookings SET status=:status WHERE id=:id");
			$query->execute(array(':status'=>1, ':id'=>$id));
			return 1;
		}
		
		function myBookings($conn, $srch, $start, $limit, $uid, $language) {
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM bookings WHERE uid='$uid' AND name LIKE '%$srch%' OR email LIKE '%$srch%' OR mobile LIKE '%$srch%' OR address LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM bookings WHERE uid='$uid' ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM bookings WHERE uid='$uid' AND name LIKE '%$srch%' OR email LIKE '%$srch%' OR mobile LIKE '%$srch%' OR address LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM bookings WHERE uid='$uid' ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['name'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['pickfrom'].' - '.$row['dropto'].'</td>
					<td>
					';
					if($row['payment']!="0")
						echo 'OK';
					else 
						echo 'Pay Cash to Driver';
					echo '
					</td>
					<td class="text-center animated flipInX">
					<a href="'.$this->rootpath($conn).'/viewBooking/'.$row['id'].'" class="btn btn-xs btn-info" title="View"><i class="fa fa-eye"></i></a>
					<a href="" class="btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					</td>
					</tr>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">'.$language['conformationMsg'].'</h4>
					</div>
					<div class="modal-body">
					'.$language['conformationMsgP'].'
					</div>
					<div class="modal-footer">
					<a href="'.$this->rootpath($conn).'/profile.php?deleteBooking='.$row['id'].'" type="button" class="btn btn-xs btn-danger">'.$language['delete'].'</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">'.$language['cancel'].'</button>
					</div>
					</div>
					</div>
					</div>
					';
					$hash++;
				}
			}
		}
		
		function updateBookingContact($conn, $name, $email, $mobile, $address, $id) {
			$sql="UPDATE bookings SET name=:name, email=:email, mobile=:mobile, address=:address WHERE id=:id";
			$query=$conn->prepare($sql);
			$query->execute(array(':name'=>$name, ':email'=>$email, ':mobile'=>$mobile, ':address'=>$address, ':id'=>$id));
		}
		
		function getBookingDetails($conn, $id) {
			$query = $conn->prepare("SELECT * FROM bookings WHERE id='$id'");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function updatePaymentStatus($conn, $bid){
			$query = $conn->prepare("UPDATE bookings SET payment=:payment WHERE id=:bid");
			$query->execute(array(':payment'=>"1", ':bid'=>$bid));
		}
		
		function sendBookingDetails($conn, $email, $mail, $message, $themeColors) {
			$mail->AddAddress($this->adminEmail($conn));
			$mail->Subject = "New Booking Details";
			$mail->Body = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			New Booking Details
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>'.$message.'</p>
			</div>
			</div>
			';
			$mail->Send();
			
			$mail->AddAddress($email);
			$mail->Subject = "New Booking Details";
			$mail->Body = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			New Booking Details
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>'.$message.'</p>
			</div>
			</div>
			';
			$mail->Send();
		} 
		
		function deleteBooking($conn, $id){
			$query = $conn->prepare("DELETE FROM bookings WHERE id=$id");
			$query->execute();
		}
		
		function deleteUserBookings($conn, $id){
			$query = $conn->prepare("DELETE FROM bookings WHERE uid=$id");
			$query->execute();
		}
		
		
		function addJob($conn, $title, $status, $details, $location, $salary){
			$query = $conn->prepare("INSERT INTO jobs (title, status, details, location, salary) VALUES (:title, :status, :details, :location, :salary)");
			$query->execute(array(':title'=>$title, ':status'=>$status, ':details'=>$details, ':location'=>$location, ':salary'=>$salary));
			return $jid = $conn->lastInsertId();
		}
		
		function manageJobs($conn, $srch, $start, $limit){
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM jobs WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM jobs ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM jobs WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM jobs ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td><input type="checkBox" name="checkBoxes" class="checkBoxes" value="'.$row['id'].'" /> '.$row['title'].'</td>
					<td>'.$row['location'].'</td>
					<td>'.$row['salary'].'</td>
					<td class="text-center">
					<a href="editJob.php?jid='.$row['id'].'" class="animated flipInX btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a href="" class="animated flipInX btn btn-xs btn-danger" title="Delete" data-toggle="modal" data-target="#uidModel'.$row['id'].'"><i class="fa fa-trash"></i></a>
					<div class="modal fade" id="uidModel'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Conformation Message</h4>
					</div>
					<div class="modal-body">
					Are you sure you want to delete this item.
					</div>
					<div class="modal-footer">
					<a href="manageJobs.php?deleteJob='.$row['id'].'" type="button" class="btn btn-xs btn-danger">delete</a>
					<button type="button" class="btn btn-xs btn-default" data-dismiss="modal">cancel</button>
					</div>
					</div>
					</div>
					</div>
					</td>
					</tr>
					';
					$hash++;
				}
			}
		}
		
		function jobs($conn, $srch, $start, $limit, $language){
			if($srch!="")
				$sql = $conn->prepare("SELECT * FROM jobs WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit");
			else
				$sql = $conn->prepare("SELECT * FROM jobs ORDER BY id DESC limit $start, $limit");
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				if($srch!="")
					$sql = "SELECT * FROM jobs WHERE title LIKE '%$srch%' ORDER BY id DESC limit $start, $limit";
				else
					$sql = "SELECT * FROM jobs ORDER BY id DESC limit $start, $limit";
				foreach ($conn->query($sql) as $row) {
					echo '
					<tr>
					<td>'.$row['title'].'</td>
					<td>'.$row['location'].'</td>
					<td>$'.$row['salary'].'</td>
					<td class="text-center"><a href="'.$this->rootpath($conn).'/viewJob/'.$row[id].'" class="btn btn-info">'.$language['view'].'</a> <a href="'.$this->rootpath($conn).'/apply/'.$row[id].'" class="btn btn-success">'.$language['apply'].'</a></td>
					</tr>
					';
					$hash++;
				}
			}
		}
		
		function getJobDetails($conn,$jid) {
			$query = $conn->prepare("SELECT * FROM jobs WHERE id = :id");
			$query->bindValue(':id', $jid);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function updateJob($conn, $title, $status, $details, $location, $salary, $jid) {
			$query = $conn->prepare("UPDATE jobs SET title='$title', status='$status', details='$details', location='$location', salary=$salary WHERE id=$jid");
			$query->execute();
		}
		
		function deleteJob($conn, $id){
			$query = $conn->prepare("DELETE FROM jobs WHERE id=$id");
			$query->execute();
		}
	
		function ApplyForJob($conn, $mail, $to, $email, $message, $themeColors) {
			$mail->Subject = "Job Application";
			$message = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			Job Application
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>'.$message.'</p>
			</div>
			</div>
			';
			$mail->Body = $message;
			$mail->AddAddress($to);
			$mail->Send();
			
			$message= '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			Job Application
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p><b>Thank you !</b> For applying we will get in touch with you as soon as possible if you fit best for this position.</p>
			</div>
			</div>
			';
			$mail->Body = $message;
			$mail->AddAddress($email);
			$mail->Send();
		}
		
		function upatePaypal($conn, $email) {
			$query = $conn->prepare("UPDATE paypalsettings SET email='$email'");
			$query->execute();
		}
		
		function getPaypal($conn) {
			$query = $conn->prepare("SELECT * FROM paypalsettings");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (!empty($row))
			return $row;
		}
		
		function contact($conn, $to, $subject, $mail, $message, $title, $themeColors) {
			$mail->AddAddress($to);
			$mail->Subject = $subject;
			$mail->Body = '
			<div style="background-color:'.$themeColors['defaultColor'].'; padding:80px;">
			<h1>'.$this->title($conn).'</h1>
			<hr style="border-bottom:1px solid rgba(0,0,0,.1); box-shadow:0 1px 0 rgba(255,255,255,.4); border-top:none; margin-bottom:30px;">
			<div style="background-color:'.$themeColors['dark'].'; border-radius:4px 4px 0 0; padding:12px; font-size:16px; font-weight:600; color:#FFF;">
			'.$subject.'
			</div>
			<div style="background-color:#fff; border:1px solid #eee; border-top: none; padding:20px; border-radius:0 0 4px 4px; color:#666;">
			<p>'.$message.'</p>
			</div>
			</div>
			';
			$mail->Send();
		}
		
		function resizeDp($src) {
			$options = array('jpegQuality' => 100);
			$thumb = PhpThumbFactory::create("uploads/images/dps/" . $src,$options);
			$thumb->adaptiveResize(340, 340);
			$thumb->save( "uploads/images/dps/" . $src);
			return true;
		}
		
		function resizeDpAdmin($src) {
			$options = array('jpegQuality' => 100);
			$thumb = PhpThumbFactory::create("../uploads/images/dps/" . $src,$options);
			$thumb->adaptiveResize(340, 340);
			$thumb->save( "../uploads/images/dps/" . $src);
			return true;
		}
		
		function resizeFleetImg($src) {
			$options = array('jpegQuality' => 100);
			$thumb = PhpThumbFactory::create("../uploads/fleets/" . $src,$options);
			$thumb->adaptiveResize(600, 600);
			$thumb->save( "../uploads/fleets/" . $src);
			return true;
		}
	}
	
	$obj=new functions();
	include 'include/connection.php';
	if(!$conn)
		header("Location: install/");
	
	$mail = new PHPMailer();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->Username = "zamsawin@gmail.com";
	$mail->Password = "zamsawin121";
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->From = $obj->adminEmail($conn);
	$mail->FromName = $obj->title($conn);
	
	$themeColors=$obj->getThemeColors($conn);
	
	if(isset($_GET['logOut'])&& $_GET['logOut']=="yes"){
		$obj->adminLogout();
	}
	if(isset($_GET['logOutUser'])&& $_GET['logOutUser']=="yes"){
		$obj->logoutUser($conn);
	}
?>