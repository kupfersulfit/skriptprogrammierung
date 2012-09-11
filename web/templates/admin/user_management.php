
<html>
	<head>
		<title>st@pleware</title>
		<link type="text/css" rel="stylesheet" href="style_admin.css"/>
		<script type="text/javascript" src="../../js/jquery-1.8.1.min.js" ></script>
		<script type="text/javascript" src="../../js/main.js" ></script>
		<script type="text/javascript" src="../../js/Customer.js" ></script>
        <script type="text/javascript" src="ajax_admin.js" ></script>
		<script type="text/javascript">
			$(document).on('click', "input[name='send']", 
				function() {
					var id=this.id.substr(1,this.id.length);
					getKunde(id);
				}
			);
			$(document).on('click', "input[name='kundenSend']", 
				function() {
//					alert("Kunde ist geändert worden.");
					refreshKunde();
					alert("Kunde ist geändert worden.");
				}
			);
		</script>
	</head>
	<body>

<h1>User managment</h1>

<!-- alle Kunden ausgeben -->
<form method="post">
	<p onclick='getAlleKunden()'>ladeKunden</p>
	<div id="tabelle">
	
	</div>
</form>

	</body>
</html>
