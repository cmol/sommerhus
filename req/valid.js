// usage:
// CheckForm([Text fields for checks id'd: 'MyTextFieldX'],[Drop downs for checks id'd: 'MyDropDX'],[RadioButtons for checks id'd: 'MyRadioBX'],[textareas for checks id'd: 'MyTextAreaX']) // where X is a uniqe id number (startet at 1)
// <input id="MyField1">
// <div id="MyFieldAlert1" style="visibility: hidden; z-index: -3; position: absolute; top: 0px;">
// 	Please input into ...
// </div>
// <input type="submit" onclick="return CheckForm([Number of text field for checks id'd: 'MyFieldX'],0,0,0)">
// 
// 


function CheckForm (text, pw, dd, rb, ta)
{
	valid = true;
	//Tester for text input felter
	if(text > 0)
	{
		for(x = 1; x <= text; x++)
		{
			testTf = document.getElementById("MyTextField"+x).value;
			if(testTf.length < 1)
			{
				valid = false;
				document.getElementById("MyTextFieldAlert"+x).style.visibility="visible";
				document.getElementById("MyTextFieldAlert"+x).style.zIndex="0";
				document.getElementById("MyTextFieldAlert"+x).style.position="relative";
				document.getElementById("MyTextFieldAlert"+x).style.top="-2px";
			}
			else
			{
				document.getElementById("MyTextFieldAlert"+x).style.visibility="hidden";
				document.getElementById("MyTextFieldAlert"+x).style.zIndex="-3";
				document.getElementById("MyTextFieldAlert"+x).style.position="absolute";
				document.getElementById("MyTextFieldAlert"+x).style.top="0px";
			}
		}
	}
	//Tester for password input felter
	if(pw > 0)
	{
		for(x = 1; x <= text; x++)
		{
			testPw = document.getElementById("MyPasswordField"+x).value;
			if(testPw.length < 6)
			{
				valid = false;
				document.getElementById("MyPasswordFieldAlert"+x).style.visibility="visible";
				document.getElementById("MyPasswordFieldAlert"+x).style.zIndex="0";
				document.getElementById("MyPasswordFieldAlert"+x).style.position="relative";
				document.getElementById("MyPasswordFieldAlert"+x).style.top="-2px";
			}
			else
			{
				document.getElementById("MyPasswordFieldAlert"+x).style.visibility="hidden";
				document.getElementById("MyPasswordFieldAlert"+x).style.zIndex="-3";
				document.getElementById("MyPasswordFieldAlert"+x).style.position="absolute";
				document.getElementById("MyPasswordFieldAlert"+x).style.top="0px";
			}
		}
	}
	//Tester for drop down felter	
	if(dd > 0)
	{
		for(x = 1; x <= dd; x++)
		{
			var testdd=document.getElementById("MyDropD"+x);
			if(testdd.selectedIndex=="0")
			{
				valid = false;
				document.getElementById("MyDropDAlert"+x).style.visibility="visible";
				document.getElementById("MyDropDAlert"+x).style.zIndex="0";
				document.getElementById("MyDropDAlert"+x).style.position="relative";
				document.getElementById("MyDropDAlert"+x).style.top="-px";
			}
			else
			{
				document.getElementById("MyDropDAlert"+x).style.visibility="hidden";
				document.getElementById("MyDropDAlert"+x).style.zIndex="-3";
				document.getElementById("MyDropDAlert"+x).style.position="absolute";
				document.getElementById("MyDropDAlert"+x).style.top="0px";
			}
		}
	}
	//Tester Radio Button
	if(rb > 0)
	{
		for(x = 1; x <= rb; x++)
		{
			test = document.getElementById("MyRadioB"+x).value;
			if(test.length < 1)
			{
				valid = false;
				document.getElementById("MyRadioBAlert"+x).style.visibility="visible";
				document.getElementById("MyRadioBAlert"+x).style.zIndex="0";
				document.getElementById("MyRadioBAlert"+x).style.position="relative";
				document.getElementById("MyRadioBAlert"+x).style.top="-2px";
			}
			else
			{
				document.getElementById("MyRadioBAlert"+x).style.visibility="hidden";
				document.getElementById("MyRadioBAlert"+x).style.zIndex="-3";
				document.getElementById("MyRadioBAlert"+x).style.position="absolute";
				document.getElementById("MyRadioBAlert"+x).style.top="0px";
			}
		}
	}
	// Tester textarea
	if(ta > 0)
	{
		for(x = 1; x <= ta; x++)
		{
			test = document.getElementById("MyTextArea"+x).value;
			if(test.length < 1)
			{
				valid = false;
				document.getElementById("MyTextAreaAlert"+x).style.visibility="visible";
				document.getElementById("MyTextAreaAlert"+x).style.zIndex="0";
				document.getElementById("MyTextAreaAlert"+x).style.position="relative";
				document.getElementById("MyTextAreaAlert"+x).style.top="-2px";
			}
			else
			{
				document.getElementById("MyTextAreaAlert"+x).style.visibility="hidden";
				document.getElementById("MyTextAreaAlert"+x).style.zIndex="-3";
				document.getElementById("MyTextAreaAlert"+x).style.position="absolute";
				document.getElementById("MyTextAreaAlert"+x).style.top="0px";
			}
		}
	}
	return valid;
}
