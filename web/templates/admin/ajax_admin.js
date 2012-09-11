
function getAlleKunden(){
	jQuery.ajax({
		type : 'POST',
		url : '../../lib/controller.php',
		data : {
			'action' : 'holeAlleKunden'
		},
		dataType : 'json',
		success : function(json){
			var htmltext = '<table border=1><tr><th>ID</th><th>Name</th><th>Vorame</th><th>Email</th><th>Ändern</th></tr>';
			for(var i = 0; i < json.length; i++){
				var row=json[i];
				htmltext += '<tr><td>'+ row.id+'</td><td>' + row.name + '</td><td>' + row.vorname + '</td><td>' + row.email + '</td><td><input type="button" name="send" id="a'+row.id +'" value="Change"/></td></tr>';
				
			};
			htmltext += '</table>';
			$("#tabelle").html(htmltext);
		},
		error : function (json) {
        
		}
	});
}

function getKunde(id){
	jQuery.ajax({
		type : 'POST',
		url : '../../lib/controller.php',
		data : {
			'action' : 'holeKunde',
			'id' : id
		},
		dataType : 'json',
		success : function(json){
			
			var htmltext = '<table>';
			htmltext += '<tr><td>Name:</td><td><input name="kundenName" id="kundenNamenId" type="text" size="50" maxlength="50" value='+json.name+'></td></tr>';
			htmltext += '<tr><td>Vorname:</td><td><input name="kundenVorname" id="kundenVornameId" type="text" size="50" maxlength="50" value='+json.vorname+'></td></tr>';
			htmltext += '<tr><td>Straße:</td><td><input name="kundenStrasse" id="kundenStrasseId" type="text" size="50" maxlength="50" value='+json.strasse+'></td></tr>';			
			htmltext += '<tr><td>PLZ:</td><td><input name="kundenPlz" id="kundenPlzId" type="text" size="50" maxlength="50" value='+json.plz+'></td></tr>';
			htmltext += '<tr><td>Zusatz:</td><td><input name="kundenZusatz" id="kundenZusatzId" type="text" size="50" maxlength="50" value='+json.zusatz+'></td></tr>';
			htmltext += '<tr><td>Email:</td><td><input name="kundeEmail" id="kundenEmailId" type="text" size="50" maxlength="50" value='+json.email+'></td></tr>';
			htmltext += '<tr><td>Registriert Seit:</td><td><input name="kundeSeit" id="kundenSeitId" type="text" size="50" maxlength="50" value='+json.registriertseit+' readonly></td></tr>';
			htmltext += '</table>';
			htmltext += '<input type="button" name="aendereKunde" id="k'+json.id+'" value="Change"/>';
			htmltext += '<input type="button" name="loescheKunde" id="k'+json.id+'" value="Delete"/>';
			$("#tabelle").html(htmltext);
			
//			console.debug(json);
			Customer.create(json.id, json.name, json.vorname, json.strasse, json.plz, json.zusatz, json.email);
		},
		error : function (json) {
			
		}
	});
}

function refreshKunde(json){
	jQuery.ajax({
		type : 'GET',
		url : '../../lib/controller.php',
		data : {
			'action' : 'aktualisiereKunde',
			'kunde' : Customer 
		},
		dataType : 'json',
		success : function(json){
			Customer.getJSONstring();
		},
		error : function (json) {
        
		}
	});
}

function deleteKunde(json){
	jQuery.ajax({
		type : 'GET',
		url : '../../lib/model.php',
		data : {
			'action' : 'loescheKunde',
			'kunde' : Customer 
		},
		dataType : 'json',
		success : function(json){
			//Customer.getJSONstring();
		},
		error : function (json) {
        
		}
	});
}

