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

Article.prototype.create = function(json) {
    if (json['beschreibung'] != 'null' 
        && json['beschreibung'] != null 
        && json['beschreibung'] == '') {
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
    this.veroeffentlicht = json['verfuegbar'];
}

Article.prototype.renderHTML = function() {
    var date = this.seit.split(' ')[0];
    date     = date.split('-');
    date     = date[2] + '.' + date[1] + '.' + date[0];
    
    var strHTML = '<section id="article'+ this.id +'" class="arcticle" >';
    strHTML +=      '<div class="articleTitel" title="' + this.name + '">' + Article.cutTitle(this.name) + '</div><div class="pin" >&nbsp;</div>';
    strHTML +=      '<div class="clear"></div>';
    strHTML +=      '<div class="articleContent">';
    strHTML +=          '<div class="articleImg"><img src="media/products/'+ this.bildpfad +'" width="300" height="300" /></div>';
    strHTML +=          '<p class="articleTags">details</p>';
    strHTML +=          '<div class="articleDetails"><ul>'; 
    strHTML +=              '<li>price <span class="articleValues">' + this.preis.replace('.', ',') + ' &euro;</span></li>';
    strHTML +=              '<li>category <span class="articleValues">' + this.kategoryId + '</span></li>';
    strHTML +=              '<li>published since <span class="articleValues">' + date + '</span></li>';
    strHTML +=              '<li>in stock <div class="' + (this.verfuegbar ? 'in' : 'out') + '" title="' + (this.verfuegbar ? 'available' : 'sold') + '">&nbsp;</div></li>';
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
}

Article.cutDescription = function(description) {
    if (description != null) {
        if ( description.length > 45) {
            return 'description="' + description + '" onmouseover="Article.longdescription(this);" onmouseout="Article.longdescription(this);" >' + description.substring(0,42) + '...';
        } else {
            return '>' + description;
        }
    }
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