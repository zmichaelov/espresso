$(document).ready(function(){
// adds AJAX submission to the form
/* attach a submit handler to the form */
  $("#inputForm").submit(function(event) {
     /* stop form from submitting normally */
     event.preventDefault(); 
         
     /* get some values from elements on the page: */
     var $form = $( this ),
         inputs = $form.find( 'input[name="inputs"]' ).val(),
         minterms = $form.find( 'input[name="minterms"]' ).val(),
         dontcares = $form.find( 'input[name="dontcares"]' ).val(),        
         url = $form.attr( 'action' );
 
     /* Send the data using post and put the results in a div */
     $.post( "utils/espresso.php", { inputs: inputs, minterms: minterms, dontcares: dontcares },
       function( data ) {
           $("#output").empty().append(data);
       }
     );
  });
  
});

function int2bin(number, bitwidth) {
	var temp = number.toString(2);
	while(temp.length < bitwidth) {
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