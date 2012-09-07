Article = function() {
        
    this.beschreibung    = 'Eine Beschreibung liegt leider nicht vor. bla bla';
    this.bildpfad        = 'default.png';
    this.id              = '';
    this.kategoryId      = '';
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
    this.kategoryId      = json['kategoryId'];
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

Article.prototype.renderHTML = function() {
    var date = this.seit.split(' ')[0];
    date     = date.split('-');
    date     = date[2] + '.' + date[1] + '.' + date[0];
    
    var strHTML = '<section id="article'+ this.id +'" class="arcticle" >';
    strHTML +=      '<div class="articleTitel" title="' + this.name + '">' + Article.cutTitle(this.name) + '</div><div class="' + (this.verfuegbar == '1' ? "pin" : 'nopin') + '" ' + (this.verfuegbar == '1' ? 'onclick="Article.pin(this, '+  this.id+');"' : '') + ' ></div>';
    strHTML +=      '<div class="clear"></div>';
    strHTML +=      '<div class="articleContent">';
    strHTML +=          '<div class="articleImg"><img src="media/products/'+ this.bildpfad +'" width="300" height="300" /></div>';
    strHTML +=          '<p class="articleTags">details</p>';
    strHTML +=          '<div class="articleDetails"><ul>'; 
    strHTML +=              '<li>price <span class="articleValues">' + this.preis.replace('.', ',') + ' &euro;</span></li>';
    strHTML +=              '<li>category <span class="articleValues">' + this.kategoryId + '</span></li>';
    strHTML +=              '<li>published since <span class="articleValues">' + date + '</span></li>';
    strHTML +=              '<li>in stock <div class="' + (this.verfuegbar == '1' ? 'in' : 'out') + '" title="' + (this.verfuegbar == '1' ? 'available' : 'sold') + '">&nbsp;</div></li>';
    strHTML +=          '</ul></div>';
    strHTML +=          '<p class="articleTags">description</p>';
    strHTML +=          '<div class="articleDescription" '+ Article.cutDescription(this.beschreibung) +'</div>';
    strHTML +=      '</div>'
    strHTML += '</section>';
    
    return strHTML;
}

Article.cutTitle = function(title) {
    if (title != null) {
        if ( title.length > 24) {
            return title.substring(0,21) + '...';
        } else {
            return title;
        }
    }
    return 'undefined';
}

Article.cutDescription = function(description) {
    if (description != null) {
        if ( description.length > 37) {
            return 'description="' + description + '" onmouseover="Article.longdescription(this);" onmouseout="Article.longdescription(this);" >' + description.substring(0,34) + '...';
        } else {
            return '>' + description;
        }
    }
    
    return 'undefined';
}

Article.longdescription = function (obj) {
    var description1 = obj.getAttribute('description');
    var description2 = obj.innerHTML;
    obj.setAttribute('description', description2);
    obj.innerHTML = description1;
    if (description1 > description2) {
        jQuery(obj).addClass('shadowedDescription');
    } else {
        jQuery(obj).removeClass('shadowedDescription');
    }
}

Article.pin = function(obj, id) {
    var article = Article.findArticleById(id);
    
    if (jQuery(obj).css('background-position') == '0px 0px') {
        jQuery(obj).css('background-position','0px 40px');
        ShopingCard.addArticle(article);
        modifyShopping_cart();
        if (article) {
            article.addToCard();
        }
    } else {
        ShopingCard.removeArticle(id);
        jQuery(obj).css('background-position','0 0');
        Article.removeFromCard(id);
        modifyShopping_cart();
    }
}

Article.prototype.addToCard = function() {
    var strHTML = '<section class="articleAtCard" id="articleAtCard' + this.id + '">';
    strHTML    +=     '<div class="articleAtCardTitle" title="' + this.name + '">' + Article.cutTitle(this.name) + '</div>';     
    strHTML    +=     '<div class="articleAtCardPrice">price <span>' + this.preis.replace('.', '.') + '</span> &euro;</div>';
    strHTML    +=     '<div class="articleAtCardAmount"><div class="amountElements"><div class="amountSelect">+</div><div class="amountSelect">-</div></div><input type="number" value="1" size="4" disabled="disbled" /></div>'; 
    strHTML    +=     '<div class="clear"></div>';
    strHTML    += '</section>'
    jQuery('#basket').append(strHTML);
}

Article.removeFromCard = function(id) {
    jQuery('#articleAtCard' + id).detach();
}