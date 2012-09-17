var ShoppingCart = {
    price : 0,
    articles : new Array(),
    className : 'ShoppingCart',
    
    addArticle : function(article) {
        this.articles.push({
            'id' : article.id, 
            'verfuegbar' : 1,
            'price' : article.preis 
        });
    },
    
    removeArticle : function(id) {
        var index = this.findArticle(id);
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
    },
    
    callbackTotalPrice : function() {
        var price = 0;
        for (var i = 0; i < ShoppingCart.articles.length; ++i) {
            price += ShoppingCart.articles[i].verfuegbar * ShoppingCart.articles[i].price;
        }
        
        ShoppingCart.price = price.toFixed(2);
        
        price += '';
        if (!price.match(/[0-9]{1,}\.[0-9]{2}/)) {
            price += '.00';
        }
        
        jQuery('#shopping_cart_price span').html(price);
    }
}