// called when the AJAX request has been successfully completed
var updateOutput = function(data) {
   var json = JSON.parse(data);
   $("#output").empty().append(json.standard);
   $("#latex_rendered").empty().append(json.math);
   var src = '<pre class="prettyprint lang-tex">'+json.latex+'</pre>';
   // add the latex source code
   $("#latex_rendered").append(src);
   MathJax.Hub.Typeset(); // refresh MathJax
};

// submits POST request to espresso web service
var submitForm = function() {
	/* attach a submit handler to the form */
	$("#inputForm").submit(function(event) {
     /* stop form from submitting normally */
     event.preventDefault(); 
         
     /* get form input values: */
     var $form = $( this ),
         inputs = $form.find( 'input[id="variables"]' ).val(),
         minterms = $form.find( 'input[id="minterms"]' ).val(),
         dontcares = $form.find( 'input[id="dontcares"]' ).val(),        
         url = $form.attr('action');
	 
	 /* Send the data using post and put the results in a div */
	 $.post( "utils/espresso.php", { inputs: inputs, minterms: minterms, dontcares: dontcares },
		updateOutput // function to call upon successful completion of the request
	  );
  });
};

// checks if num is a single integer
var isInt = function(num) {
	var intRegex = /^\d+$/;
	return intRegex.test(num);
};

// handler function for client-side validation
var validationHandler = function(event) {
	
	// get variables from each form element
	var variables = $('input#variables').val();
	var minterms = $('input#minterms').val().split(' ');
	var dontcares = $('input#dontcares').val().split(' ');
	
	// clear all in-line help text
	$(".help-inline#variables").empty();
	$(".help-inline#minterms").empty();
	$(".help-inline#dontcares").empty();
	
	/* variables validation */
	// check if the input is empty first
	if (variables) {
		// check if the number of variables is a single integer greater than 0
		if (isInt(variables) && variables > 0) {
			$(".help-inline#variables").empty();
			$(".clearfix#variables").removeClass("error");
			$(".clearfix#variables").addClass("success");	
		} else {
			$(".clearfix#variables").addClass("error");
			$(".clearfix#variables").removeClass("success");
			$(".help-inline#variables").append('Enter a single integer greater than 0');
			
			// disable the submit button again			
			var disabled = $('input#submit').attr('disabled');
			if (disabled == undefined) {
				$('input#submit').attr('disabled', 'disabled');
			}			
			return;
		}
	}
	/* minterms validation */
	var temp = "";
	var allValid = true;
	for (var i = 0, max = minterms.length; i < max; i++) {
		
		temp = minterms[i];
		// check if temp is empty
		if(temp === ""){
			break;
		}
		
		// check if minterm is a valid integer
		if (!isInt(temp)) {
			$(".clearfix#minterms").addClass("error");
			$(".clearfix#minterms").removeClass("success");
			$(".help-inline#minterms").append('All minterms must be valid integers.\n');
			allValid = false;			
		}
		
		// check if the minterm is outside the range given by the number of variables
		if(temp >= Math.pow(2, variables)) {
			$(".clearfix#minterms").addClass("error");
			$(".clearfix#minterms").removeClass("success");
			$(".help-inline#minterms").append('One of the terms is out of range of the variables.\n');
			allValid = false;
		}
		// check if minterm is already used in the dontcares
		if($.inArray(temp, dontcares) > -1) {
			$(".clearfix#minterms").addClass("error");
			$(".clearfix#minterms").removeClass("success");
			$(".help-inline#minterms").append('One of the minterms is already specified in dontcares.\n');
			allValid = false;		
		}
		// check for duplicates (if needed)	
	} // end minterms validation
	
	/* dontcares validation */
	for (var i = 0, max = dontcares.length; i < max; i++) {
		
		temp = dontcares[i];
		// check if temp is empty
		if(temp === "") {
			break;
		}
		
		// check if dontcare is a valid integer
		if (!isInt(temp)) {
			$(".clearfix#dontcares").addClass("error");
			$(".clearfix#dontcares").removeClass("success");
			$(".help-inline#dontcares").append('All dontcares must be valid integers.\n');
			allValid = false;			
		}
		
		// check if the dontcare is outside the range given by the number of variables
		if(temp >= Math.pow(2, variables)) {
			$(".clearfix#dontcares").addClass("error");
			$(".clearfix#dontcares").removeClass("success");
			$(".help-inline#dontcares").append('One of the terms is out of range of the variables.\n');
			allValid = false;
		}
		// check if minterm is already used in the dontcares
		if($.inArray(temp, minterms) > -1) {
			$(".clearfix#dontcares").addClass("error");
			$(".clearfix#dontcares").removeClass("success");
			$(".help-inline#dontcares").append('One of the dontcares is already specified in minterms.\n');
			allValid = false;		
		}
		// check for duplicates (if needed)	
	} // end dontcares validation
	
	if (allValid) {
		// if minterms is empty
		if(minterms[0] === "") { 
			disableSubmit();
			$(".clearfix#minterms").removeClass("success");
		} else {
			enableSubmit();
			$(".clearfix#minterms").removeClass("error");
			$(".clearfix#minterms").addClass("success");
		}
		if(dontcares[0] === "") {
			// do nothing for now
		} else {
			$(".clearfix#dontcares").removeClass("error");
			$(".clearfix#dontcares").addClass("success");
		}
	} else {
		disableSubmit();
	}
}
var enableSubmit = function() {
	$('input#submit').removeAttr('disabled');
}
var disableSubmit = function() {
	var disabled = $('input#submit').attr('disabled');
	if (disabled == undefined) {
		$('input#submit').attr('disabled', 'disabled');
	}
}
// main entry point
// wait until DOM has finished loading
$(document).ready(function(){
 	// load submit handler
 	submitForm();
 	
 	// add validation listeners
	$('input#variables').change(validationHandler);
	$('input#minterms').change(validationHandler);
	$('input#dontcares').change(validationHandler);
});