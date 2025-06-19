<html>
<body>
	<%
	Double input = new Double(request.getParameter("arg"));
	double sqrt = Math.sqrt(input);
	%>

	<h2> The square root of <%= input %> is <%= sqrt %> </h2>
</body>
</html>
