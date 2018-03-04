<?php
	header("content-type: application/x-javascript");
	include '../functions.php';
?>

$(function(){
	var availableTags=[<?php echo $obj->locationList($conn); ?>];
	$( ".pickDrop" ).autocomplete({
		source: availableTags
	});
});

$(".fleetsList a").click(function(){
	$("#fleet").val(this.id);
	$(".fleetsList .btn").text(this.id);
});

$("#checkAll").click(function () {
	$(".checkBoxes").prop('checked', $(this).prop('checked'));
	$(".deleteSelected").show();
	$(".deleteSelected").addClass("animated flipInX");
});

$(".checkBoxes").click(function () {
	$(".deleteSelected").show();
	$(".deleteSelected").addClass("animated flipInX");
});

$("#deleteSelectedSubAdmin").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageSubAdmin.php?values="+values;
});

$("#deleteSelectedEmails").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageInbox.php?values="+values;
});

$("#deleteSelectedUsers").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageUsers.php?values="+values;
});

$("#deleteSelectedLocations").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageLocations.php?values="+values;
});

$("#deleteSelectedFleets").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageFleets.php?values="+values;
});

$("#deleteSelectedFares").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageFares.php?values="+values;
});

$("#deleteSelectedBookings").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageBookings.php?values="+values;
});

$("#deleteSelectedJobs").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="manageJobs.php?values="+values;
});

$("#deleteSelectedPages").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="managePages.php?values="+values;
});

setInterval(function(){  
	var oldNotiCount=$("#oldNotiCount").val();
	$.ajax({
		type : "POST",
		url : "<?php echo $obj->rootpath($conn); ?>/ajax.php",
		data : {"notiCountReload":"notiCountReload"},
		success : function(server_response){
			if(server_response){
				$(".notiCount").html(server_response);
				$("#oldNotiCount").val(server_response);
				if(server_response>oldNotiCount){
					$("#notiSound")[0].play();
				}
			}
		}
	});
},5000);

$(".thisNoti").click(function(e){
	e.preventDefault();
	var id=this.id;
	var href=$(this).attr('href');
	$.ajax({
		type : "POST",
		url : "<?php echo $obj->rootpath($conn); ?>/ajax.php",
		data : {"notiChecked":"notiChecked", "id":id},
		success : function(server_response){
			if(server_response){
				window.location.href=href;
			}
		}
	});
});

setInterval(function(){
	$.ajax({
		type : "POST",
		url : "<?php echo $obj->rootpath($conn); ?>/ajax.php",
		data : {"notiReload":"notiReload"},
		success : function(server_response){
			if(server_response){
				$(".notifications").html(server_response);
			}
		}
	});
},5000);


$("#logoBtn").click(function(){
	$("#logo").trigger("click");
});

$("#faviconBtn").click(function(){
	$("#favicon").trigger("click");
});

function showLogo(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
		$('#logoImg').attr('src', e.target.result).height(32).width(198);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

function showFavicon(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
		$('#faviconImg').attr('src', e.target.result).height(32).width(32);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$("#imageBtn").click(function(){
	$("#image, #editImage").trigger("click");
});

$("#dpBtn").click(function(){
	$("#editDp").trigger("click");
});

function showDp(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
		$('#dpImg').attr('src', e.target.result).height(150).width(150);
		};
		reader.readAsDataURL(input.files[0]);
	}
}

$(".btn-fleet").click(function(){
	$("#img-fleet").trigger("click");
});

$(".btn-chng").click(function(){
	$(".dpImgUpload").trigger('click');
});

$('.color').colorPicker();

CKEDITOR.replace('editor');