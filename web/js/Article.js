Article = function() {
        
    this.beschreibung    = 'Eine Beschreibung liegt leider nicht vor. bla bla';
    this.bildpfad        = 'default.png';
    this.id              = '';
    this.kategorieid      = '';
    this.name            = '';
    this.preis           = '';
    this.seit            = '';
    this.verfuegbar      = '';
    this.veroeffentlicht = '1';
}

Article.Instances = new Array();
    
Article.prototype.classname = 'Article';

Article.prototype.create = function(json) {
    if (json['beschreibung'] != 'null' 
        && json['beschreibung'] != null 
        && json['beschreibung'] != '') {
        this.beschreibung = json['beschreibung'];
    }
    
    if (json['bildpfad'] != 'null' 
        && json['bildpfad'] != null 
        && json['bildpfad'] != '') {
        this.bildpfad = json['bildpfad'];
    }
    
    this.id              = json['id'];
    this.kategorieid      = json['kategorieid'];
    this.name            = json['name'];
    this.preis           = json['preis'];
    this.seit            = json['seit'];
    this.verfuegbar      = json['verfuegbar'];
    this.veroeffentlicht = json['veroeffentlicht'];
    
    Article.Instances.push(this);
}

Article.findArticleById = function(id) {
    for (var i = 0; i < Article.Instances.length; ++i) {
        if (Article.Instances[i].id == id) {
            return Article.Instances[i];
        }
    }
    return false;
}

Article.findArticleByName = function(name) {
    for (var i = 0; i < Article.Instances.length; ++i) {
        if (Article.Instances[i].name == name) {
            return Article.Instances[i];
        }
    }
    return false;
}

Article.findForSearch = function(search) {
    var matches = new Array();
    var checkedOptions = jQuery('#search_container input:checkbox');
    search = search.toLowerCase().replace(/([.*+?|(){}[\]\\])/g, "\\$&");
        
    for (var i = 0; i < Article.Instances.length; ++i) {
        if ((checkedOptions[0].checked && Article.Instances[i].name.toLowerCase().match(search))
            || (checkedOptions[1].checked && Article.Instances[i].kategorieid.toLowerCase().match(search))
            || (checkedOptions[2].checked && Article.Instances[i].beschreibung.toLowerCase().match(search))
            ) {
            matches.push(Article.Instances[i]);
        }
    }
    if (matches.length > 0) {
        return matches;
    } else {
        return false;
    }
}

Article.prototype.renderHTML = function() {
    var date = formatDate(this.seit);
    
    var strHTML = '<section id="article'+ this.id +'" class="article" >';
    strHTML +=      '<div class="articleTitel" title="' + this.name + '">' + Article.cutTitle(this.name, 70) + '</div><div class="' + (this.verfuegbar > 0 ? "pin" : 'nopin') + '" ' + (this.verfuegbar > 0 ? 'onclick="Article.pin(this, '+  this.id+', false);"' : '') + ' ></div>';
    strHTML +=      '<div class="clear"></div>';
    strHTML +=      '<div class="articleContent">';
    strHTML +=          '<div class="articleImg"><img src="media/products/'+ this.bildpfad +'" width="300" height="300" /></div>';
    strHTML +=          '<p class="articleTags">details</p>';
    strHTML +=          '<div class="articleDetails"><ul>'; 
    strHTML +=              '<li>price <span class="articleValues">' + this.preis + ' &euro;</span></li>';
    strHTML +=              '<li>category <span class="articleValues">' + this.kategorieid + '</span></li>';
    strHTML +=              '<li>published since <span class="articleValues">' + date + '</span></li>';
    strHTML +=              '<li>in stock (' + this.verfuegbar + ') <div class="' + (this.verfuegbar > 0 ? 'in' : 'out') + '" title="' + (this.verfuegbar > 0 ? 'available' : 'sold') + '">&nbsp;</div></li>';
    strHTML +=          '</ul></div>';
    strHTML +=          '<p class="articleTags">description</p>';
    strHTML +=          '<div class="articleDescription" '+ Article.cutDescription(this.beschreibung, this.id) +'</div>';
    strHTML +=      '</div>'
    strHTML += '</section>';
    
    return strHTML;
}

Article.cutTitle = function(title, length) {
    if (title != null) {
        if ( title.length > length) {
            return title.substring(0,(length-3)) + '...';
        } else {
            return title;
        }
    }
    return 'undefined';
}

Article.cutDescription = function(description, id) {
    if (description != null) {
        if ( description.length > 170) {
            return 'description="' + description + '" onmouseover="Article.longdescription(this, ' + id + ');" onmouseout="Article.longdescription(this, ' + id + ');" >' + description.substring(0,167) + '...';     
            
        } else {
            return '>' + description;
        }
    }
    
    return 'undefined';
}

