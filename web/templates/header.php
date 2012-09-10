<doctype html>
    <html>
        <head>
            <title>st@pleware</title>
            <link type="text/css" rel="stylesheet" href="css/style_main.css" />
            <link type="text/css" rel="stylesheet" href="css/style_article_overview.css" />
            <link href="fav.ico" rel="shortcut icon">
            <script type="text/javascript" src="js/jquery-1.8.0.min.js" ></script>
            <script type="text/javascript" src="js/main.js" ></script>
            <script type="text/javascript" src="js/ajax.js" ></script>
            <script type="text/javascript" src="js/ready.js" ></script>
            <script type="text/javascript" src="js/Article.js" ></script>
            <script type="text/javascript" src="js/ShopingCard.js" ></script>
            <script type="text/javascript" src="js/Customer.js" ></script>
        </head>
        <body>
            <header>
                <nav id="menu">
                    <ul>
                        <li id="loginTab">
                            <img id="log" src="media/log.png" height="70" width="100" />
                        </li>
                        <li id="profileTab">
                            <img id="profile" src="media/profile.png" height="70" width="100" />
                        </li>
                        <li id="homeTab" class="active">
                            <img id="home" src="media/home.png" height="70" width="100" />
                        </li>
                        <?php
                        if (TRUE) {//Admin
                            ?>
                            <li id="adminTab">
                                <img id="admin" src="media/admin.png" height="70" width="100" />
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
                <div class="clear"></div>
                <div id="container">
                    <div id="loginContainer" >
                        <p><label for="email" >email</label><input type="text" id="email" name="email" autocomplete="off"/></p>
                        <p><label for="password" >password</label><input type="password" id="password" name="password" autocomplete="off"/></p>
                        <p><input type="button" id="loginButton" value="login"/></p>
                    </div>
                    <div id="register_login"><a id="registerLink">register</a></div>
                    <div id="registerContainer">
                        <p><label for="surname" >surname</label></p>
                        <p><input type="text" id="surname" name="surname"/></p>
                        <p><label for="givenname" >givenname</label></p>
                        <p><input type="text" id="givenname" name="givenname"/></p>
                        <p><label for="street" >street</label></p>
                        <p><input type="text" id="street" name="street"/><input type="text" id="nr" name="nr" size="4"/></p>
                        <p><label for="zip" >zip</label></p>
                        <p><input type="text" id="zip" name="zip"/></p>
                        <p><label for="registerEmail" >email</label></p>
                        <p><input type="text" id="registerEmail" name="registerEmail"/></p>
                        <p><label for="validEmail" >email validation</label></p>
                        <p><input type="text" id="validEmail" name="validEmail"/></p>
                        <p><label for="registerPassword" >password</label></p>
                        <p><input type="password" id="registerPassword" name="registerPassword" onkeyup="Customer.passwordStrength();" /></p>
                        <p><label for="validPassword" >password validation</label></p>
                        <p><input type="password" id="validPassword" name="validPassword"/></p>
                        <p><label for="addition" >addition</label></p>
                        <p><textarea id="addition"></textarea></p>
                        <p><input id="registerButton" type="button" value="register" onclick="Customer.register();" /></p>
                    </div>
                </div>
            </header>