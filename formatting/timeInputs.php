
<p>Hungry From:</p>
<select id="startTime" name="startTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
<div class="startTimeInfo" data-role="content" data-theme="a">test</div>
<p> Until: </p>
<select id="stopTime" name="stopTime">
<?php
if(file_exists("./formatting/times.php")){
	
	include "./formatting/times.php";
}

?>
</select>
<div class="stopTimeInfo"  data-role="content" data-theme="a">test</div>
<script>
	function updateTime()
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
			
			$("#stopTime").append(optString);
			$("#stopTime").selectmenu("refresh");
		}
		
	};
	
	var currentTime = new Date ();
	var currentHours = currentTime.getHours ( ) * 100;
	console.log(currentHours);
	$("#startTime").val(currentHours);
	$("#startTime").change(function(){updateTime();});
	$(document).bind('pageinit', function() {
		updateTime();
	});
	
	popupManager(".startTimeInfo", "Touch above to select when you will be ready to eat.");
	popupManager(".stopTimeInfo", "Touch above to select when you want to be done eating.");
</script>