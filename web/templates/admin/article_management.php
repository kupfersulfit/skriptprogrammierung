<div id="divAddArticle">
    <br>
    <b>Add new Article:</b>

    <table id='add' border='0' cellspacing='0' cellpadding="4">
        <tr valign="top">
            <td bgcolor='#ECECEC' width="172" >Name:</td>
            <td width="242" ><input type="text" name="name" id="newName"></td>
            <td colspan="2" bgcolor='#ECECEC' width="351" >Description:</td>
        </tr>
        <tr>
            <td bgcolor='#ECECEC'>Number (in stock):</td>
            <td><input type="text" name="anzahl" id="newNr"></td>
            <td rowspan="5"><textarea id="newDescr"></textarea><br></td>
        </tr>
        <tr>
            <td bgcolor='#ECECEC'>Category ID:</td>
            <td><input type="text" name="kategorie" id="newCat"></td>
        </tr>
        <tr>
            <td bgcolor='#ECECEC'>Price:</td>
            <td><input type="text" name="preis" id="newPrice"></td>
        </tr>
        <tr>
            <td bgcolor='#ECECEC'>Image source:</td>
            <td><input type="text" name="bildpfad" id="newImg"></td>
        </tr>        
        <tr>
            <td bgcolor='#ECECEC'>Publish now:</td>
            <td id="newPublTd" ><input type="checkbox" name="veroeffentlicht" id="newPubl"></td>
        </tr>
    </table>

    <input onclick='createArticle();' type="button" name="add" id="newArticleSubmit" value="Add Article">
    <br><br>
</div>
<input type="button" onclick='getAllArticles();'value="Show all articles" />
<br><br>
<div id="divModifyArticle"></div>