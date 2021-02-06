<?
include 'dbc.inc.php';
include 'functions.inc.php';


$fiat_usd = $fiat_eur = $fiat_cny = $usd_1h = $eur_1h = $cny_1h = $usd_24h = $eur_24h = $cny_24h = $usd_7d = $eur_7d = $cny_7d = $btc_volume = $usd_volume = $eur_volume = $cny_volume = $dominance = $btc_marketcap = $usd_marketcap = $eur_marketcap = $cny_marketcap = 0;


$fiat = 'USD';


#if session

if (isset($_POST['fiat'])) {
    $fiat = $_POST['fiat'];
}


$sql = 'SELECT * FROM btc_fiat';
$stmt = $conn->stmt_init();
if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}
$stmt->execute();
$result = $stmt->get_result(); 


while ($row = $result->fetch_assoc()) {
    $fiat_usd = $row['price_usd'];
    $fiat_eur = $row['price_eur'];
    $fiat_cny = $row['price_cny'];
    $usd_1h = $row['1h_usd'];
    $eur_1h = $row['1h_eur'];
    $cny_1h = $row['1h_cny'];
    $usd_24h = $row['24h_usd'];
    $eur_24h = $row['24h_eur'];
    $cny_24h = $row['24h_cny'];
    $usd_7d = $row['7d_usd'];
    $eur_7d = $row['7d_eur'];
    $cny_7d = $row['7d_cny'];
}

$stmt->close();

$sql = 'SELECT * FROM global_metrics';
$stmt = $conn->stmt_init();
if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}
$stmt->execute();
$result = $stmt->get_result(); 


while ($row = $result->fetch_assoc()) {
    $btc_marketcap = $row['btc_marketcap'];
    $btc_volume = $row['btc_volume'];
    $dominance = $row['dominance'];
    $usd_marketcap = $row['usd_marketcap'];
    $usd_volume = $row['usd_volume'];
    $eur_marketcap = $row['eur_marketcap'];
    $eur_volume = $row['eur_volume'];
    $cny_marketcap = $row['cny_marketcap'];
    $cny_volume = $row['cny_volume'];
}

$stmt->close();

$sql = 'SELECT * FROM coins ORDER BY market_cap DESC';
$stmt = $conn->stmt_init();
if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}
$stmt->execute();
$result = $stmt->get_result(); ?>

<table id="mainTable" class="ui celled table">
    <thead class='mobile hidden'>
        <tr>
            <th style="text-align: center">Rank</th>
            <th>
                <div class="ui grid">
                    <div class="row" style="margin-left: 0px">
                        <div class="three wide column">Logo</div>
                        <div class="eight wide column" style="text-align: center">Name</div>
                        <div class="five wide column" style="text-align: center">Symbol</div>
                    </div>
                </div>
            </th>
            <th style="text-align: center">Price</th>
            <th style="text-align: center">Market Cap</th>
            <th style="text-align: center">Volume (24h)</th>
            <th style="text-align: center">Circulating Supply</th>
            <th style="text-align: center">1h <i class="sort icon"></i></th>
            <th style="text-align: center">24h <i class="sort icon"></i></th>
            <th style="text-align: center">7d <i class="sort icon"></i></th>
        </tr>
    </thead>
    <tbody>
        <? while ($row = $result->fetch_assoc()) : ?>

        <tr>
            <td style="text-align: center">
                <?= $row['rank'] ?>
            </td>
            <td>
                <div class="ui grid">
                    <div class="row" style="margin-left: 0px;">
                        <div class="three wide column">
                            <img src="https://s2.coinmarketcap.com/static/img/coins/32x32/<?= $row['id'] ?>.png"
                                class="ui mini rounded image" />
                        </div>
                        <div class="eight wide column middle aligned" style="text-align: center">
                            <div class="content coin">
                                <?= $row['name'] ?>
                            </div>
                        </div>
                        <div class="five wide column middle aligned" style="text-align: center">
                            <div class="sub header content coin">(
                                <?= $row['symbol'] ?> )
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td style="text-align: center">
                <?= GetPrice($row['btc_price']) ?>
            </td>
            <td style="text-align: center">
                <?= GetPrice($row['market_cap']) ?>
            </td>
            <td style="text-align: center">
                <?= GetPrice($row['volume_24h']) ?>
            </td>
            <td style="text-align: center">
                <?= number_format($row['circulating_supply']) . ' ' . $row['symbol'] ?>
            </td>
            <td <? if ($row['symbol']=='BTC' ) { $perc_1h=GetPerc('1h'); } else {$perc_1h=$row['percent_change_1h']; }
                ?>
                style="text-align: center; color: <?= GetColor(number_format($perc_1h, 2, '.', '')) ?>">
                <?= number_format($perc_1h, 2, '.', '')?>%
            </td>
            <td <? if ($row['symbol']=='BTC' ) { $perc_24h=GetPerc('24h'); } else {$perc_24h=$row['percent_change_24h'];
                } ?>
                style="text-align: center;
                color:<?= GetColor(number_format($perc_24h, 2, '.', '')) ?>">
                <?= number_format($perc_24h, 2, '.', '')?>%
            </td>
            <td <? if ($row['symbol']=='BTC' ) { $perc_7d=GetPerc('7d'); } else {$perc_7d=$row['percent_change_7d']; }
                ?>
                style="text-align: center; color:<?= GetColor(number_format($perc_7d, 2, '.', '')) ?>">
                <?= number_format($perc_7d, 2, '.', '') ?>%
            </td>
        </tr>
        <? endwhile;
                        $stmt->close();
                        ?>
    </tbody>
</table>

<script>
$(".marketcap").html("<?= GetMarketCap() ?>");
$(".dominance").html("<?= 'BTC Dominance: ' . number_format($dominance, 2, '.', '') . '%' ?>");
$(".marketvol").html("<?= GetMarketVolume() ?>");
</script>