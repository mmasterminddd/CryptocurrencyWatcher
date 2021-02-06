<?php
include 'header.php';
include 'includes/dbc.inc.php';
if (isset($_SESSION['id'])) : ?>
<article>

    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui header">
                <i class="fas fa-user" aria-hidden="true"></i>
                Profile Settings
            </h1>
            <div class="ui center aligned raised segment">
                <h3 class="ui center aligned block header">
                    Profile Information
                </h3>
                <div>
                    <form id="basic_data_form" method="post" action="includes/myaccount.inc.php">
                        <table class="ui unstackable table">
                            <tbody class="ui center aligned">
                                <tr>
                                    <td width="50%">Email</td>
                                    <td name="edit_email" class="edit_email"><?= $_SESSION['email'];?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td name="edit_first" class="edit_first"><?= $_SESSION['firstname'];?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td name="edit_last" class="edit_last"><?= $_SESSION['lastname'];?></td>
                                </tr>

                            </tbody>

                        </table>
                        <input type="button" style="display: inline;"
                            class="tiny ui teal basic button edit_basic_button" value="Edit" />
                        <input name="submit_basic_edit" type="submit" style="display: none;"
                            class="tiny ui teal basic button save_basic_button" value="Save" />
                    </form>
                </div>

                <h3 class="ui center aligned block header">
                    Password
                </h3>
                <div style="display: none;" class="password_table">
                    <form id="password_data_form" method="post" action="includes/myaccount.inc.php">
                        <table class="ui unstackable table">
                            <tbody class="ui center aligned">
                                <tr>
                                    <td width="50%">Password</td>
                                    <td>
                                        <div class="mini ui input">
                                            <input name="password" type="password"></input>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password</td>
                                    <td>
                                        <div class="mini ui input">
                                            <input name="password_repeat" type="password"></input>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br>
                </div>

                <div>
                    <input type="button" style="display: inline;" class="tiny ui teal basic button edit_password_button"
                        value="Change Password" />
                    <input name="submit_password_edit" type="submit" style="display: none;"
                        class="tiny ui teal basic button save_password_button" value="Save" />
                    </form>
                    <? if (isset($_GET['error'])) :
                        if ($_GET['error'] == 'nomatch') : ?>
                    <br>
                    <div class="mini ui negative compact message">
                        <div class="header">
                            Error
                        </div>
                        <p>Passwords don't match</p>
                    </div>
                    <? endif; ?>
                    <? endif; ?>
                </div>

                <h3 class="ui center aligned block header">
                    Other Options
                </h3>
                <div>
                    <table class="ui unstackable table">
                        <tbody class="ui center aligned">
                            <tr>
                                <td width="33%">
                                    <form method="post" action="includes/myaccount.inc.php">
                                        <input name="delete_account" type="submit" class="ui teal basic button"
                                            value="Delete Account" />
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="includes/myaccount.inc.php">
                                        <input name="freeze_account" type="submit" class="ui teal basic button"
                                            value="Freeze Account" />
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="includes/myaccount.inc.php">
                                        <input name="wipe_portfolio" type="submit" class="ui teal basic button"
                                            value="Wipe Portfolio" />
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <? if (isset($_GET['success'])) :
                        if ($_GET['success'] == 'portfoliowiped') : ?>
                    <div class="mini ui success compact message">
                        <div class="header">
                            Success
                        </div>
                        <p>Portfolio Wiped!</p>
                    </div>
                    <? endif; ?>
                    <? endif; ?>
                </div>
            </div>
        </div>

    </div>
</article>

<script !src="">
$('.edit_basic_button').on('click', function() {
    $('.edit_basic_button').css({
        'display': 'none'
    });

    $('.save_basic_button').css({
        'display': 'inline'
    });


    var tempText = $('.edit_email').text();
    $('.edit_email').text('');
    $('.edit_email').append("<div class='mini ui input'><input name='email' type='email' value='" + tempText +
        "' placeholder='" +
        tempText +
        "'> </input></div>");

    tempText = $('.edit_first').text();
    $('.edit_first').text('');
    $('.edit_first').append("<div class='mini ui input'><input name='first_name' value='" + tempText +
        "' placeholder='" + tempText +
        "'> </input></div>");

    tempText = $('.edit_last').text();
    $('.edit_last').text('');
    $('.edit_last').append("<div class='mini ui input'><input name='last_name' value='" + tempText +
        "' placeholder='" + tempText +
        "'> </input></div>");

});



$('.edit_password_button').on('click', function() {
    $('.edit_password_button').css({
        'display': 'none'
    });

    $('.save_password_button').css({
        'display': 'inline'
    });

    $('.password_table').css({
        'display': 'inline'
    });
});
</script>


<?
else :
    return header('Location: login.php');
endif;
include 'footer.php';
?>