<html>
<head>
	<title>Management - @yield('title')</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">
	<script src="https://kit.fontawesome.com/16a75b8455.js" crossorigin="anonymous"></script>
	
</head>
<body>
	<nav class="navbar navbar-dark bg-primary">
		<a href="/employee" class="navbar-brand">Management</a>
	</nav>
	<div class="container">
		@yield('content')
	</div>
</body>
</html>