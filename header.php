<?php
session_start();
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crypto Watcher</title>
    <script !src="">
    var serverName = '<?= SERVER_NAME ?>';
    </script>
    <link rel="stylesheet" href="<?= SERVER_NAME?>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= SERVER_NAME?>semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous">
    </script>
    <script src="<?= SERVER_NAME?>semantic/dist/semantic.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="<?= SERVER_NAME?>js/script.js"></script>
    <script src="<?= SERVER_NAME?>js/repeater.js"></script>

</head>

<body>
    <div id="header" class="header">
        <div class="ui stackable two column centered grid">
            <div style="padding: 0px; font-size:0.8rem" class="five column centered row">
                <div class="center aligned column marketcap">
                    Market Cap: $0
                </div>
                <div class="center aligned column marketvol">
                    24h Vol: $0
                </div>
                <div class="center aligned column dominance">
                    BTC Dominance: 0%
                </div>
            </div>
            <div style='padding-top: 5px;' class="column">
                <div class="ui stackable menu">
                    <div class="item">
                        <img src="<?= SERVER_NAME?>img/logo.png" />
                    </div>
                    <a id="homeButton" class="item">Home</a>
                    <?if (!isset($_SESSION['id'])) :?>
                    <div class="right menu">
                        <a class="item">
                            <div class="ui small buttons">
                                <button id="signUpButton" class="ui teal button">Register</button>
                                <div class="or"></div>
                                <button id="signInButton" class="ui teal button">Login</button>
                            </div>
                        </a>
                        <? elseif (isset($_SESSION['id'])) : ?>
                        <a id="portfolioButton" class="item">My Portfolio</a>
                        <div class="right menu">
                            <a id="adminButton" class="item">Admin Panel</a>
                            <a id="myAccountButton" class="item">My Account</a>
                            <a id="logoutButton" class="item">Logout</a>
                        </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>