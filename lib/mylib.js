function handleUserDataError(errorCode)
{
	objErrorMsg = $("#error_msg");
	if (!objErrorMsg[0])
	{
		objUserData.append("<pre id= 'error_msg'></pre>");
		objErrorMsg = $("#error_msg");
	}
	objErrorMsg.text("");
	if (errorCode == 1)
		objErrorMsg.text("Fill in required fields");
	if (errorCode == 2)
		objErrorMsg.text("Passwords do not match");
	if (errorCode == 3)
		objErrorMsg.text("Password must have six characters\n or more");
}

function highlightField(objField, state)
{
	var objInput = objField.children();
	if (state === 1)
	{
		if (objInput[0].type == 'text')
		{
			objInput[0].value = 'required';
			objInput.css('color', 'red');
		}
		objInput.css('border', 'inset');
		objInput.css('border-color', 'red');
		objInput.css('border-width', '2px');
		objInput.css('font-style', 'italic');
		objField.css('color', 'rgb(200, 0, 25)');
		objField.css('font-style', 'bold');
	}
	else
	{
		objInput.css('color', 'black');
		objInput.css('border', 'inset');
		objInput.css('border-width', '2px');
		objInput.css('font-style', 'normal');
		objField.css('color', 'black');
	}
}

function removeSpaces(str)
{
	var ret = str.replace(/^\s+|\s+$/, '');
	ret = ret.replace(/\s+/, ' ');
	return (ret);
}