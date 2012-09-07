
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
				htmltext += '<tr><td>'+ row.id+'</td><td>' + row.name + '</td><td>' + row.vorname + '</td><td>' + row.email + '</td><td><input type="button" name="send" id="a'+row.id +'" value="aendern"/></td></tr>';
				
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
		type : 'GET',
		url : '../../lib/controller.php',
		data : {
			'action' : 'holeKunde',
			'id' : id
		},
		dataType : 'json',
		success : function(json){
			
			var htmltext = '';
//			var kunde = json['id'];
//			htmltext += kunde.name;
			$("#tabelle").html(htmltext);
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
            //var artikel=json[0];
            //htmltext += artikel.name;
            $("#divArtikelTabelle").html(htmltext);
        },
        error : function (json) {
       
        }
    });
}
