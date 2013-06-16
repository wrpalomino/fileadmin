<html>
<head>
<title>My First ASP Page</title>
</head>
<body bgcolor="white" text="black">	

<%
'Dimension variables
Dim strMessage	

'Place the value Hello World into the variable strMessage
strMessage = "Hello World"	


'Write the contents of the variable strMessage to the web page 
Response.Write (strMessage)	


'Write line break into the web page
Response.Write ("<br>")	


'Write the server time on the web page using the VBScript Time() function
Response.Write ("The time on the server is: " & Time())

'Close the server script
%>	

</body>
</html>