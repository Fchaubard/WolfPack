<p>Start Time:</p>
<form action="">
<select name="startTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
</form>