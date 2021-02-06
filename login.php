<?php include 'header.php';?>



<div id='loginFormGrid' class='ui middle aligned center aligned grid'>
    <div id='loginFormColumn' class='column'>
        <h2 class='ui teal image header'>
            <img src='<?= SERVER_NAME?>img/logo.png' class='image'>
            <div class='content'>
                Login to your account
            </div>
        </h2>
        <form class='ui large form' action='includes/loginauthentication.inc.php' method='post'>
            <div class='ui stacked segment'>
                <div class='field'>
                    <div class='ui left icon input'>
                        <i class='user icon'></i>
                        <input type='text' name='email' placeholder='E-mail address'>
                    </div>
                </div>
                <div class='field'>
                    <div class='ui left icon input'>
                        <i class='lock icon'></i>
                        <input type='password' name='password' placeholder='Password'>
                    </div>
                </div>
                <button class='ui fluid large teal submit button' type='submit' name='loginSubmit'>Login</button>
            </div>

            <div class='ui error message'>
                <ul class='list'>
                    <li>Please enter a valid e-mail</li>
                    <li>Your password must be at least 6 characters</li>
                </ul>
            </div>

        </form>

        <div class='ui message'>
            New ? <a href='register.php'>Register</a>
        </div>
    </div>
</div>

<?php include 'footer.php';?>