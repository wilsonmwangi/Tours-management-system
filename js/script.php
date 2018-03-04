<?php
	header("content-type: application/x-javascript");
	include '../functions.php';
	$logedInUser=$obj->getLogedInuserDetails($conn, $_SESSION['sessionEmail']);
?>

$('#pickupDate').datetimepicker({
	format: 'dd/MM/yyyy',
	language: 'en'
});

$('#pickupTime').datetimepicker({
	pickDate: false,
	pick12HourFormat: true
});

$(".fleetsList a").click(function(){
	$("#fleet").val(this.id);
	$(".fleetsList .btn .fleetText").text(this.id);
});

$(".checkFare").click(function(){
	var pickfrom=$("#start").val();
	if(pickfrom==""){
		$("#start").css("border-color", "red");
	}
	var dropto=$("#end").val();
	if(dropto==""){
		$("#end").css("border-color", "red");
	}
	var fleet=$("#fleet").val();
	if(fleet==""){
		$(".fleetsList .btn").css("border-color", "red");
	}
	if(pickfrom!="" && dropto!="" && fleet!=""){
		$.ajax({
			type : "POST",
			url : "<?php echo $obj->rootpath($conn); ?>/ajax.php",
			data : {"getFare":"getFare", "pickfrom":pickfrom, "dropto":dropto, "fleet":fleet},
			success : function(server_response){
				if(server_response){
					$("#fare").val("$"+server_response);
				}
			}
		});
	}
});

$(".bookNow").click(function(){
	var pickdate=$("#pickdate").val();
	if(pickdate==""){
		$("#pickdate").css("border-color", "red");
	}
	var picktime=$("#picktime").val();
	if(picktime==""){
		$("#picktime").css("border-color", "red");
	}
	var pickfrom=$("#start").val();
	if(pickfrom==""){
		$("#start").css("border-color", "red");
	}
	var dropto=$("#end").val();
	if(dropto==""){
		$("#end").css("border-color", "red");
	}
	var fleet=$("#fleet").val();
	if(fleet==""){
		$(".fleetsList .btn").css("border-color", "red");
	}
	if(pickdate!="" && picktime!="" && pickfrom!="" && dropto!="" && fleet!=""){
		$.ajax({
			type : "POST",
			url : "<?php echo $obj->rootpath($conn); ?>/ajax.php",
			data : {"saveBooking":"saveBooking", "pickdate":pickdate, "picktime":picktime, "pickfrom":pickfrom, "dropto":dropto, "fleet":fleet},
			success : function(server_response){
				if(server_response){
					window.location.href="<?php echo $obj->rootpath($conn); ?>/conformContact/"+server_response+"/";
				}
			}
		});
	}
});

$(".search-field").keypress(function(e){
    if (e.which == 13){
		var srch=$(".search-field").val();
        if(srch!=""){
			window.location.href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/1/"+srch;
		}
    }
});

$(".job-search-field").keypress(function(e){
    if (e.which == 13){
		var srch=$(".job-search-field").val();
        if(srch!=""){
			window.location.href="<?php echo $obj->rootpath($conn); ?>/career/1/"+srch;
		}
    }
});

$(".btn-search").click(function(){
    var srch=$(".search-field").val();
	if(srch!=""){
		window.location.href="<?php echo $obj->rootpath($conn); ?>/profile/myBookings/1/"+srch;
    }
});

$(".btn-search-job").click(function(){
    var srch=$(".job-search-field").val();
	if(srch!=""){
		window.location.href="<?php echo $obj->rootpath($conn); ?>/career/1/"+srch;
    }
});

$(function(){
	var availableTags=[<?php echo $obj->locationList($conn); ?>];
	$( ".pickDrop" ).autocomplete({
		source: availableTags
	});
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

$("#deleteSelectedBookings").click(function(){
	var values=[];
	$('input[name="checkBoxes"]:checked').each(function() {
	   values.push($(this).val());
	});
	window.location.href="<?php echo $obj->rootpath($conn);?>/profile.php?values="+values;
});

$(window).load(function(){
	 $(".loaderBG").hide();
	$(".site").fadeIn();
	$(".navbar").fadeIn("fast");
	$(".main h1, .main h4, .main .btn").show();
	$(".main h1").addClass("animated fadeInDown");
	$(".main h4").addClass("animated fadeInUp");
	$(".main .btn-default").addClass("animated fadeInLeft");
	$(".main .btn-success").addClass("animated fadeInRight");
});

$(".btn-chng").click(function(){
	$(".dpImgUpload").trigger('click');
});

function changeDp(input) {
	if (input.files && input.files[0]) {
	$("#dpForm").submit();
	reader.readAsDataURL(input.files[0]);
	}
}

$(".thumbnail").mouseenter(function(){
	$(".title", this).show();
	$(".title", this).addClass("animated flipInX");
});

$(".thumbnail").mouseleave(function(){
	$(".title", this).fadeOut();
});

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var sw19 = new google.maps.LatLng(0.116829, 37.607183);
  var mapOptions = {
    zoom:6,
    center: sw19
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
}

function calcRoute() {
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

function calcDistance(p1, p2){
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
} 
google.maps.event.addDomListener(window, 'load', initialize);

CKEDITOR.replace('editor');