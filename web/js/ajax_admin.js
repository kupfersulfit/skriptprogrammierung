/* --- Customer ---*/

function getAlleKunden(){
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php',
        data : {
            'action' : 'holeAlleKunden'
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '<table cellspacing="0" cellpadding="4"><tr><th>ID</th><th>Name</th><th>Vorame</th><th>Email</th><th>&nbsp;</th></tr>';
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext += '<tr><td>'+ row.id+'</td><td>' + row.name + '</td><td>' + row.vorname + '</td><td>' + row.email + '</td><td><input type="button" name="send" id="a'+row.id +'" value="Change"/></td></tr>';
				
            };
            htmltext += '</table>';
            $("#tabelle").html(htmltext);
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getKunde(id){
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php',
        data : {
            'action' : 'holeKunde',
            'id' : id
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '<table>';
            htmltext += '<tr><td>Name:</td><td><input name="kundenName" id="kundenNameId" type="text" size="50" maxlength="50" value='+json.name+'></td></tr>';
            htmltext += '<tr><td>Vorname:</td><td><input name="kundenVorname" id="kundenVornameId" type="text" size="50" maxlength="50" value='+json.vorname+'></td></tr>';
            htmltext += '<tr><td>Stra&szlig;e:</td><td><input name="kundenStrasse" id="kundenStrasseId" type="text" size="50" maxlength="50" value='+json.strasse+'></td></tr>';			
            htmltext += '<tr><td>PLZ:</td><td><input name="kundenPlz" id="kundenPlzId" type="text" size="50" maxlength="50" value='+json.plz+'></td></tr>';
            htmltext += '<tr><td>Zusatz:</td><td><input name="kundenZusatz" id="kundenZusatzId" type="text" size="50" maxlength="50" value='+json.zusatz+'></td></tr>';
            htmltext += '<tr><td>Email:</td><td><input name="kundeEmail" id="kundenEmailId" type="text" size="50" maxlength="50" value='+json.email+'></td></tr>';
            htmltext += '<tr><td>Passwort:</td><td><input name="kundePw" id="kundenPwId" type="text" size="50" maxlength="50" value='+json.passwort+'></td></tr>';
            htmltext += '<tr><td>Registriert Seit:</td><td><input name="kundeSeit" id="kundenSeitId" type="text" size="50" maxlength="50" value='+json.registriertseit+' readonly></td></tr>';
            htmltext += '</table>';
            htmltext += '<input type="button" name="aendereKunde" id="k'+json.id+'" value="Change"/>';
            htmltext += '<input type="button" name="loescheKunde" id="k'+json.id+'" value="Delete"/>';
            $("#tabelle").html(htmltext);
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });	
        }
    });
}

function refreshKunde(json){
    jQuery.ajax({
        type : 'POSt',
        url : 'lib/controller.php',
        data : {
            'action' : 'aktualisiereKunde',
            'kunde' : Customer.getJSONstring()
        },
        dataType : 'json',
        success : function(json){
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : "change done"
                });
            }  
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function deleteKunde(json){
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php',
        data : {
            'action' : 'loescheKunde',
            'kunde' : Customer.getJSONstring()
        },
        dataType : 'json',
        success : function(json){
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : "Customer deleted"
                });
            }  
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

/* --- Article ---*/

function getAllArticles(){
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php',
        data : {
            'action' : 'zeigeArtikel'
        },
        dataType : 'json',
        success : function(json){
            var htmltext = "<table border='0' width='1000' cellspacing='0' cellpadding='4'><tr><th>ID</th><th>Name</th><th></th></tr>";
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.name + '</td><td><input type="button" name="aendereArtikel" id="a'+row.id +'" value="change"/></td></tr>';
            };
            htmltext += '</table><br><br>';
            $("#divModifyArticle").html(htmltext);
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });        
        }
    });
}

