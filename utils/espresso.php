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
	
	// create the input file
	$fw = fopen('/Users/zmichaelov/Sites/espresso/test/temp.txt','w');
	
	// write the number of input variables
	fwrite($fw, ".i $inputs\n");
	// write number of output variables default to 1 for now
	fwrite($fw, ".o 1\n");
	// iterate over minterms
	for($i = 0; $i < pow(2, $inputs); $i++) {
		// convert minterm to its binary representation
		$bin = str_split(int2bin($i, $inputs));
		// write each bit with a space in between 
		foreach($bin as $bit){
			fwrite($fw, $bit.' ');
		}
		// check if i is one of the minterms
		if(in_array($i, $minterms)){
			fwrite($fw, "1\n");
		}
		elseif(in_array($i, $dontcares)){
			fwrite($fw, "-\n");
		}
		else {
			fwrite($fw, "0\n");		
		}
	}
	// add end of file character
	fwrite($fw, '.e');
	fclose($fw);
	$output = shell_exec("../bin/espresso ../test/temp.txt");
	
	echo "<pre>$output</pre>";
	class Espresso {
		
	
	}

?>