<?php 
	function int2bin($number, $numbits){
		$temp = decbin($number);
		$temp = str_repeat('0', $numbits - strlen($temp)) . $temp;
		return $temp;
	}
	$inputs = $_POST['inputs'];
	//convert minterms to array of numbers
	$minterms = explode(' ', $_POST['minterms']);
	$dontcares = explode(' ',$_POST['dontcares']);
	if(sizeof($dontcares) == 1 and $dontcares[0] == ''){
		$dontcares = array();
	}
	// write the number of input and output variables
	$query_string = ".i $inputs\n.o 1\n";
	// iterate over minterms
	for($i = 0; $i < pow(2, $inputs); $i++) {
		// convert minterm to its binary representation
		$bin = str_split(int2bin($i, $inputs));
		// write each bit with a space in between 
		foreach($bin as $bit){
			$query_string .= $bit.' ';
		}
		// check if i is one of the minterms
		if(in_array($i, $minterms)){
			//fwrite($fw, "1\n");
			$query_string .= "1\n";
		}
		// check if i a dontcare
		elseif(in_array($i, $dontcares)){
			$query_string .= "-\n";
		}
		else {
			$query_string .= "0\n";
		}
	}
	// add end of file character
	$query_string .= '.e';
	echo "<pre>$query_string</pre>";
	$tempfname = tempnam('../tmp', 'esp');
	$temp = fopen($tempfname, 'w');
	fwrite($temp, $query_string);
	$output = shell_exec("../bin/espresso $tempfname");
	fclose($temp);
	echo "<pre>$output</pre>";
?>