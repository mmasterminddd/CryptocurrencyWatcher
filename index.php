<?php
include 'header.php';?>

<div id="main-containter" class="main-container">
    <div class="ui stackable one column centered grid">
        <div style="padding-bottom: 0px;" class="five column centered row">
            <div class="center aligned column">
                <div class="ui left corner labeled input">
                    <input id="tableSearch" type="text" placeholder="Search..." />
                    <div class="ui left corner label">
                        <i class="asterisk icon"></i>
                    </div>
                </div>
            </div>
            <div class="center aligned column">
                <div class="ui selection dropdown">
                    <input type="hidden" class="fiat" name="fiat" />
                    <i class="dropdown icon"></i>
                    <div class="default text">USD</div>
                    <div class="menu">
                        <div class="item" data-value="USD">USD ($)</div>
                        <div class="item" data-value="EUR">EUR (€)</div>
                        <div class="item" data-value="CNY">CNY (¥)</div>
                        <div class="item" data-value="BTC">BTC (฿)</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-right: 10%; padding-left: 10%" class="column">
            <div class='datadiv'>
                <?include 'includes/data.inc.php';?>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(".fiat").on('change', function postinput() {
            var fiat = $(this).val();

            $.ajax({
                url: 'includes/data.inc.php',
                data: {
                    fiat: fiat
                },
                type: 'post'
            }).done(function(responseData) {
                $(".datadiv").html(responseData);
            }).fail(function() {
                console.log('Failed');
            });
        });
    });
    </script>


    <?php include 'footer.php';?>