function modifyArticle(id){
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php',
        data : {
            'action' : 'holeArtikel', 
            'id' : id
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '';
            var artikel= new Article();
            artikel.create(json);
            htmltext += "<table border='0' cellspacing='0' cellpadding='4'>";
            htmltext += "<tr><td bgcolor='#ECECEC'>ID: </td><td>"+artikel.id+"</td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Name: </td><td><input type='text' name='name' id='modName' size='70' value='"+artikel.name+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Description: </td><td><textarea name='beschreibung' id='modDescr' cols='40' rows='12'>"+artikel.beschreibung+"</textarea></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Published: </td><td><input type='checkbox' name='veroeffentlicht' id='modPubl'";
            if(artikel.veroeffentlicht==1){
                htmltext += " checked ";
            }
            htmltext +="></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Price: </td><td><input type='text' name='preis' id='modPrice' size='40' value='"+artikel.preis+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Category ID: </td><td><input type='text' name='kategorie' id='modCat' size='40' value='"+artikel.kategorieid+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Image path: </td><td><input type='text' name='bildpfad' id='modImg' size='40' value='"+artikel.bildpfad+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Number(in stock): </td><td><input type='text' name='verfuegbar' id='modNr' size='40' value='"+artikel.verfuegbar+"'></td></tr>";
            htmltext += "</table>";
            htmltext += "<input type='button' name='aktualisiereArtikel' id='a"+artikel.id+"' value='ok'>";
            htmltext += "<input type='button' name='loescheArtikel' id='a"+artikel.id+"' value='delete article'><br><br>";
            $("#divModifyArticle").html(htmltext);
            $("#divAddArticle").hide();
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function updateArticle(id){
    var modArticle = new Article();
    modArticle.createtemporyIntance(id,$('#modName').val(),$('#modCat').val(),$('#modDescr').val(),$('#modPrice').val(),0,$('#modNr').val(),$('#modPubl').is(':checked'),$('#modImg').val());
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php',
        data : {
            'action' : 'aktualisiereArtikel',
            'artikel' : modArticle.getJSONstring()
        },
        dataType : 'json',
        success : function(json){
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : "update done"
                });
            }  
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function createArticle() {
    var newArticle = new Article();
    newArticle.createtemporyIntance(0,$('#newName').val(),$('#newCat').val(),$('#newDescr').val(),$('#newPrice').val(),0,$('#newNr').val(),$('#newPubl').is(':checked'),$('#newImg').val());
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'erstelleArtikel',
            'artikel' : newArticle.getJSONstring()
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages(json);
            } else {
                systemessages({
                    'success' : "article created"
                });
            }  
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function deleteArticle(id) {
    var delArticle = new Article();
    delArticle.createtemporyIntance(id,$('#modName').val(),$('#modCat').val(),$('#modDescr').val(),$('#modPrice').val(),0,$('#modNr').val(),$('#modPubl').is(':checked'),$('#modImg').val());
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php', 
        data : {
            'action' : 'loescheArtikel',
            'artikel' : delArticle.getJSONstring()
        },
        dataType : 'json',
        success : function (json) {
            if (json.error) {
                systemessages();
            } else {
                systemessages({
                    'success' : "article deleted"
                });
            }  
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

/* --- Order ---*/

function getAllOrders(){
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php',
        data : {
            'action' : 'zeigeBestellungen'
        },
        dataType : 'json',
        success : function(json){
            var htmltext = "<br><table border='0' width='1000' cellspacing='0' cellpadding='4'><tr><th>ID</th><th>Customer ID</th><th>Date ordered</th><th>Delivery</th><th>Status</th><th></th></tr>";
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.kundenid + '</td><td>' + row.bestelldatum + '</td><td>' + row.lieferungsmethodeid + '</td><td>' + row.statusid + '</td><td><input type="button" name="aendereBestellung" id="a'+row.id +'" value="change status"/></td></tr>';
            };
            htmltext += '</table><br><br>';
            $("#orderOverview").html(htmltext);
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });        
        }
    });
}