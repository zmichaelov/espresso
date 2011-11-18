<!DOCTYPE html>
<html>
	<head>
		<title>Espresso Web App</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				//generateTable();
			});
			function int2bin(number, padding) {
				var temp = number.toString(2);
				while(temp.length < padding) {
					temp = "0" + temp;							
				}
				return temp;
			}
			function generateTable() {
				$("#char_table").empty();
				// get number of input variables
				var inputs = $("#inputs").val();
				// calculate number of min terms
				var minterms = Math.pow(2, inputs);
				var options = "<select><option>0</option><option>1</option><option>D</option></select>";
				for(var i = 0; i < minterms; i++) {
					$("#char_table").append("<tr id="+i+"><td>"+i+"</td>");
 					var binary = int2bin(i, inputs);
 					$("#"+i).append('<td>'+binary+'</td>');
 					//$("#"+i).append('<td><input type="text"/></td>');
 					$("#"+i).append('<td>'+options+'</td>');
					$("#char_table").append("</tr>");
				}

			}
		</script>
	</head>
	<body>
		<form action="utils/espresso.php" id="espresso" method="post">
			<p>Number of input variables:</p><input type="text" name="inputs" id="inputs" value=""/>
			<p>Minterms (separated by spaces):</p><input type="text" name="minterms" id="minterms" value=""/>
			<p>Don't Cares (leave blank if none):</p><input type="text" name="dontcares" id="dontcares" value=""/>
			<input type="submit" value="Submit" />
		</form>			
		<div id="main">
			<table id="char_table"></table>
		</div>
	</body>
</html>
<!-- 
<?php
	$inputs = 4;
	$minterms = pow(2, $inputs);
	
	echo '<table>';
	for($i = 0; $i < $minterms; $i++)
	{
		echo '<tr>';
		echo '<th>'."$i";
		for($j = 0; $j < $inputs; $j++)
		{
			echo '<th><input type="checkbox" name='."input_$j".' value='."$j".'/></th>';
		}
		echo '</tr>';
	}
	echo '</table>';
?>
 -->

