var mathJax = function () {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src  = "https://d3eoax9i5htok0.cloudfront.net/mathjax/latest/MathJax.js?config=TeX-AMS_HTML";

  var config = 'MathJax.Hub.Config({' +
				 'extensions: ["tex2jax.js"],' +
				 'jax: ["input/TeX","output/HTML-CSS"]' +
			   '});' +
			   'MathJax.Hub.Startup.onload();';
  if (window.opera) {script.innerHTML = config}
			   else {script.text = config}

  document.getElementsByTagName("head")[0].appendChild(script);
};
var updateOutput = function(data) {
	       var json = JSON.parse(data);
           $("#output").empty().append(json.standard);
           $("#latex_rendered").empty().append(json.latex);
           //var src = '<pre class="prettyprint lang-tex">'+json.latex+'</pre>';
           //$("#latex_src").empty().append(src);
           mathJax();
           MathJax.Hub.Typeset();
};
var submitForm = function() {
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
     	updateOutput
     );
  });
};


$(document).ready(submitForm);
// $(document).ready(function(){
// 	  
// });