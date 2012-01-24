// called when the AJAX request has been successfully completed
var updateOutput = function (data) {
    var json = JSON.parse(data),
        src = '<pre class="prettyprint lang-tex">' + json.latex + '</pre>';
    
    $("#output").empty().append(json.standard);
    $("#latex_rendered").empty().append(json.math);
    // add the latex source code
    $("#latex_rendered").append(src);
    MathJax.Hub.Typeset(); // refresh MathJax
};

// submits POST request to espresso web service
var submitForm = function () {
    /* attach a submit handler to the form */
    $("#inputForm").submit(function (event) {
        /* stop form from submitting normally */
        event.preventDefault();     
        /* get form input values: */
        var $form = $(this),
            inputs = $form.find('input[id="variables"]').val(),
            minterms = $form.find('input[id="minterms"]').val(),
            dontcares = $form.find('input[id="dontcares"]').val(),        
            url = $form.attr('action');
        /* Send the data using POST and put the results in a div */
        $.post("utils/espresso.php", { inputs: inputs, minterms: minterms, dontcares: dontcares },
            updateOutput // function to call upon successful completion of the request
        );
    });
};

// checks if num is a single integer
var isInt = function (num) {
    var intRegex = /^\d+$/;
    return intRegex.test(num);
};

/* handler function for client-side validation */
var validationHandler = function (event) {
    
    // get variables from each form element
    var variables = $('input#variables').val(),
        minterms = $('input#minterms').val().replace(/\,/g,'').split(' '),
        dontcares = $('input#dontcares').val().replace(/\,/g,'').split(' '),
        temp = "",
        i = 0,
        duplicates = [],
        invalids = [],
        outofranges = [],
        invalids_dc = [],
        outofranges_dc = [],
        allValid = true;

    
    // clear all in-line help text
    $(".help-inline#variables").empty();
    $(".help-inline#minterms").empty();
    $(".help-inline#dontcares").empty();
    $("#alert-bar").empty();
    
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
            if (disabled === undefined) {
                $('input#submit').attr('disabled', 'disabled');
            }
            return;
        }
    }
    /* minterms validation */
    for (i = 0, max = minterms.length; i < max; i++) {
        
        temp = minterms[i];
        // check if temp is empty
        if(temp === ""){
            break;
        }
        
        // check if minterm is a valid integer
        if (!isInt(temp)) {
            $(".clearfix#minterms").addClass("error");
            $(".clearfix#minterms").removeClass("success");
            if($.inArray(temp,invalids) < 0) {
                invalids.push(temp);            
            }
//          $(".help-inline#minterms").append('Minterms must be valid integers.\n');
            allValid = false;
        }
        
        // check if the minterm is outside the range given by the number of variables
        else if(temp >= Math.pow(2, variables)) {
            $(".clearfix#minterms").addClass("error");
            $(".clearfix#minterms").removeClass("success");
            if($.inArray(temp,outofranges) < 0) {
                outofranges.push(temp);         
            }
            //$(".help-inline#minterms").append(temp+' is out of range.\n');
            allValid = false;
        }
        // check if minterm is already used in the dontcares
        else if($.inArray(temp, dontcares) > -1) {
            $(".clearfix#minterms").addClass("error");
            $(".clearfix#minterms").removeClass("success");
            if($.inArray(temp,duplicates) < 0) {
                duplicates.push(temp);          
            }
            allValid = false;
        } 
    } // end minterms validation
    
    /* dontcares validation */
    for (i = 0, max = dontcares.length; i < max; i++) {
        
        temp = dontcares[i];
        // check if temp is empty
        if(temp === "") {
            break;
        }
        
        // check if dontcare is a valid integer
        if (!isInt(temp)) {
            $(".clearfix#dontcares").addClass("error");
            $(".clearfix#dontcares").removeClass("success");
            if($.inArray(temp,invalids_dc) < 0) {
                invalids_dc.push(temp);            
            }
            allValid = false;           
        }
        
        // check if the dontcare is outside the range given by the number of variables
        else if(temp >= Math.pow(2, variables)) {
            $(".clearfix#dontcares").addClass("error");
            $(".clearfix#dontcares").removeClass("success");
            if($.inArray(temp,outofranges_dc) < 0) {
                outofranges_dc.push(temp);         
            }
            allValid = false;
        }
        // check if minterm is already used in the dontcares
        else if($.inArray(temp, minterms) > -1) {
            $(".clearfix#dontcares").addClass("error");
            $(".clearfix#dontcares").removeClass("success");
            //$(".help-inline#dontcares").append(temp+' is already specified in minterms.\n');
            if($.inArray(temp,duplicates) < 0) {
                duplicates.push(temp);          
            }
            allValid = false;       
        }
    } // end dontcares validation
    
    /* Error message generation */
    /* Minterms Error Messages */
    // check for duplicate entries in minterms and don't cares
    if(duplicates.length > 0) {
        if($('#alert-bar').is(':empty')) {
            $("#alert-bar").append(getDuplicatesErrorMessage(duplicates));
        }
        else {
            $("#alert-bar").alert();
        }
    }
    else {
        $("#alert-bar").empty();
    }
    //check for terms that are not valid integers
    if(invalids.length > 0) {
        $(".help-inline#minterms").append(getInvalidsErrorMessage(invalids));    
    }
    else {
        $(".help-inline#minterms").removeClass("invalids");
    }

    //check for terms that are out of range given the number of inputs
    if(outofranges.length > 0) {
        $(".help-inline#minterms").append(getRangeErrorMessage(outofranges));    
    }
    else {
        $(".help-inline#minterms").removeClass("range");
    }
    
    /* Don't Cares Error Messages */
    
    //check for terms that are not valid integers
    if(invalids_dc.length > 0) {
        $(".help-inline#dontcares").append(getInvalidsErrorMessage(invalids_dc));    
    }
    else {
        $(".help-inline#dontcares").removeClass("invalids");
    }

    //check for terms that are out of range given the number of inputs
    if(outofranges_dc.length > 0) {
        $(".help-inline#dontcares").append(getRangeErrorMessage(outofranges_dc));    
    }
    else {
        $(".help-inline#dontcares").removeClass("range");
    }
    /* Check if everything is ok to submit */
    
    if (allValid) {
        // should not be able to submit until at least one mintern has been specified
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
            $(".clearfix#dontcares").removeClass("error");
        } else {
            $(".clearfix#dontcares").removeClass("error");
            $(".clearfix#dontcares").addClass("success");
        }
    } else {
        disableSubmit();
    }
};
// generates error message for invalid entries
var getInvalidsErrorMessage = function (args) {
    // sort the input array in ascending order numerically
    args.sort(function (a, b) {
        return a - b;
    });
    var message = "";
    if(args.length == 1){
        message = '<p class="invalids">'+ args.join(', ') + ' is not a valid integer</p>';
    }
    else {
        message = '<p class="invalids">'+ args.join(', ') + ' are not valid integers</p>';
    }
    return message;
};
var getRangeErrorMessage = function (args) {
    // sort the input array in ascending order numerically
    args.sort(function (a, b) {
        return a - b;
    });
    var message = "";
    if(args.length == 1){
        message = '<p class="range">'+ args.join(', ') + ' is out of range</p>';
    }
    else {
        message = '<p class="range">'+ args.join(', ') + ' are out of range</p>';
    }
    return message;
};
// generates error message for duplicate entries
var getDuplicatesErrorMessage = function (args) {
    // sort the input array in ascending order numerically
    args.sort(function (a, b) {
        return a - b;
    });
    var div = "";
    if(args.length == 1){
        div = '<div id="alert" class="alert-message error fade in span8" data-alert="alert" >'+
            '<a class="close" href="#">&times;</a>'+
            '<p>'+ args.join(', ') + ' is specified as both a minterm and a don\'t care</p></div>';
    }
    else {
        div = '<div id="alert" class="alert-message error fade in span8" data-alert="alert" >'+
            '<a class="close" href="#">&times;</a>'+
            '<p>'+ args.join(', ') + ' are specified as both minterms and don\'t cares</p></div>';
    }
    return div;
};

/* Convenience functions for enabling and disabling the submit button */
var enableSubmit = function () {
    $('input#submit').removeAttr('disabled');
};
var disableSubmit = function () {
    var disabled = $('input#submit').attr('disabled');
    if (disabled === undefined) {
        $('input#submit').attr('disabled', 'disabled');
    }
};
/*
    Main entry point
    Wait until DOM has finished loading
*/
$(document).ready(function (){
    // load submit handler
    submitForm();
    
    // add validation listeners
    $('input#variables').bind('change focus',validationHandler);
    $('input#minterms').bind('change focus',validationHandler);
    $('input#dontcares').bind('change focus',validationHandler);
    $('#reset').click(function (){
        $('.clearfix').removeClass('error success');
        $("#alert-bar").empty();
    });
});