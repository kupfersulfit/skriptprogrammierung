<div id="search_container">
    <input type="text" value="" id="search" onkeyup="search();" onblur="search();" /><input type="button" id="searchButton" value="search" onclick="search();"/>
    <br />
    <input type="checkbox" id="nameSearch" checked="checked" />
    <label for="nameSearch">name</label>
    <input type="checkbox" id="categorySearch" checked="checked" />
    <label for="categorySearch">category</label>
    <input type="checkbox" id="descriptionSerch" checked="checked" />
    <label for="descriptionSerch">description</label>
    <div id="suggestions"></div>
</div>
<section id="articleList">    
</section>
