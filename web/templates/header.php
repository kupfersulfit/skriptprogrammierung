<doctype html>
    <html>
        <head>
            <title>st@pleware</title>
            <link type="text/css" rel="stylesheet" href="css/style_main.css" />
            <link type="text/css" rel="stylesheet" href="css/style_article_overview.css" />
            <script type="text/javascript" src="js/jquery-1.8.0.min.js" ></script>
            <script type="text/javascript" src="js/main.js" ></script>
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
                    </ul>
                </nav>
                <div class="clear"></div>
                <div id="container">
                    <div id="loginContainer" >
                        <p><label for="email" >email</label><input type="text" id="email" name="email"/></p>
                        <p><label for="password" >password</label><input type="password" id="password" name="password"/></p>
                        <p><input type="button" id="loginButton" value="login"/></p>
                    </div>
                    <div id="register_login"><a id="registerLink">register</a></div>
                    <div id="registerContainer">
                        <p><label for="email" >surname</label></p>
                        <p><input type="text" id="surname" name="surname"/></p>
                        <p><label for="email" >givenname</label></p>
                        <p><input type="text" id="givenname" name="givenname"/></p>
                        <p><label for="email" >street</label></p>
                        <p><input type="text" id="street" name="street"/><input type="text" id="nr" name="nr" size="4"/></p>
                        <p><label for="zip" >zip</label></p>
                        <p><input type="text" id="zip" name="zip"/></p>
                        <p><label for="registerEmail" >email</label></p>
                        <p><input type="text" id="registerEmail" name="registerEmail"/></p>
                        <p><label for="validEmail" >email validation</label></p>
                        <p><input type="text" id="validEmail" name="validEmail"/></p>
                        <p><label for="registerPassword" >password</label></p>
                        <p><input type="text" id="registerPassword" name="registerPassword"/></p>
                        <p><label for="validPassword" >password validation</label></p>
                        <p><input type="text" id="validPassword" name="validPassword"/></p>
                        <p><label for="edition" >edition</label></p>
                        <p><textarea id="edition"></textarea></p>
                        <p><input id="registerButton" type="button" value="register" /></p>
                    </div>
                </div>
            </header>