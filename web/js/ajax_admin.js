/* --- Admin ---  */
function getUserManagement() {
    jQuery.ajax({
        type : 'GET',
        url : 'templates/admin/user_management.php', 
        dataType : 'html',
        success : function (html) {
            jQuery('#adminContent').html(html);
            getAlleKunden();
        }
    });
}

function getArticleManagement() {
    jQuery.ajax({
        type : 'GET',
        url : 'templates/admin/article_management.php',
        dataType : 'html',
        success : function (html) {
            jQuery('#adminContent').html(html);
        }
    });
}

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
            var htmltext = '<table cellspacing="0" cellpadding="4"><tr><th>ID</th><th>Name</th><th>Vorname</th><th>Email</th><th>&nbsp;</th></tr>';
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext += '<tr><td>'+ row.id+'</td><td>' + row.name + '</td><td>' + row.vorname + '</td><td>' + row.email + '</td><td><input type="button" name="send" id="a'+row.id +'" value="Change"/></td></tr>';
				
            };
            htmltext += '</table>';
            jQuery("#tabelle").html(htmltext);
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
            var htmltext = '<table width="456" id=tableid>';
            htmltext += '<tr><td>Name:</td><td><input name="kundenName" id="kundenNameId" type="text" size="50" maxlength="50" value='+json.name+'></td></tr>';
            htmltext += '<tr><td>Vorname:</td><td><input name="kundenVorname" id="kundenVornameId" type="text" size="50" maxlength="50" value='+json.vorname+'></td></tr>';
            htmltext += '<tr><td>Stra&szlig;e:</td><td><input name="kundenStrasse" id="kundenStrasseId" type="text" size="50" maxlength="50" value='+json.strasse+'></td></tr>';			
            htmltext += '<tr><td>PLZ:</td><td><input name="kundenPlz" id="kundenPlzId" type="text" size="50" maxlength="50" value='+json.plz+'></td></tr>';
            htmltext += '<tr><td>Zusatz:</td><td><input name="kundenZusatz" id="kundenZusatzId" type="text" size="50" maxlength="50" value='+json.zusatz+'></td></tr>';
            htmltext += '<tr><td>Email:</td><td><input name="kundeEmail" id="kundenEmailId" type="text" size="50" maxlength="50" value='+json.email+'></td></tr>';
            htmltext += '<tr><td>Passwort:</td><td><input name="kundePw" id="kundenPwId" type="text" size="50" maxlength="50" value='+json.passwort+'></td></tr>';
            htmltext += '<tr><td>Registriert Seit:</td><td><input name="kundeSeit" id="kundenSeitId" type="text" size="50" maxlength="50" value='+json.registriertseit+' readonly></td></tr>';
            htmltext += '</table>';
            htmltext += '<input type="button" class="button" name="aendereKunde" id="k'+json.id+'" value="Change"/>';
            htmltext += '<input type="button" class="button" name="loescheKunde" id="k'+json.id+'" value="Delete"/>';
            jQuery("#tabelle").html(htmltext);
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
			getCustomerInformation();
            if (json.error) {
                systemessages(json);
            } else {
				getAlleKunden();
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
			getCustomerInformation();
            if (json.error) {
                systemessages(json);
            } else {
				getAlleKunden();
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
            var htmltext = "<table border='0' cellspacing='0' cellpadding='4'><tr><th>ID</th><th>Name</th><th></th></tr>";
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.name + '</td><td><input type="button" name="aendereArtikel" id="a'+row.id +'" value="change"/></td></tr>';
            };
            htmltext += '</table><br><br>';
            jQuery("#divModifyArticle").html(htmltext);
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
            jQuery("#divModifyArticle").html(htmltext);
            jQuery("#divAddArticle").hide();
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function updateArticle(id){
    var pbl =0;
    if(jQuery('#modPubl').is(':checked'))
        pbl=1;
    var modArticle = new Article();
    modArticle.createtemporyIntance(id,jQuery('#modName').val(),jQuery('#modCat').val(),jQuery('#modDescr').val(),jQuery('#modPrice').val(),0,jQuery('#modNr').val(),pbl,jQuery('#modImg').val());
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
				getAllArticles();
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
    var pbl =0;
    if(jQuery('#newPubl').is(':checked'))
        pbl=1;
    var newArticle = new Article();
    newArticle.createtemporyIntance(0,jQuery('#newName').val(),jQuery('#newCat').val(),jQuery('#newDescr').val(),jQuery('#newPrice').val(),0,jQuery('#newNr').val(),pbl,jQuery('#newImg').val());
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
    var pbl =0;
    if(jQuery('#modPubl').is(':checked'))
        pbl=1;
    var delArticle = new Article();
    delArticle.createtemporyIntance(id,jQuery('#modName').val(),jQuery('#modCat').val(),jQuery('#modDescr').val(),jQuery('#modPrice').val(),0,jQuery('#modNr').val(),pbl,jQuery('#modImg').val());
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
				getAllArticles();
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
            'action' : 'holeAlleBestellungen'
        },
        dataType : 'json',
        success : function(json){
            var htmltext = "<br><table border='0' cellspacing='0' cellpadding='4'><tr><th>ID</th><th>Date ordered</th><th>Delivery</th><th>Status</th><th></th></tr>";
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                
                var delivery;
                if(row.lieferungsmethodeid == 1){
                    delivery = "Paketversand";
                }else if(row.lieferungsmethodeid == 2){
                    delivery = "Expressversand";
                }else if(row.lieferungsmethodeid == 3){
                    delivery = "Selbstabholung";
                }
                var status;
                if(row.statusid==1){
                        status = "Offen";
                }else if(row.statusid==2){
                        status = "Versandt";
                }
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.bestelldatum + '</td><td>' + delivery + '</td><td>' + status + '</td><td><input type="button" onclick="modifyOrder('+row.id+')" name="aendereBestellung" value="change status"/></td></tr>';
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

function modifyOrder(id){
    jQuery.ajax({
        type : 'GET',
        url : 'lib/controller.php',
        data : {
            'action' : 'holeBestellung', 
            'id' : id
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '';
            var bestellung= new Order();
            bestellung.create(json);
            var jsonKunde = getOrdersCustomer(bestellung.kundenid);
            var delivery;
            if(bestellung.lieferungsmethodeid == 1){
                delivery = "Paketversand";
            }else if(bestellung.lieferungsmethodeid == 2){
                delivery = "Expressversand";
            }else if(bestellung.lieferungsmethodeid == 3){
                delivery = "Selbstabholung";
            }
            htmltext += "<table border='0' cellspacing='0' cellpadding='4'>";
            htmltext += "<tr><td bgcolor='#ECECEC'>ID: </td><td>"+bestellung.id+"</td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Kunde: </td><td>"+jsonKunde.vornamename+jsonKunde.name+"<br>"
                                                                    +jsonKunde.strasse+"<br>"
                                                                    +jsonKunde.plz+"<br>"+jsonKunde.zusatz+"<br>"+"</td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Bestelldatum: </td><td>"+bestellung.bestelldatum+"</td></tr>";
            //TODO: Select-Feld anpassen
            htmltext += "<tr><td bgcolor='#ECECEC'>Status: </td><td><select id='status'></select></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Lieferungsmethode: </td><td>"+delivery+"</td></tr>";
            htmltext += "</table>";
            htmltext += "<input type='button' onclick='updateOrder(bestellung)' name='aktualisiereBestellung' value='ok'>";
            $("#orderOverview").html(htmltext);
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });
        }
    });
}

function getOrdersCustomer(id){
    jQuery.ajax({
        type : 'POST',
        url : 'lib/controller.php',
        data : {
            'action' : 'holeKunde',
            'id' : id
        },
        dataType : 'json',
        success : function(json){
            return json;
        },
        error : function () {
            systemessages({
                'error' : 'something with the server went wront'
            });	
        }
    });
}

function updateOrder(bestellung){
    var statusid;
    //TODO: Wert des Select-Feldes ermitteln
    bestellung.statusid=statusid;
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
				getAllArticles();
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