$(document).ready(function()
{
	$("#submit").click(registerUser);
	objFirstName = $("#first_name");
	objLastName = $("#last_name");
	objUsername = $("#username");
	objEmailAddress = $("#email_address");
	objPassword = $("#password");
	objConfirmPassword = $("#confirm_password");
	objUserData = $("#user_data");
	resizeElements();
	window.onresize = resizeElements;
});

function registerUser()
{
	var firstName     = removeSpaces(objFirstName[0].childNodes[1].value);
	var lastName      = removeSpaces(objLastName[0].childNodes[1].value);
	var username      = removeSpaces(objUsername[0].childNodes[1].value);
	var emailAddress  = removeSpaces(objEmailAddress[0].childNodes[1].value);
	var passwd        = removeSpaces(objPassword[0].childNodes[1].value);
	var confirmPasswd = removeSpaces(objConfirmPassword[0].childNodes[1].value);
	var errorCode = 0;

	handleUserDataError(0);
	errorCode = showRequiredFields(firstName, lastName, username, emailAddress, passwd, confirmPasswd);
	if (errorCode != 0)
		return (handleUserDataError(errorCode));
	errorCode = validPassword(passwd, confirmPasswd);
	if (errorCode != 0)
		return (handleUserDataError(errorCode));
	$.post("php/register_user.php", {first_name: firstName, last_name: lastName, username: username, email_address: emailAddress, passwd: passwd, 
									 confirm_passwd: confirmPasswd}, 
		function( serverErrorCode ) {
			console.log("Server Error Code = " + serverErrorCode);
  			handleUserDataError(serverErrorCode);
		}
	);
}

function resizeElements()
{
	var availWidth = window.innerWidth;
	var minWidth = parseFloat(objUserData.css('min-width'));
	var divWidth = parseFloat(objUserData.css('width'));
	var padding = parseFloat(objUserData.css('padding'));
	if (minWidth == divWidth)
	{
		var newMargin = (availWidth - (divWidth + (padding * 2))) / 2;
		objUserData.css('margin-left', newMargin + 'px');
	}
	else
		objUserData.css('margin-left', '35vw');
}

function showRequiredFields(firstName, lastName, username, emailAddress, passwd, confirmPasswd)
{
	var arrStates = [0, 0, 0, 0, 0, 0];
	if (!firstName)
		arrStates[0] = 1;
	if (!lastName)
		arrStates[1] = 1;
	if (!username)
		arrStates[2] = 1;
	if (!emailAddress)
		arrStates[3] = 1;
	if (!passwd)
		arrStates[4] = 1;
	if (!confirmPasswd)
		arrStates[5] = 1;

	highlightField(objFirstName, arrStates[0]);
	highlightField(objLastName, arrStates[1]);
	highlightField(objUsername, arrStates[2]);
	highlightField(objEmailAddress, arrStates[3]);	
	highlightField(objPassword, arrStates[4]);
	highlightField(objConfirmPassword, arrStates[5]);
	for (state in arrStates)
	{
		if (arrStates[state])
			return (1);
	}
	return (0);
}

function validPassword(passwd, confirmPasswd)
{
	if (passwd != confirmPasswd)
		return (2);
	if (passwd.length < 6)
		return (3);
	return (0);
}