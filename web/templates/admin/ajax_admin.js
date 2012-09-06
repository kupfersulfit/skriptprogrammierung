
function getAlleKunden{
	jquery.ajax({
		type : 'POST',
		url : 'lib/controller.php
		data : {
			'action' : 'holeAlleKunden'
		},
		dataType : 'jsonp',
		success : function(json){
			
		},
		error : function (json) {
        
		}
	});
}

function getAlleArtikel{
	jquery.ajax({
		type : 'GET',
		url : 'lib/controller.php
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