<?php include 'header.php';?>

<div id="loginFormGrid" class="ui middle aligned center aligned grid">
    <div id="loginFormColumn" class="column">
        <h2 class="ui teal image header">
            <img src="<?= SERVER_NAME?>img/logo.png" class="image">
            <div class="content">
                Create a new account
            </div>
        </h2>
        <form class="ui large form" action='includes/register.inc.php' method='POST'>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="firstName" placeholder="First Name">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="lastName" placeholder="Last Name">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="address card outline icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="passwordRepeat" placeholder="Repeat Password">
                    </div>
                </div>
                <button name="registerSubmit" type='submit' class="ui fluid large teal submit button">Register</button>
            </div>

            <div class="ui error message"></div>

        </form>

        <div class="ui message">
            Already Registered? <a href="login.php">Login</a>
        </div>
    </div>
</div>

<?php include 'footer.php';?>