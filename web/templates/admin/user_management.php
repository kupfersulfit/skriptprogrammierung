
<html>
	<head>
		<title>st@pleware</title>
                <link type="text/css" rel="stylesheet" href="../../css/style_main.css"/>
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
			$(document).on('click', "input[name='aendereKunde']", 
				function() {
					refreshKunde();
					alert("Kunde ist ge�ndert worden.");
				}
			);
			$(document).on('click', "input[name='loescheKunde']", 
				function() {
					deleteKunde();
					alert("Kunde ist gel�scht worden.");
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
