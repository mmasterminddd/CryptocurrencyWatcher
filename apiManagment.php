<?php
include 'includes/dbc.inc.php';
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '100',
    'convert' => 'BTC',
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: a23b6575-9f94-4e8b-bea4-708c0f821c2b',
];
$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1,
));

$binance_coins = array("BNB","NULS","NEO ","LINK","IOTA","ETC","KNC","WTC","SNGLS","GAS","SNM","BQX","QTUM","LTC","ETH","ZRX","OMG","1INCH","AAVE","ADA","ADX","AERGO","AGI","AION","AKRO","ALGO","ALPHA","AMB","ANKR","APPC","ARDR","ARK","ARPA","ASR","AST","ATM","ATOM","AUDIO","AVA","AVAX","AXS","BAND","BAT","BCD","BCH","BCPT","BEAM","BEL","BLZ","BNT","BOT","BRD","BTG","BTS","BZRX","CDT","CELO","CELR","CHR","CHZ","CMT","CND","COMP","COS","COTI","CRV","CTK","CTSI","CTXC","CVC","DASH","DATA","DCR","DIA","DLT","DNT","DOCK","DOGE","DOT","DREP","DUSK","EGLD","ELF","ENJ","EOS","EVX","FET","FIL","FIO","FLM","FOR","FTM","FTT","FUN","GLM","GO","GRS","GRT","GTO","GVT","GXS","HARD","HBAR","HIVE","HNT","HOT","ICX","IDEX","INJ","IOST","IOTX","IRIS","JST","JUV","KAVA","KMD","LOOM","LRC","LSK","LTO","LUNA","MANA","MATIC","MBL","MDA","MDT","MITH","MKR","MTH","MTL","NANO","NAS","NAV","NBS","NEAR","NEBL","NKN","NMR","NXS","OAX","OCEAN","OG","OGN","ONE","ONG","ONT","ORN","OST","OXT","PAXG","PERL","PHB","PIVX","PNT","POA","POLY","POWR","PPT","PSG","QKC","QLC","QSP","RCN","RDN","REEF","REN","RENBTC","REP","REQ","RLC","ROSE","RSR","RUNE","RVN","SAND","SC","SCRT","SKL","SKY","SNT","SNX","SOL","SRM","STEEM","STMX","STORJ","STPT","STRAX","STX","SUN","SUSD","SUSHI","SXP","SYS","TCT","TFUEL","THETA","TNB","TOMO","TRB","TROY","TRX","UMA","UNFI","UNI","UTK","VET","VIA","VIB","VIBE","VIDT","VITE","WABI","WAN","WAVES","WBTC","WING","WNXM","WPR","WRX","XEM","XLM","XMR","XRP","XTZ","XVG","XVS","XZC","YFI","YFII","YOYO","ZEC","ZEN","ZIL","DGB","BAL","ANT","KSM");


$response = curl_exec($curl);

$jsonData = json_decode($response, true);

foreach ($jsonData['data'] as $coin) {
    $sql = 'INSERT INTO coins (id, name, symbol, btc_price, rank, circulating_supply, percent_change_1h , percent_change_24h, percent_change_7d ,market_cap ,volume_24h) VALUES (?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->stmt_init();

    // if ((($coin['quote']['BTC']['market_cap'] * 37500) < 25000000) && (($coin['quote']['BTC']['market_cap'] * 34000) > 1000000)){
    //     if (in_array($coin['symbol'], $binance_coins)){
    //         echo $coin['symbol'] . ' ';
    //     }
            
    // }

    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }    
    $stmt->bind_param('issdiidddsi', $coin['id'], $coin['name'], $coin['symbol'], $coin['quote']['BTC']['price'], $coin['cmc_rank'], $coin['circulating_supply'], $coin['quote']['BTC']['percent_change_1h'], $coin['quote']['BTC']['percent_change_24h'], $coin['quote']['BTC']['percent_change_7d'], $coin['quote']['BTC']['market_cap'], $coin['quote']['BTC']['volume_24h']);
    $stmt->execute();
    $stmt->close();
}

curl_close($curl);

