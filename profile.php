<?php include 'header.php';?>

<article>
    <div class="ui two column centered grid">
        <div class="row">
            <div class="column">
                <h1 class="ui header">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    Profile Settings
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div>
                    <h3 class="ui header">Profile Information</h3>
                    <table class="ui unstackable table">
                        <tbody>
                            <tr>
                                <td>Username</td>
                                <td>JohnDoe</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>JohnDoe@gmail.com
                                    <a href="#">change</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Credit Card</td>
                                <td>XXXX-XXXX-XXXX-XXX
                                    <a href="#">change</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h3 class="ui header">Other Options</h3>
                <div class="ui menu">
                    <div class="item">
                        <div class="ui positive basic button">Deposit</div>
                    </div>
                    <div class="item">
                        <div class="ui negative basic button">Withdraw</div>
                    </div>
                    <div class="item">
                        <div class="ui secondary basic button">Request Report</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h3 class="ui header">Destructive Changes</h3>
                <div class="ui menu">
                    <div class="item">
                        <div class="ui negative basic button">Delete Account</div>
                    </div>
                    <div class="item">
                        <div class="ui negative basic button">Disable Account</div>
                    </div>
                    <div class="item">
                        <div class="ui negative basic button">Change Profile Visibility</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>


<?php include 'footer.php';?>