$(document).ready(function()
{
	$("#submit").click(loginUser);
	objUsername = $("#username");
	objPassword = $("#password");
	objUserData = $("#user_data");
	window.onresize = resizeElements;
});

function getServerErrorCode(serverReturn)
{
	console.log("Server Error Code = " + serverReturn);
	var arrServerReturn = serverReturn.split(';');
	console.log(arrServerReturn);
	var errorCode = arrServerReturn[0];
  	handleUserDataError(errorCode);
  	if (errorCode === '0');
  		$.post('php/redirect.php', {username: arrServerReturn[1]}, redirectUser);
}

function loginUser()
{
	var username      = removeSpaces(objUsername[0].childNodes[1].value);
	var passwd        = removeSpaces(objPassword[0].childNodes[1].value);
	var errorCode = 0;

	handleUserDataError(0);
	/*errorCode = showRequiredFields(username, passwd)
	if (errorCode)
		return (handleUserDataError(errorCode));*/
	$.post('php/login.php', {username: username, passwd: passwd}, getServerErrorCode);
}

function redirectUser(pageLocation)
{
	console.log('Page Location = ' + pageLocation);
	window.location = pageLocation;
}

function resizeElements()
{
	console.log(window.innerWidth);
	var availWidth = window.innerWidth;
	var minWidth = parseFloat(objUserData.css('min-width'));
	var divWidth = parseFloat(objUserData.css('width'));
	var padding = parseFloat(objUserData.css('padding'));
	console.log(minWidth);
	console.log(divWidth);
	console.log(padding);
	if (minWidth == divWidth)
	{
		var newMargin = (availWidth - (divWidth + (padding * 2))) / 2;
		console.log(newMargin);
		objUserData.css('margin-left', newMargin + 'px');
	}
	else
		objUserData.css('margin-left', '35vw');
}

function showRequiredFields(username, passwd)
{
	var arrStates = [0, 0];

	if (!username)
		arrStates[0] = 1;
	if (!passwd)
		arrStates[1] = 1;

	highlightField(objUsername, arrStates[0]);
	highlightField(objPassword, arrStates[1]);
	for (state in arrStates)
	{
		if (arrStates[state])
			return (1);
	}
	return (0);
}