$parameters = [
    'start' => '1',
    'limit' => '1',
    'convert' => 'USD',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}";

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1, 
));
$response = curl_exec($curl); 
$jsonData = json_decode($response, true);
$btc_usd =  $jsonData['data'][0]['quote']['USD']['price'];
$usd_1h = $jsonData['data'][0]['quote']['USD']['percent_change_1h'];
$usd_24h = $jsonData['data'][0]['quote']['USD']['percent_change_24h'];
$usd_7d = $jsonData['data'][0]['quote']['USD']['percent_change_7d'];
curl_close($curl);

$parameters = [
    'start' => '1',
    'limit' => '1',
    'convert' => 'EUR',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}";

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1, 
));
$response = curl_exec($curl); 
$jsonData = json_decode($response, true);
$btc_eur =  $jsonData['data'][0]['quote']['EUR']['price'];
$eur_1h = $jsonData['data'][0]['quote']['EUR']['percent_change_1h'];
$eur_24h = $jsonData['data'][0]['quote']['EUR']['percent_change_24h'];
$eur_7d = $jsonData['data'][0]['quote']['EUR']['percent_change_7d'];
curl_close($curl);

$parameters = [
    'start' => '1',
    'limit' => '1',
    'convert' => 'CNY',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1, 
));
$response = curl_exec($curl); 
$jsonData = json_decode($response, true);
$btc_cny =  $jsonData['data'][0]['quote']['CNY']['price'];
$cny_1h = $jsonData['data'][0]['quote']['CNY']['percent_change_1h'];
$cny_24h = $jsonData['data'][0]['quote']['CNY']['percent_change_24h'];
$cny_7d = $jsonData['data'][0]['quote']['CNY']['percent_change_7d'];
curl_close($curl);

$sql = 'UPDATE btc_fiat SET price_usd=?,price_eur=?,price_cny=?,1h_usd=?,1h_eur=?,1h_cny=?,24h_usd=?,24h_eur=?,24h_cny=?,7d_usd=?,7d_eur=?,7d_cny=? WHERE id = 0';
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}    
$stmt->bind_param('dddddddddddd', $btc_usd ,$btc_eur ,$btc_cny , $usd_1h, $eur_1h, $cny_1h, $usd_24h, $eur_24h, $cny_24h, $usd_7d, $eur_7d, $cny_7d);
$stmt->execute();
// die($stmt->error);
$stmt->close();


$url = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
$parameters = [
    'convert' => 'BTC',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1,
));

$response = curl_exec($curl);
$jsonData = json_decode($response, true);
$dominance = $jsonData['data']['btc_dominance'];
$btc_marketcap = $jsonData['data']['quote']['BTC']['total_market_cap'];
$btc_volume = $jsonData['data']['quote']['BTC']['total_volume_24h'];

curl_close($curl);

$url = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
$parameters = [
    'convert' => 'USD',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1,
));

$response = curl_exec($curl);
$jsonData = json_decode($response, true);
$usd_marketcap = $jsonData['data']['quote']['USD']['total_market_cap'];
$usd_volume = $jsonData['data']['quote']['USD']['total_volume_24h'];

curl_close($curl);

$url = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
$parameters = [
    'convert' => 'EUR',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1,
));

$response = curl_exec($curl);
$jsonData = json_decode($response, true);
$eur_marketcap = $jsonData['data']['quote']['EUR']['total_market_cap'];
$eur_volume = $jsonData['data']['quote']['EUR']['total_volume_24h'];

curl_close($curl);

$url = 'https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest';
$parameters = [
    'convert' => 'CNY',
];

$qs = http_build_query($parameters); 
$request = "{$url}?{$qs}"; 

$curl = curl_init(); 
curl_setopt_array($curl, array(
    CURLOPT_URL => $request, 
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_RETURNTRANSFER => 1,
));

$response = curl_exec($curl);
$jsonData = json_decode($response, true);
$cny_marketcap = $jsonData['data']['quote']['CNY']['total_market_cap'];
$cny_volume = $jsonData['data']['quote']['CNY']['total_volume_24h'];

curl_close($curl);

$sql = 'UPDATE global_metrics SET dominance=?,btc_volume=?,btc_marketcap=?,usd_volume=?,usd_marketcap=?,eur_volume=?,eur_marketcap=?,cny_volume=?,cny_marketcap=? WHERE id = 0';
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}

$stmt->bind_param('ddddddddd',$dominance, $btc_volume, $btc_marketcap, $usd_volume, $usd_marketcap, $eur_volume, $eur_marketcap, $cny_volume, $cny_marketcap);
$stmt->execute();
$stmt->close();