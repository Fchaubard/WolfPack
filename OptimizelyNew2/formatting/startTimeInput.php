<p>Start Time:</p>
<select name="startTimeWPCreate" id="startTimeWPCreate">
<?php session_start();
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
	include("config.php");
	$query = "SELECT startTime FROM users WHERE userName=\"".$_SESSION['userName']."\"";
	
	$result = mysql_query($query)or die(mysql_error());
	$row = mysql_fetch_array($result);
}

?>
</select>

<script>
	function updateTimeWPCreate()
	{
		
		var startValue = <?php echo $row['startTime']; ?>;
		var stopValue = 0;
		
		$("#startTimeWPCreate").empty();
		//alert(startValue +":"+stopValue);
		if (startValue < stopValue)
		{
			var stopTime = stopValue;
		}
		else
		{
			var stopTime = startValue + 100;
		}
		for(var i = startValue + 100; i <= 2400; i = i+100)
		{
			var label = i/100
			if (label == 24)
			{
				label = "12:00 AM";
			}
			else if (label > 12)
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
			
			$("#startTimeWPCreate").append(optString);
			$("#startTimeWPCreate").selectmenu("refresh");
		}
		
	};
	
	var currentTime = new Date ();
	var currentHours = currentTime.getHours ( ) * 100;
	console.log(currentHours);
	$(document).bind('pageinit', function() {
		updateTimeWPCreate();
	});	       
	
	
	
</script>