var updateOutput = function(data) {
   var json = JSON.parse(data);
   $("#output").empty().append(json.standard);
   $("#latex_rendered").empty().append(json.math);
   var src = '<pre class="prettyprint lang-tex">'+json.latex+'</pre>';
   // add the latex source code
   $("#latex_rendered").append(src);
   MathJax.Hub.Typeset(); // refresh MathJax
};

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
		updateOutput
	  );
  });
};

// generic function for validating espresso inputs
// isValid returns a boolean indication whether the inputElement is a valid input
var validateInput = function (input, isValid, successCallback, failureCallback) {
	if(isValid(input)){
		successCallback();
	}
	else{
		failureCallback();
	}
};

// checks if num is a valid integer
var isInt = function(num) {
	var intRegex = /^\d+$/;
	return intRegex.test(num) && num > 0;
};
// checks if minterms and dontcares are valid

// main entry point
// wait until DOM has finished loading
$(document).ready(function(){
 	// load submit handler
 	submitForm();
	// add listener for number of minterms
	$('input#variables').change( 
		function() {
			var variables = $('input#variables').val();
			
			$(".help-inline#variables").empty();
			
			validateInput(variables, 
			// validation function
			function(input){
				return isInt(input);
			},
			// success callback
			function(){
				$(".help-inline#variables").empty();
				$(".clearfix#variables").removeClass("error");
				$(".clearfix#variables").addClass("success");
			},
			// failure callback
			function() {
				$(".clearfix#variables").addClass("error");
				$(".clearfix#variables").removeClass("success");
				$(".help-inline#variables").append('Enter a single integer greater than 0');
			});
		}
	);
	
});