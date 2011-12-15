<?php

// Helper functions
	// converts integer $number to binary and
	// adds leading zeros until the total binary length is $numbits
	function int2bin($number, $numbits){
		$temp = decbin($number);
		$temp = str_repeat('0', $numbits - strlen($temp)) . $temp;
		return $temp;
	}
	// parses espresso output and returns Latex code to be formatted by MathJax
	function getTex($output) {
		$lines = explode("\n", $output);
		// get the number of terms in the output
		$terms = substr(strstr($lines[2], ' '), 1);
		$math = '\(f=';
		for ($i = 3; $i < $terms + 3; $i++)
		{
			$term = strstr($lines[$i], ' ', true);
			for($j = 0; $j < strlen($term); $j++){
				$char = $term{$j};
				$num = $j+1;
				switch($char) {
					case '0':
						$math .= "\bar{x}_{$num}";
						break;
					case '1':
						$math .= "{x}_{$num}";
						break;
					case '-':
						break;
				}
			}
			if($i < $terms + 2) {
				$math .= '+';
			}
		}
		$math .= '\)';
		return $math;
	}
	
	/*
		begin input processing
	*/
	$inputs = $_POST['inputs'];
	//convert minterms to array of numbers
	$minterms = explode(' ', $_POST['minterms']);
	$dontcares = explode(' ',$_POST['dontcares']);
	// if don't cares are blank, create a default array
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
		// check if i is a minterm
		if(in_array($i, $minterms)){
			$query_string .= "1\n";
		}
		// check if i a dontcare
		elseif(in_array($i, $dontcares)){
			$query_string .= "-\n";
		}
		// if neither it must be a 0
		else {
			$query_string .= "0\n";
		}
	}
	// add end of file character
	$query_string .= '.e';
	// echo input (for debugging purposes)
	//echo "<pre>$query_string</pre>";
	
	// create temporary file for input
	$tempfname = tempnam('../tmp', 'esp');
	$temp = fopen($tempfname, 'w');
	fwrite($temp, $query_string);
	$output = shell_exec("../bin/espresso $tempfname");
	// close temporary file
	fclose($temp);
	
	// Latex output
	$tex = getTex($output);
	// Standard espresso text output
	$standard = "<pre>$output</pre>";
	// add output to an array
	$response = array('standard' => $standard, 'latex' => $tex);
	// encode output in json format
	echo json_encode($response);
?>