function getArticleList() {
    jQuery.ajax({
        type : 'POST',
        url : 'Controler.php', 
        data : {search : ''},
        dataType : 'jsonp',
        success : function (json) {
            
        },
        error : function (json) {
        
        }
    });
}

function login() {
    
}