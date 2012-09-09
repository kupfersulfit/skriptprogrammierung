var ShopingCard = {
    articles : new Array(),    
    addArticle : function(article) {
        this.articles.push({
            'id' : article.id, 
            'verfuegbar': 1
        });
    },
    removeArticle : function(id) {
        var index = this.findArticle(id);
        delete this.articles[index];
        var tmp = new Array();
        
        for (var i = 0; i < this.articles.length; ++i) {
            if (i != index) {
                tmp.push(this.articles[i]);
            }
        }
        this.articles = tmp;
    },
    findArticle : function(id) {
        for (var i = 0; i < this.articles.length; ++i) {
            if (typeof this.articles[i] != 'undefined') {
                if (this.articles[i].id == id) {
                    return i;
                }
            }
        }
        return -1;
    },
    getArticle : function (id) {
        return this.articles[this.findArticle(id)];
    },
    getArticlesJSONstring : function () {
        var jsonStr = '[';
        
        for (var i = 0; i < this.articles.length; ++i) {
            if (typeof this.articles[i] != 'undefined') {
                jsonStr += '{"id":' + this.articles[i].id + ', "verfuegbar":"' + this.articles[i].verfuegbar + '"}';
                if (i != this.articles.length - 1) {
                    jsonStr += ', ';
                }
            }
        }
        
        jsonStr += ']';
        return jsonStr;
    }
    
}