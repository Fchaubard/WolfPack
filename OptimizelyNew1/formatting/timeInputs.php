<div id="divCheckbox" style="display: none;">
<select id="startTime" style="visibility:hidden;" name="startTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
</div>
<p> How long do you have to eat? </p>
<select id="stopTime"  name="stopTime">
<?php
if(file_exists("./formatting/times_minutes.php")){
	
	include "./formatting/times_minutes.php";
}

?>
</select>

<script>
	
	var currentTime = new Date ();
	var currentHours = currentTime.getHours ( ) * 100;
	console.log(currentHours);
	$("#startTime").val(currentHours);    
	
	
	
</script>