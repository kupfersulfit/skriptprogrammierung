<?php




?>

<html>
	<head>
		<title>st@pleware</title>
		<link type="text/css" rel="stylesheet" href="style_admin.css"/>
		<script type="text/javascript" src="../../js/jquery-1.8.0.min.js" ></script>
        <script type="text/javascript" src="ajax_admin.js" ></script>
		<script type="text/javascript">
			$(document).on('click', "input[name='send']", 
				function() {
					var id = this.attributes.getNamedItem('id');
					var bla =2;
				});
		</script>
	</head>
	<body>

<h1>User managment</h1>

<!-- alle Kunden ausgeben -->
<form method="post">
	<p onclick='getAlleKunden()'>ladeKunden</p>
	<table border=1 id="KundenTable">
		<thead>
		<tr>
			<th>ID</th><th>Name</th><th>Vorname</th><th>Straße</th><th>PLZ</th>
			<th>Zusatz</th><th>email</th><th>Passwort</th><th>Registriert Seit</th><th>Ändern</th>
		</tr>
		</thead>
		<tbody id='KundenBody'>
			<tr><td></td></tr>
		</tbody>
	</table>
</form>

	</body>
</html>

<?
/*
		
function getAdminContent(pageName) {
    jQuery.ajax({
        url: 'templates/admin/' + pageName + ".php",
        success: function (data) {
            jQuery('#left').html(data);
        }
    });
}
*/
?>