function getAllArticles(){
	jQuery.ajax({
		type : 'GET',
		url : '../../lib/controller.php',
		data : {
			'action' : 'zeigeArtikel'
		},
		dataType : 'json',
		success : function(json){
            var htmltext = "<table id='all' border='0' width='1000' cellspacing='0' cellpadding='4'><tr><th>ID</th><th>Name</th><th></th></tr>";
			for(var i = 0; i < json.length; i++){
				var row=json[i];
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.name + '</td><td><input type="button" name="aendern" id="a'+row.id +'" value="change"/></td></tr>';
			};
            htmltext += '</table><br><br>';
            $("#divArtikelTabelle").html(htmltext);
		},
		error : function (json) {
        
		}
	});
}


function modifyArticle(id){
	jQuery.ajax({
		type : 'GET',
		url : '../../lib/controller.php',
		data : {
			'action' : 'holeArtikel', 
            'id' : id
		},
		dataType : 'json',
		success : function(json){
            var htmltext = '';
            var artikel= new Article();
            artikel.create(json);
            htmltext += "<table valign='top' id='modify' width='800' border='0' cellspacing='0' cellpadding='4'>";
            htmltext += "<tr><td bgcolor='#ECECEC'>ID: </td><td>"+artikel.id+"</td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Name: </td><td><input type='text' name='name' id='modName' size='70' value='"+artikel.name+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Description: </td><td><textarea name='beschreibung' id='modDescr' cols='40' rows='12'>"+artikel.beschreibung+"</textarea></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Published: </td><td><input type='checkbox' name='veroeffentlicht' id='modPubl'";
            if(artikel.veroeffentlicht==1){
                 htmltext += " checked ";
            }
            htmltext +="></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Price: </td><td><input type='text' name='preis' id='modPrice' size='40' value='"+artikel.preis+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Category ID: </td><td><input type='text' name='kategorie' id='modCat' size='40' value='"+artikel.kategoryId+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Image path: </td><td><input type='text' name='bildpfad' id='modImg' size='40' value='"+artikel.bildpfad+"'></td></tr>";
            htmltext += "<tr><td bgcolor='#ECECEC'>Number(in stock): </td><td><input type='text' name='verfuegbar' id='modNr' size='40' value='"+artikel.verfuegbar+"'></td></tr>";
            htmltext += "</table>";
            htmltext += "<input type='button' name='aendereArtikel' id='a"+artikel.id+"' value='ok'>";
            htmltext += "<input type='button' name='loescheArtikel' id='a"+artikel.id+"' value='delete article'><br><br>";
            $("#divArtikelTabelle").html(htmltext);
            $("#divAddArticle").hide();
		},
		error : function (json) {
        
		}
	});
}

function sendModifiedArticle(id){
	jQuery.ajax({
		type : 'POST',
		url : '../../lib/controller.php',
		data : {
			'action' : 'aktualisiereArtikel',
            "id": id,
            "name": $('#modName'),
            "beschreibung":$('#modDescr'),
            "bildpfad":$('#modImg'),
            "veroeffentlicht":$('#modPubl'),
            "kategorieId":$('#modCat'),
            "preis":$('#modPrice'),
            "verfuegbar":$('#modNr')
		},
		dataType : 'json',
		success : function(json){

		},
		error : function (json) {
        
		}
	});
}

function createArticle() {
    jQuery.ajax({
        type : 'GET',
        url : '../../lib/controller.php', 
        data : {
            'action' : 'erstelleArtikel',
            "name": $('#newName'),
            "beschreibung":$('#newDescr'),
            "bildpfad":$('#newImg'),
            "veroeffentlicht":$("#newPubl").is(":checked"),
            "kategorieId":$('#newCat'),
            "preis":$('#newPrice'),
            "verfuegbar":$('#newNr')
        },
        dataType : 'json',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function deleteArticle(id) {
    jQuery.ajax({
        type : 'POST',
        url : '../../lib/controller.php', 
        data : {
            'action' : 'loescheArtikel',
            "id": id
        },
        dataType : 'json',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}