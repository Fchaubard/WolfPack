
<p>Start Time:</p>
<form action="">
<select id="startTime" name="startTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
</form>

<p> Stop Time: </p>
<form action="">
<select id="stopTime" name="stopTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
</form>

<script>
	$("#startTime").change(function()
	{
		stopValue = parseInt($("#stopTime").val());
		startValue = parseInt($("#startTime").val());
		alert(startValue + " : " + stopValue);
		$("#stopTime").empty();
		
	}
	);
	
	
</script>