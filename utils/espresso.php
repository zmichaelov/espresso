<?php 
	function int2bin($number, $numbits){
		$temp = decbin($number);
		$temp = str_repeat('0', $numbits - strlen($temp)) . $temp;
		return $temp;
	}
	// parses output and outputs MathML encoding
	
	function getMathML($output) {
		$lines = explode("\n", $output);
		// get the number of terms in the output
		$terms = substr(strstr($lines[2], ' '), 1);
		$math = '<math><mi>f</mi><mo>=</mo>';		
		for ($i = 3; $i < $terms + 3; $i++)
		{
			$term = strstr($lines[$i], ' ', true);
			for($j = 0; $j < strlen($term); $j++){
				$char = $term{$j};
				$num = $j+1;
				switch($char) {
					case '0':
						$math .= "<msub><mover><mi>x</mi><mo>&macr;</mo></mover><mn>$num</mn></msub>";
						break;
					case '1':
						$math .= "<msub><mi>x</mi><mn>$num</mn></msub>";
						break;
					case '-':
						break;
				}
			}
			if($i < $terms + 2) {
				$math .= '<mo>+</mo>';
			}
		}
		$math .= '</math>';
		return $math;
// 		foreach($lines as $line){
// 			$pos = strpos($line,$needle);
// 			if($pos === false) {
// 			 // string needle NOT found in haystack
// 			}
// 			else {
// 			 // string needle found in haystack
// 			}
// 		}
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
	// echo input (for debugging purposes)
	//echo "<pre>$query_string</pre>";
	// create temporary file for input
	$tempfname = tempnam('../tmp', 'esp');
	$temp = fopen($tempfname, 'w');
	fwrite($temp, $query_string);
	$output = shell_exec("../bin/espresso $tempfname");
	// close temporary file
	fclose($temp);
	$math = getMathML($output);
	echo "<pre class=\"prettyprint\">$output</pre>";
	echo $math;
?>