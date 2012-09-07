
function getAlleKunden(){
	jQuery.ajax({
		type : 'POST',
		url : '../../lib/controller.php',
		data : {
			'action' : 'holeAlleKunden'
		},
		dataType : 'json',
		success : function(json){
			var htmltext = '<table border=1><tr><th>ID</th><th>Name</th><th>Vorame</th><th>Email</th><th>�ndern</th></tr>';
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
			htmltext += '<tr><td>Stra�e:</td><td><input name="kundenStrasse" id="kundenStrasseId" type="text" size="50" maxlength="50" value='+json.strasse+'></td></tr>';			
			htmltext += '<tr><td>PLZ:</td><td><input name="kundenPlz" id="kundenPlzId" type="text" size="50" maxlength="50" value='+json.plz+'></td></tr>';
			htmltext += '<tr><td>Zusatz:</td><td><input name="kundenZusatz" id="kundenZusatzId" type="text" size="50" maxlength="50" value='+json.zusatz+'></td></tr>';
			htmltext += '<tr><td>Email:</td><td><input name="kundeEmail" id="kundenEmailId" type="text" size="50" maxlength="50" value='+json.email+'></td></tr>';
			htmltext += '<tr><td>Registriert Seit:</td><td><input name="kundeSeit" id="kundenSeitId" type="text" size="50" maxlength="50" value='+json.registriertseit+' readonly></td></tr>';
			htmltext += '</table>';
			htmltext += '<input type="button" name="kundenSend" id="kundenChange" value="Change"/>';
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
			
		},
		error : function (json) {
        
		}
	});
}

function getAlleArtikel(){
    jQuery.ajax({
        type : 'GET',
        url : '../../lib/controller.php',
        data : {
            'action' : 'zeigeArtikel'
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '<table><tr><th>ID</th><th>Name</th><th></th></tr>';
            for(var i = 0; i < json.length; i++){
                var row=json[i];
                htmltext+= '<tr><td>'+row.id+'</td><td>' + row.name + '</td><td><input type="button" name="aendern" id="a'+row.id +'" value="change"/></td></tr>';
            };
            htmltext += '</table>';
            $("#divArtikelTabelle").html(htmltext);
        },
        error : function (json) {
       
        }
    });
}

function getArtikel(id){
    jQuery.ajax({
        type : 'GET',
        url : '../../lib/controller.php',
        data : {
            'action' : 'holeArtikel', 'id' : id
        },
        dataType : 'json',
        success : function(json){
            var htmltext = '';
            var artikel=json;
            htmltext += "<table>";
            htmltext += "<tr><td>Name: </td><td><input type='text' name='name' size='70' value='"+artikel.name+"'></td></tr>";
            htmltext += "<tr><td>Description: </td><td><textarea name='beschreibung' cols='40' rows='12'>"+artikel.beschreibung+"</textarea></td></tr>";
            htmltext += "<tr><td>Published: </td><td><input type='text' name='veroeffentlicht' size='40' value='"+artikel.veroeffentlicht+"'></td></tr>";
            htmltext += "<tr><td>Preis: </td><td><input type='text' name='preis' size='40' value='"+artikel.preis+"'></td></tr>";
            htmltext += "</table>";
            $("#divArtikelTabelle").html(htmltext);
            $("#divAddArticle").hide();
        },
        error : function (json) {
       
        }
    });
}
