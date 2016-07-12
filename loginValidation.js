/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project #2b  */
function isEmpty(fieldValue) {
	return $.trim(fieldValue).length == 0;
}

$(document).ready(function() {
	
	var elementHandle = new Array(3);
	var errorStatusHandle = new Array(3);
			// Handlers to access elements :-

			elementHandle[0] = $('[name="user"]');
			elementHandle[1] = $('[name="pass"]');
			elementHandle[2] = $('[name="report"]');
			
			// Error Status
			
			errorStatusHandle[0] = $('#usernameErrMsg');
			errorStatusHandle[1] = $('#passErrMsg');
			errorStatusHandle[2] = $('#reportErrMsg');
			
			function validateNonEmptyField(elementHandler,
					errorStatusHandle, msg) {
				if (isEmpty(elementHandler.val())) {
					setErrorStatus(elementHandler, errorStatusHandle,
							msg);
					return false;
				}
				return true;
			}

			function setErrorStatus(elementHandler, errorStatusHandle,
					msg) {
				errorStatusHandle.addClass("error");
				errorStatusHandle.text(msg);
				elementHandler.focus();
			}
			
			
			function isValidData() {
				var isValid = true;

				var selectedReport = $('input[name=report]:checked').val();
				if (isEmpty(selectedReport)) {
					setErrorStatus(elementHandle[2], errorStatusHandle[2],
							"Please select a report");
					isValid = false;
				}
				
				if (validateNonEmptyField(elementHandle[1],
						errorStatusHandle[1],
						"Please enter password") == false) {
					isValid = false;

				}
				if (validateNonEmptyField(elementHandle[0],
						errorStatusHandle[0],
						"Please enter username") == false) {
					isValid = false;
				}
				return isValid;
			}

			// focus on 1st field on page load
			elementHandle[0].focus();

			// on blur, if the user has entered valid data, the error
			// message should no longer show.
			function clearErrorStatus(elementHandler, errorStatusHandle) {
				if (isEmpty(elementHandler.val()))
					return;
				removeError(errorStatusHandle);
			}

			function removeError(errorStatusHandle) {
				errorStatusHandle.text("");
				errorStatusHandle.removeClass("error");
			}
			// clear status when username is entered
			elementHandle[0].on('blur', function() {
				clearErrorStatus(elementHandle[0], errorStatusHandle[0]);
			});

			// clear status when password is entered
			elementHandle[1].on('blur', function() {
				clearErrorStatus(elementHandle[1], errorStatusHandle[1]);
			});
			
			$('input[name=report]').click(function() {
				removeError(errorStatusHandle[2]);
			});
			

			// Actions to be performed on button submit and reset
			$('form').on('submit', function(e) {
				for (var i = 0; i <= 2; i++) {
					errorStatusHandle[i].text("");
					errorStatusHandle[i].removeClass("error");

				}
				
				
				if(isValidData()){
				 	
				  	 var params = $('form').serialize();
    					 e.preventDefault(); 
					 $.post('php/process_login.php', params, printReport);
				 
				 }else 
				 	return false;
				 
				 
			});
			
			function printReport(response){
			
				if($.trim(response) == "UNAUTHORIZED USER")  {
					 $('#status').html("Username and password does not match");
	    				 $('#status').css('color','red');
         					                       
           			}else if ($.trim(response) == "INVALID_USERNAME"){
           				 $('#status').html("Please enter the username");
	    				 $('#status').css('color','red');
	  			}else if ($.trim(response) == "INVALID_PASSWORD"){
           				 $('#status').html("Please enter the password");
	    				 $('#status').css('color','red');
	  			}else if ($.trim(response) == "INVALID_REPORT"){
           				 $('#status').html("Please select a report");
	    				 $('#status').css('color','red');
	  			}else{
         				 $('body').html(response);	   	
	  			}   
						
			}

			$('#reset').on('click', function() {
				
				for (var i = 0; i <= 2; i++) {
					errorStatusHandle[i].text("");
					errorStatusHandle[i].removeClass("error");

				}
			});

		});
