
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
		var stopValue = parseInt($("#stopTime").val());
		var startValue = parseInt($("#startTime").val());
		$("#stopTime").empty();
		//alert(startValue +":"+stopValue);
		if (startValue < stopValue)
		{
			var stopTime = stopValue;
		}
		else
		{
			var stopTime = startTime + 100;
		}
		for(var i = startValue + 100; i <= 2400; i = i+100)
		{
			var label = i/100
			if (label > 12)
			{
				label -= 12;
				label = label + ":00 PM";
			}
			else
			{
				label = label + ":00";
				if(label == "12:00")
				{
					label += " PM"
				}
				else
				{
					label += " AM"
				}
				
			}
			var optString = '<option value="'+i;
			if(i == stopTime)
			{
				optString += '" selected=true>'+label+'</option>';
			}
			else
			{
				optString += '">'+label+'</option>';
			}
			
			$("#stopTime").append(optString);
			$("#stopTime").selectmenu("refresh");
		}
		
	}
	);
	
	
</script>