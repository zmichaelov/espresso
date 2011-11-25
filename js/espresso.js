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
     $.post( "utils/espresso2.php", { inputs: inputs, minterms: minterms, dontcares: dontcares },
       function( data ) {
           $("#output").empty().append(data);
       }
     );
  });
  
});