Article.longdescription = function (obj, id) {
    var description1 = obj.getAttribute('description');
    var description2 = obj.innerHTML;

    obj.setAttribute('description', description2);
    obj.innerHTML = description1;
    
    var newHeight = parseInt(jQuery(obj).css('height'))-143;
    var oldHeight = 361;
    
    if (description1.length > description2.length) {
        jQuery('#article' + id).css('height',(oldHeight + newHeight));
    } else if (description1.length < description2.length){
        jQuery('#article' + id).css('height', oldHeight);
    }
}

Article.pin = function(obj, id, session) {
    var article = Article.findArticleById(id);
    
    if (jQuery(obj).css('background-position') == '0px 0px') {
        jQuery(obj).css('background-position','0px 40px');
        ShopingCard.addArticle(article);
        if (article) {
            article.addToCard();
        }
    } else {
        jQuery(obj).css('background-position','0 0');
        Article.removeFromCard(id);
    }
    
    ShopingCard.callbackTotalPrice();
    
    if (!session) {
        modifyShoping_cart();
    }
}

Article.prototype.addToCard = function() {
    var strHTML = '<section class="articleAtCard" id="articleAtCard' + this.id + '">';
    strHTML    +=     '<div class="articleAtCardTitle" title="' + this.name + '">' + Article.cutTitle(this.name, 30) + '</div><div class="articleAtCardClose" onclick="Article.pin(jQuery(\'#article' +  this.id + ' .pin\'), ' + this.id + ', false);">x</div>';
    strHTML    +=     '<div class="clear"></div>'
    strHTML    +=     '<div class="articleAtCardPrice"><div>price </div><div class="euro"> &euro;</div><span>' + this.preis.replace('.', '.') + '</span></div>';
    strHTML    +=     '<div class="articleAtCardAmount">';
    strHTML    +=         '<div class="amountElements">';
    strHTML    +=              '<div class="amountSelect" onclick="Article.increseAmount(' + this.id + ', false);" >+</div>';
    strHTML    +=              '<div class="amountSelect" onclick="Article.decreseAmount(' + this.id + ');">-</div>';
    strHTML    +=         '</div>';
    strHTML    +=         '<input type="text" value="1" size="4" disabled="disbled" />';
    strHTML    +=     '</div>'; 
    strHTML    +=     '<div class="clear"></div>';
    strHTML    += '</section>'
    jQuery('#basket').append(strHTML);
}

Article.removeFromCard = function(id) {
    ShopingCard.removeArticle(id);
    jQuery('#articleAtCard' + id).detach();
}

Article.increseAmount = function(id, session) {
    var amount = jQuery('#articleAtCard' + id + ' input').val();
    if (parseInt(Article.findArticleById(id).verfuegbar) > amount) {
        ++amount;
        jQuery('#articleAtCard' + id + ' input').val(amount);
        ShopingCard.getArticle(id).verfuegbar = amount;
        Article.calculatePrice(id, amount);
        if (!session) {
            modifyShoping_cart();
        }
    } else {
        systemessages({
            "error":"sorry not enought " + Article.cutTitle(Article.findArticleById(id).name, 30) + " in stock"
        });
    }
}

Article.decreseAmount = function(id) {
    var amount = jQuery('#articleAtCard' + id + ' input').val();
    if (amount > 1) {
        --amount;
        jQuery('#articleAtCard' + id + ' input').val(amount);
        ShopingCard.getArticle(id).verfuegbar = amount;
        Article.calculatePrice(id, amount);
        modifyShoping_cart();
    }  
}

Article.calculatePrice = function(id, amount) {
    
    var priceSpan  = jQuery('#articleAtCard' + id + ' .articleAtCardPrice span'); 
    var price = Article.findArticleById(id).preis * amount;
    price = price.toFixed(2) + '';
    if (!price.match(/[0-9]{1,}\.[0-9]{2}/)) {
        price += '.00';
    }
    priceSpan.html(price);
    ShopingCard.callbackTotalPrice();
}

Article.prototype.getJSONstring = function() {
    var JSONstr = '{';
    for (var key in this) { 
        if (typeof this[key] != 'function' && typeof this[key] != 'object') {
            JSONstr += '"' + key + '":"' + this[key] + '",';
        }
    }
    JSONstr = JSONstr.substring(0, (JSONstr.length -1));
    JSONstr += '}';
    return JSONstr;
}

Article.prototype.createtemporyIntance = function(id, name, kategorieid, beschreibung, preis, seit, verfuegbar, veroeffentlicht, bildpfad) {
    this.id              = id;
    this.name            = name;
    this.kategorieid      = kategorieid;
    this.beschreibung    = beschreibung;
    this.preis           = preis;
    this.seit            = seit;
    this.verfuegbar      = verfuegbar;
    this.veroeffentlicht = veroeffentlicht;
    this.bildpfad        = bildpfad;
}