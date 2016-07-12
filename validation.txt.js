/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project #2  */
function isEmpty(fieldValue) {
	return $.trim(fieldValue).length == 0;
}

function isValidStateAbbr(state) {
	var stateList = new Array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
			"DC2", "DE", "FL", "GA", "GU", "HI", "IA", "ID", "IL", "IN", "KS",
			"KY", "LA", "MA", "MD", "ME", "MH", "MI", "MN", "MO", "MS", "MT",
			"NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR",
			"PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA",
			"WI", "WV", "WY");
	for (var i = 0; i < stateList.length; i++)
		if (stateList[i] == $.trim(state.toUpperCase()))
			return true;
	return false;
}

function isValidEmail(emailAddress) {
	var pattern = new RegExp(
			/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
$(document)
		.ready(
				function() {

					var elementHandle = new Array(28);
					var errorStatusHandle = new Array(28);

					// Handlers to access elements :-

					// Parent basic Info handlers
					elementHandle[0] = $('[name="parentFirstName"]');
					elementHandle[1] = $('[name="parentLastName"]');
					elementHandle[2] = $('[name="pmArea"]');
					elementHandle[3] = $('[name="pmPrefix"]');
					elementHandle[4] = $('[name="pmPhone"]');
					elementHandle[5] = $('[name="phArea"]');
					elementHandle[6] = $('[name="phPrefix"]');
					elementHandle[7] = $('[name="phPhone"]');

					// Parent additional info handlers
					elementHandle[8] = $('input[name=relationship]:checked');

					elementHandle[9] = $('[name="addressLine1"]');
					elementHandle[10] = $('[name="city"]');
					elementHandle[11] = $('[name="state"]');
					elementHandle[12] = $('[name="postcode"]');
					elementHandle[13] = $('[name="email"]');

					// Child info handlers
					elementHandle[14] = $('[name="childFirstName"]');
					elementHandle[15] = $('[name="childLastName"]');
					elementHandle[16] = $('[name="photo"]');
					elementHandle[17] = $('[name="gender"]');
					elementHandle[18] = $('[name="dob"]');

					// Child additional info handlers
					elementHandle[19] = $('[name="scArea"]');
					elementHandle[20] = $('[name="scPrefix"]');
					elementHandle[21] = $('[name="scPhone"]');
					elementHandle[22] = $('[name="childNickName"]');
					elementHandle[23] = $('[name="secondaryContactName"]');

					// Error Status
					// Parent basic Info error status
					errorStatusHandle[0] = $('#parentFirstNameErrMsg');
					errorStatusHandle[1] = $('#parentLastNameErrMsg');
					errorStatusHandle[2] = $('#cellPhoneErr');
					errorStatusHandle[3] = $('#telPhoneErr');

					// Parent additional info error status
					errorStatusHandle[4] = $('#relationshipErrMsg');
					errorStatusHandle[5] = $('#addressErrMsg');
					errorStatusHandle[6] = $('#cityErrMsg');
					errorStatusHandle[7] = $('#stateErrMsg');
					errorStatusHandle[8] = $('#postCodeErrMsg');
					errorStatusHandle[9] = $('#emailErrMsg');

					// Child info error status
					errorStatusHandle[10] = $('#childFirstNameErrMsg');
					errorStatusHandle[11] = $('#childLastNameErrMsg');
					errorStatusHandle[12] = $('#imgFormatErrMsg');
					errorStatusHandle[13] = $('#genderErrMsg');
					errorStatusHandle[14] = $('#dateErrMsg');

					// Child additional info error status
					errorStatusHandle[15] = $('#scTelPhoneErrMsg');
					errorStatusHandle[16] = $('#nicknameErrMsg');
					errorStatusHandle[17] = $('#scNameErrMsg');

					function setErrorStatus(elementHandler, errorStatusHandle,
							msg) {
						errorStatusHandle.addClass("error");
						errorStatusHandle.text(msg);
						elementHandler.focus();
					}

					function validateNonEmptyField(elementHandler,
							errorStatusHandle, msg) {
						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									msg);
							return false;
						}
						return true;
					}

					function isValidName() {
						var isValid = true;
						if (validateNonEmptyField(elementHandle[23],
								errorStatusHandle[17],
								"Please enter the name") == false) {
							isValid = false;

						}
						if (validateNonEmptyField(elementHandle[22],
								errorStatusHandle[16],
								"Please enter the nickname") == false) {
							isValid = false;

						}

						if (validateNonEmptyField(elementHandle[15],
								errorStatusHandle[11],
								"Please enter the last name") == false) {
							isValid = false;

						}
						if (validateNonEmptyField(elementHandle[14],
								errorStatusHandle[10],
								"Please enter the first name") == false) {
							isValid = false;
						}
						if (validateNonEmptyField(elementHandle[1],
								errorStatusHandle[1],
								"Please enter the last name") == false) {
							isValid = false;
						}
						if (validateNonEmptyField(elementHandle[0],
								errorStatusHandle[0],
								"Please enter the first name") == false) {
							isValid = false;
						}
						return isValid;
					}

					function isValidAreaCode(elementHandler, errorStatusHandle) {

						if (isEmpty(elementHandler.val())) {

							setErrorStatus(elementHandler, errorStatusHandle,
									"Please enter the area code");
							return false;
						}
						if (!$.isNumeric(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The area code is invalid, numbers only");
							return false;
						}
						if (elementHandler.val().length != 3) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The area code must have three digits");
							return false;
						}
						return true;
					}

					function isValidPrefix(elementHandler, errorStatusHandle) {

						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"Please enter the phone number prefix");
							return false;
						}
						if (!$.isNumeric(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The prefix is invalid, numbers only");
							return false;
						}
						if (elementHandler.val().length != 3) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The prefix must have three digits");
							return false;
						}
						return true;
					}

					function isValidPhone(elementHandler, errorStatusHandle) {

						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"Please enter the phone number");
							return false;
						}
						if (!$.isNumeric(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The phone code is invalid, numbers only");
							return false;
						}
						if (elementHandler.val().length != 4) {
							setErrorStatus(elementHandler, errorStatusHandle,
									"The phone code must have four digits");
							return false;
						}
						return true;
					}

					function isvalidPhoneNumber() {
						var isValid = true;

						var isValidSContactNumber = false;
						if (isValidAreaCode(elementHandle[19],
									errorStatusHandle[15]) == true) {
								if (isValidPrefix(elementHandle[20],
										errorStatusHandle[15]) == true) {
									if (isValidPhone(elementHandle[21],
											errorStatusHandle[15]) == true) {
										isValidSContactNumber = true;
									}
								}
							}
						
						if (isValidSContactNumber == false) {
							isValid = false;
						}
						var isValidCellNumber = false;
						if (isValidAreaCode(elementHandle[2],
								errorStatusHandle[2]) == true) {

							if (isValidPrefix(elementHandle[3],
									errorStatusHandle[2]) == true) {
								if (isValidPhone(elementHandle[4],
										errorStatusHandle[2]) == true) {
									isValidCellNumber = true;
								}
							}
						}

						if (isValidCellNumber == false) {
							isValid = false;
						}
						var isValidTelNumber = false;
						if (isEmpty(elementHandle[5].val())
								&& isEmpty(elementHandle[6].val())
								&& isEmpty(elementHandle[7].val())) {
							isValidTelNumber = true;
						} else {
						if (isValidAreaCode(elementHandle[5],
								errorStatusHandle[3]) == true) {
							if (isValidPrefix(elementHandle[6],
									errorStatusHandle[3]) == true) {
								if (isValidPhone(elementHandle[7],
										errorStatusHandle[3]) == true) {
									isValidTelNumber = true;
								}
							}
						}}

						if (isValidTelNumber == false) {
							isValid = false;
						}

						return isValid;
					}

					function isValidEmailAddress(elementHandler,
							errorStatusHandler) {
						if (isEmpty(elementHandler.val())) {

							setErrorStatus(elementHandler, errorStatusHandler,
									"Please enter your email address");
							return false;

						}
						if (!isValidEmail(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"The email address appears to be invalid");
							return false;

						}
						return true;

					}

					function isValidState(elementHandler, errorStatusHandler) {

						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Please enter your state");
							return false;
						}
						if (!isValidStateAbbr(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Invalid state, please use the two letter state abbreviation");
							return false;
						}
						return true;
					}

					function isValidZipcode(elementHandler, errorStatusHandler) {
						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Please enter your zip code");
							return false;
						}
						if (!$.isNumeric(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Invalid zip code, numbers only please");
							return false;
						}
						if (elementHandler.val().length != 5) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"The zip code must have five digits");
							return false;
						}
						return true;
					}

					function isValidImage(elementHandler, errorStatusHandler) {

						if (isEmpty(elementHandler.val())) {

							setErrorStatus(elementHandler, errorStatusHandler,
									"Please upload a photo in .jpg or .png format");
							return false;
						}
						
						if (elementHandler.val().length > 15) {

							setErrorStatus(elementHandler, errorStatusHandler,
									"File name cannot be more than 15 characters");
							return false;
						}

						var fileExtension = elementHandler.val().substr(
								elementHandler.val().length - 4).toLowerCase();

						if (!(fileExtension == ".jpg" || fileExtension == ".png")) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Please upload a photo in .jpg or .png format only");
							return false;
						}
						return true;

					}

					function isValidDate(elementHandler, errorStatusHandler) {

						if (isEmpty(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Please enter date in mm/dd/yyyy format");
							return false;
						}

						// Declare Regex , Checks for dd/mm/yyyy format.
						var dateRegEx = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;

						if (!dateRegEx.test(elementHandler.val())) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Invalid date format. Enter in mm/dd/yyyy format");
							return false;
						}

						var dateParts = elementHandler.val().split("/");
						// now turn the three values into a Date object and
						// check them

						var dob = new Date(dateParts[2], dateParts[0] - 1,
								dateParts[1]);
						var checkDay = dob.getDate();
						var checkMonth = dob.getMonth() + 1;
						var checkYear = dob.getFullYear();

						if (!(dateParts[1] == checkDay
								&& dateParts[0] == checkMonth && dateParts[2] == checkYear)) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Please enter a valid date");
							return false;
						}

						var endDate = new Date(2014, 5, 2);

						var diff = endDate.getTime() - dob.getTime();

						var yrs = Math.floor(diff
								/ (1000 * 60 * 60 * 24 * 365.25));

						if (!(yrs >= 12 && yrs <= 18)) {
							setErrorStatus(elementHandler, errorStatusHandler,
									"Only children of age 12 to 18 are allowed");
							return false;
						}

						return true;
					}

					function isValidData() {

						var isValid = true;

						var selectedRelationship = $(
								'input[name=relationship]:checked').val();
						if (isEmpty(selectedRelationship)) {
							setErrorStatus(elementHandle[8],
									errorStatusHandle[4],
									"Please enter relationship");
							isValid = false;
						}

						var selectedGender = $('input[name=gender]:checked')
								.val();
						if (isEmpty(selectedGender)) {
							setErrorStatus(elementHandle[17],
									errorStatusHandle[13],
									"Please enter gender");
							isValid = false;
						}

						if (isValidDate(elementHandle[18],
								errorStatusHandle[14]) == false) {
							isValid = false;
						}

						if (isValidImage(elementHandle[16],
								errorStatusHandle[12]) == false) {
							isValid = false;
						}
						if (isValidZipcode(elementHandle[12],
								errorStatusHandle[8]) == false) {
							isValid = false;
						}
						if (isValidState(elementHandle[11],
								errorStatusHandle[7]) == false) {
							isValid = false;
						}
						if (isEmpty(elementHandle[10].val())) {
							setErrorStatus(elementHandle[10],
									errorStatusHandle[6],
									"Please enter your city");
							isValid = false;
						}

						if (isEmpty(elementHandle[9].val())) {
							setErrorStatus(elementHandle[9],
									errorStatusHandle[5],
									"Please enter your address");
							isValid = false;
						}

						if (isValidEmailAddress(elementHandle[13],
								errorStatusHandle[9]) == false) {
							isValid = false;
						}
						if (isvalidPhoneNumber() == false) {
							isValid = false;
						}
						if (isValidName() == false) {
							isValid = false;
						}
						return isValid;

					}

					// focus on 1st field on page load
					elementHandle[0].focus();

					// HANDLERS

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
					// clear status when parent first name is entered
					elementHandle[0].on('blur',
							function() {
								clearErrorStatus(elementHandle[0],
										errorStatusHandle[0]);
							});

					// clear status when parent last is entered
					elementHandle[1].on('blur',
							function() {
								clearErrorStatus(elementHandle[1],
										errorStatusHandle[1]);
							});
					// clear status when parent first name is entered
					elementHandle[22].on('blur',
							function() {
								clearErrorStatus(elementHandle[22],
										errorStatusHandle[16]);
							});
							
					// clear status when parent first name is entered
					elementHandle[23].on('blur',
							function() {
								clearErrorStatus(elementHandle[23],
										errorStatusHandle[17]);
							});

					elementHandle[2].on('blur', function() {
						if (isEmpty(elementHandle[2].val()))
							return;
						if (!isEmpty(errorStatusHandle[2].text())) {
							if (isValidAreaCode(elementHandle[2],
									errorStatusHandle[2]) == true) {

								if (isValidPrefix(elementHandle[3],
										errorStatusHandle[2]) == true) {
									if (isValidPhone(elementHandle[4],
											errorStatusHandle[2])) {
										removeError(errorStatusHandle[2]);
									}
								}
							}
							/*
							 * if (isValidAreaCode(elementHandle[2],
							 * errorStatusHandle[2])) {
							 * removeError(errorStatusHandle[2]); }
							 */
						}
					});

					elementHandle[3].on('blur', function() {
						if (isEmpty(elementHandle[3].val()))
							return;
						if (!isEmpty(errorStatusHandle[2].text())) {
							if (isValidAreaCode(elementHandle[2],
									errorStatusHandle[2]) == true) {

								if (isValidPrefix(elementHandle[3],
										errorStatusHandle[2]) == true) {
									if (isValidPhone(elementHandle[4],
											errorStatusHandle[2])) {
										removeError(errorStatusHandle[2]);
									}
								}
							}
							
						}
					});

					elementHandle[4].on('blur', function() {
						if (isEmpty(elementHandle[4].val()))
							return;
						if (!isEmpty(errorStatusHandle[2].text())) {
							if (isValidAreaCode(elementHandle[2],
									errorStatusHandle[2]) == true) {
								if (isValidPrefix(elementHandle[3],
										errorStatusHandle[2]) == true) {
									if (isValidPhone(elementHandle[4],
											errorStatusHandle[2])) {
										removeError(errorStatusHandle[2]);
									}
								}
							}
							
						}
					});

					elementHandle[5].on('blur', function() {
						if (isEmpty(elementHandle[5].val()))
							return;
						if (!isEmpty(errorStatusHandle[3].text())) {
							if (isValidAreaCode(elementHandle[5],
									errorStatusHandle[3]) == true) {
								if (isValidPrefix(elementHandle[6],
										errorStatusHandle[3]) == true) {
									if (isValidPhone(elementHandle[7],
											errorStatusHandle[3])) {
										removeError(errorStatusHandle[3]);
									}
								}
							}
							
						}
					});

					elementHandle[6].on('blur', function() {
						if (isEmpty(elementHandle[6].val()))
							return;
						if (!isEmpty(errorStatusHandle[3].text())) {
							if (isValidAreaCode(elementHandle[5],
									errorStatusHandle[3]) == true) {
								if (isValidPrefix(elementHandle[6],
										errorStatusHandle[3]) == true) {
									if (isValidPhone(elementHandle[7],
											errorStatusHandle[3])) {
										removeError(errorStatusHandle[3]);
									}
								}
							}
							
						}
					});

					elementHandle[7].on('blur', function() {
						if (isEmpty(elementHandle[7].val()))
							return;
						if (!isEmpty(errorStatusHandle[3].text())) {
							if (isValidAreaCode(elementHandle[5],
									errorStatusHandle[3]) == true) {
								if (isValidPrefix(elementHandle[6],
										errorStatusHandle[3]) == true) {
									if (isValidPhone(elementHandle[7],
											errorStatusHandle[3])) {
										removeError(errorStatusHandle[3]);
									}
								}
							}
							
						}
					});

					elementHandle[19].on('blur', function() {
						if (isEmpty(elementHandle[19].val()))
							return;
						if (!isEmpty(errorStatusHandle[15].text())) {
							if (isValidAreaCode(elementHandle[19],
									errorStatusHandle[15]) == true) {
								if (isValidPrefix(elementHandle[20],
										errorStatusHandle[15]) == true) {
									if (isValidPhone(elementHandle[21],
											errorStatusHandle[15])) {
										removeError(errorStatusHandle[15]);
									}
								}
							}
						}
					});

					elementHandle[20].on('blur', function() {
						if (isEmpty(elementHandle[20].val()))
							return;
						if (!isEmpty(errorStatusHandle[15].text())) {
							if (isValidAreaCode(elementHandle[19],
									errorStatusHandle[15]) == true) {
								if (isValidPrefix(elementHandle[20],
										errorStatusHandle[15]) == true) {
									if (isValidPhone(elementHandle[21],
											errorStatusHandle[15])) {
										removeError(errorStatusHandle[15]);
									}
								}
							}
						}
					});

					elementHandle[21].on('blur', function() {
						if (isEmpty(elementHandle[21].val()))
							return;
						if (!isEmpty(errorStatusHandle[15].text())) {
							if (isValidAreaCode(elementHandle[19],
									errorStatusHandle[15]) == true) {
								if (isValidPrefix(elementHandle[20],
										errorStatusHandle[15]) == true) {
									if (isValidPhone(elementHandle[21],
											errorStatusHandle[15])) {
										removeError(errorStatusHandle[15]);
									}
								}
							}
						}
					});

					// clear status when child first name is entered
					elementHandle[14].on('blur', function() {
						clearErrorStatus(elementHandle[14],
								errorStatusHandle[10]);
					});

					// clear status when child last name is entered
					elementHandle[15].on('blur', function() {
						clearErrorStatus(elementHandle[15],
								errorStatusHandle[11]);
					});

					elementHandle[12].on('blur', function() {

						if (isEmpty(elementHandle[12].val()))
							return;

						if (!isEmpty(errorStatusHandle[8].text())) {

							if (isValidZipcode(elementHandle[12],
									errorStatusHandle[8])) {
								removeError(errorStatusHandle[8]);
							}
						}
					});

					elementHandle[13].on('blur', function() {

						if (isEmpty(elementHandle[13].val()))
							return;

						if (!isEmpty(errorStatusHandle[9].text())) {

							if (isValidEmailAddress(elementHandle[13],
									errorStatusHandle[9])) {
								removeError(errorStatusHandle[9]);
							}
						}
					});

					// clear status when relationship is entered
					$('input[name=relationship]').click(function() {
						removeError(errorStatusHandle[4]);
					});

					// clear status when relationship is entered
					$('input[name=gender]').click(function() {
						removeError(errorStatusHandle[13]);
					});

					// clear status when address is entered
					elementHandle[9].on('blur',
							function() {
								clearErrorStatus(elementHandle[9],
										errorStatusHandle[5]);
							});
					// clear status when city is entered
					elementHandle[10].on('blur', function() {
						clearErrorStatus(elementHandle[10],
								errorStatusHandle[6]);
					});
					// clear status when photo is entered
					elementHandle[16].on('blur', function() {

						if (isEmpty(elementHandle[16].val()))
							return;
						if (!isEmpty(errorStatusHandle[12].text())) {
							if (isValidImage(elementHandle[16],
									errorStatusHandle[12])) {
								removeError(errorStatusHandle[12]);
							}
						}

					});

					elementHandle[11].on('blur', function() {
						if (isEmpty(elementHandle[11].val()))
							return;
						if (!isEmpty(errorStatusHandle[7].text())) {
							if (isValidState(elementHandle[11],
									errorStatusHandle[7])) {
								removeError(errorStatusHandle[7]);
							}
						}
					});

					// clear status when valid date is entered
					elementHandle[18].on('blur', function() {

						if (isEmpty(elementHandle[18].val()))
							return;
						if (!isEmpty(errorStatusHandle[14].text())) {
							if (isValidDate(elementHandle[18],
									errorStatusHandle[14])) {
								removeError(errorStatusHandle[14]);
							}
						}

					});

					// ///////////////////////////////////////////////////////////////

					elementHandle[11].on('keyup', function() {
						elementHandle[11].val(elementHandle[11].val()
								.toUpperCase());
					});

					// For phone number move the focus of the cursor ahead
					elementHandle[2].on('keyup', function() {
						if (elementHandle[2].val().length == 3)
							elementHandle[3].focus();
					});

					elementHandle[3].on('keyup', function() {
						if (elementHandle[3].val().length == 3)
							elementHandle[4].focus();
					});

					elementHandle[5].on('keyup', function() {
						if (elementHandle[5].val().length == 3)
							elementHandle[6].focus();
					});

					elementHandle[6].on('keyup', function() {
						if (elementHandle[6].val().length == 3)
							elementHandle[7].focus();
					});

					elementHandle[19].on('keyup', function() {
						if (elementHandle[19].val().length == 3)
							elementHandle[20].focus();
					});

					elementHandle[20].on('keyup', function() {
						if (elementHandle[20].val().length == 3)
							elementHandle[21].focus();
					});

					// //////////////////////////////////////////////////////////////////////////
					// Actions to be performed on button submit and reset
					$('form').on('submit', function(e){
						for (var i = 0; i <= 17; i++) {
							errorStatusHandle[i].text("");
							errorStatusHandle[i].removeClass("error");

						}
						if(isValidData()){
							var params = $('form').serialize();
    							e.preventDefault(); 
							$.post('php/ajax_check_dups.php', params+'$photo='+$("#photo").val(), handleAnswer);
							
						
						}else{
							return false;
						}
						
						
					});
					
					function handleAnswer(answer){
					
       						 if($.trim(answer) == "OK")  {
							 send_file();
         					                       
           					 }
       					 	else if ($.trim(answer) == "DUP"){
           						 $('#status').html("Duplicate! Same child cannot be enrolled again");
	    						 $('#status').css('color','red');
	  				 	 }
      					 	 else{
         					   	$('#status').html("Database error");  
	  					  	$('#status').css('color','red'); 
	  				  	}     
       					}
    					
					function handleAjaxPost(answer) {
  
    						if($.trim(answer) == "confirmation success")  {
							var params = $('form').serialize();
    	   						$.post('php/confirmation.php', params+'&photo='+$("#photo").val(), confirmHandler);
         						// window.location.assign("http://jadran.sdsu.edu/~jadrn046/proj2-b/php/confirmation.php");
   						 }else{
          					 	 $('#status').html(answer);
	   					 	 $('#status').css('color','red');
           					 
        					}  
   					 }
	
   					 function confirmHandler(response){
      					 	$('body').html(response);
    					 } 
    
    					 function send_file() {  
      
        					var form_data = new FormData($('form')[0]);  
	 
        					form_data.append("image", document.getElementById("photo").files[0]);
        					$.ajax( {
         						   url: "php/ajax_file_upload.php",
          						   type: "post",
         						   data: form_data,
          						   processData: false,
            						   contentType: false,
           						   success: function(response) {
							   
							   	if ($.trim(response) == "SUCCESS"){
								 	var params = $('form').serialize();
	  					  			$.post('php/processRequest.php', params+'&photo='+$("#photo").val(),handleAjaxPost);
									
	   							} else if($.trim(response) == "DUPLICATE")  {
         					  			 $('#status').html("Error, the file already exists on the server");
	    								 $('#status').css('color','red');
                      
           					 	 	} else if ($.trim(response) == "LARGE"){
           						 		$('#status').html("The file was too big to upload, the limit is 2MB");
	    						 		$('#status').css('color','red');
	  				 	 		}
      					 	 		
	    						 // var toDisplay = "<img src=\"/~jadrn046/proj2-b/_myImages_/" + fname + "\" />";    
	    						 //  var toDisplay = "<img src=\"/~jadrn046/proj2-b/_myImages_/beaches_panoramic7.jpg\" />";              
              
                					   },
           						   error: function(response) {
							 		
									$('#status').html("Sorry, upload error "+response.statusText);  
	  					  			$('#status').css('color','red'); 				
	   						   }
            					});
        				}

					$(':reset').on('click', function() {
						for (var i = 0; i <= 17; i++) {
							errorStatusHandle[i].text("");
							errorStatusHandle[i].removeClass("error");

						}
					});
				});
