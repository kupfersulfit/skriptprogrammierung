<?php




?>
<html>
        <head>
            <title>st@pleware</title>
            <link type="text/css" rel="stylesheet" href="style_admin.css" />
            <script type="text/javascript" src="../../js/jquery-1.8.0.min.js" ></script>
            <script type="text/javascript" src="ajax_admin.js" ></script>
            <script type="text/javascript">
                $(document).on('click', "input[name='aendern']", 
                    function() {
                        var id = this.id.substr(1,this.id.length);
                        getArtikel(id);
                        
				});
            </script>
        </head>
        <body>
        
<br>
<h1 align="center">Article management</h1>
<br>
<b>Add new Article:</b>

    <table cellspacing="10">
        <tr valign="top">
            <td>Name:</td>
            <td><input type="text" name="name"></td>
            <td>&nbsp;</td>
            <td rowspan="5">Description:</td>
            <td rowspan="5"><textarea cols="40" rows="12"></textarea><br></td>
        </tr>
        <tr>
            <td>Number (in store):</td>
            <td><input type="text" name="anzahl"></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td><input type="text" name="kategorie"></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="text" name="preis"></td>
        </tr>
        <tr>
            <td>Image source:</td>
            <td><input type="text" name="bildpfad"></td>
        </tr>        

    </table>
    <input type="button" id="newArticleSubmit" value="Add Article">
<br><br>

<p onclick='getAlleArtikel()'><button>Show all articles</button></p>
<div id="divArtikelTabelle"></div>

</body>
</html>