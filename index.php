    <?php include 'header.php';?>

    <div id="main-containter" class="main-container">
        <div class="ui stackable two column centered grid">
            <div class="five column centered row">
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
                        <input type="hidden" name="gender" />
                        <i class="dropdown icon"></i>
                        <div class="default text">USD</div>
                        <div class="menu">
                            <div class="item" data-value="USD">USD</div>
                            <div class="item" data-value="EUR">EUR</div>
                            <div class="item" data-value="BTC">BTC</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="column">
                <table id="mainTable" class="ui celled table">
                    <thead class='mobile hidden'>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Market Cap</th>
                            <th>Price</th>
                            <th>Volume (24)</th>
                            <th>Circulating Supply</th>
                            <th>24h Change (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>
                                <h4 class="ui image header">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/32x32/1.png"
                                        class="ui mini rounded image" />
                                    <div class="content coin">
                                        Bitcoin
                                        <div class="sub header">BTC</div>
                                    </div>
                                </h4>
                            </td>
                            <td>$170,081,967,188</td>
                            <td>$9,145</td>
                            <td>$15,930,080,405</td>
                            <td>18,420,231 BTC</td>
                            <td>$0.88%</td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>
                                <h4 class="ui image header">
                                    <img src="https://s2.coinmarketcap.com/static/img/coins/32x32/2.png"
                                        class="ui mini rounded image" />
                                    <div class="content coin">
                                        Litecoin
                                        <div class="sub header">LTC</div>
                                    </div>
                                </h4>
                            </td>
                            <td>$170,081,967,188</td>
                            <td>$9,145</td>
                            <td>$15,930,080,405</td>
                            <td>18,420,231 LTC</td>
                            <td>$0.88%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php include 'footer.php';?>