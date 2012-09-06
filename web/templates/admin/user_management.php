<?php




?>

<html>
	<head>
		<title>st@pleware</title>
		<link type="text/css" rel="stylesheet" href="style_admin.css"/>
		<script type="text/javascript" src="js/jquery-1.8.0.min.js" ></script>
        <script type="text/javascript" src="js/ajax_admin.js" ></script>

	</head>
	<body>

<h1>User managment</h1>

<!-- alle Kunden ausgeben -->
<form method="post">
	<table border=1>
		<tr>
			<th>ID</th><th>Name</th><th>Vorname</th><th>Straße</th><th>PLZ</th>
			<th>Zusatz</th><th>email</th><th>Passwort</th><th>Registriert Seit</th><th>Ändern</th>
		</tr>
		<tr>
			<!-- über alle Kunden iterieren-->
			
		</tr>
	</table>
</form>

	</body>
</html>

<?
/*
        jQuery.ajax({
            type : 'POST',
            url : 'lib/controller.php', 
            data : {
                'action' : 'login',
                'email' : jQuery('#email').val(),
                'passwort' : jQuery('#password').val()
            },
            dataType : 'jsonp',
            success : function (json) {
                console.debug(json);
                jQuery('#email, #password').css('border-color','#FFFFFF');
                jQuery('#email').val('');
            },
            error : function (json) {
                console.debug(json);
            }
        });
		
		
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