
function getAlleKunden(){
	jQuery.ajax({
		type : 'POST',
		url : '../../lib/controller.php',
		data : {
			'action' : 'zeigeArtikel'
		},
		dataType : 'json',
		success : function(json){

			var items = [];

			$("#KundenBody").empty();
			for(var i = 0; i < json.length; i++){
				var row=json[i];
				var htmltext = '<tr><td>'+ row.name+'</td><td>' + row.id + '</td><td><input type="button" name="send" id="a'+row.id +'" value="aendern"/></td></tr>';
				$("#KundenBody").append(htmltext);
			};
		},
		error : function (json) {
        
		}
	});
}

function getAlleArtikel(){
	jQuery.ajax({
		type : 'GET',
		url : 'lib/controller.php',
		data : {
			'action' : 'holeAlleArtikel'
		},
		dataType : 'jsonp',
		success : function(json){
			
		},
		error : function (json) {
        
		}
	});
}