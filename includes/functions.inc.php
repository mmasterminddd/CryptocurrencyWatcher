<?

function GetPrice(string $btc_price)
{
    
    global $fiat,$fiat_usd,$fiat_eur,$fiat_cny;
    if ($fiat == 'USD'){
        if (number_format((doubleval($btc_price) * $fiat_usd) >= 1.00)) {
            return '$' . number_format((doubleval($btc_price) * $fiat_usd), 2, '.', ',');
        } else {
            return '$' . number_format((doubleval($btc_price) * $fiat_usd), 4, '.', ',');
        }
        
    } elseif ($fiat == 'EUR') {
        if (number_format((doubleval($btc_price) * $fiat_eur)) >= 1.00) {
            return number_format((doubleval($btc_price) * $fiat_eur), 2, '.', ',') . '€' ;
        } else {
            return number_format((doubleval($btc_price) * $fiat_eur), 2, '.', ',') . '€' ;
        }
         
    } elseif ($fiat == 'CNY') {
        if (number_format((doubleval($btc_price) * $fiat_cny)) >= 1.00) {
            return '¥' . number_format((doubleval($btc_price) * $fiat_cny), 2, '.', ',');
        } else {
            return '¥' . number_format((doubleval($btc_price) * $fiat_cny), 4, '.', ',');
        }
    } else {
        if (number_format($btc_price) >= 1.00) {
            return number_format($btc_price, 2, '.', ',') . ' BTC';
        } else {
            return number_format($btc_price, 8, '.', ',') . ' BTC';
        }
    }
}




function GetColor(string $percentage)
{
    if ($percentage > 0.0) {
        return 'green';
    } else if ($percentage < 0.0) {
        return 'red';
    }

    return;
}

function GetPerc(string $type)
{
    
    global $fiat,$usd_1h,$eur_1h,$cny_1h,$usd_24h,$eur_24h,$cny_24h,$usd_7d,$eur_7d,$cny_7d;
    
    if ($fiat == 'USD'){
        if ($type == '1h'){
            return $usd_1h;
        } elseif ($type == '24h') {
            return $usd_24h ;
        } elseif ($type == '7d') {
            return $usd_7d;
        }
    } elseif ($fiat == 'EUR') {
        if ($type == '1h'){
            return $eur_1h;
        } elseif ($type == '24h') {
            return $eur_24h ;
        } elseif ($type == '7d') {
            return $eur_7d;
        }
    } elseif ($fiat == 'CNY') {
        if ($type == '1h'){
            return $cny_1h;
        } elseif ($type == '24h') {
            return $cny_24h ;
        } elseif ($type == '7d') {
            return $cny_7d;
        }
    } else {
        return 0.00;
    }
}



function GetMarketVolume()
{
    global $fiat,$btc_volume,$usd_volume,$eur_volume,$cny_volume;
    if ($fiat == 'USD'){
        return '24h Market Volume: $' . number_format($usd_volume, 2, '.', ',');
    } elseif ($fiat == 'EUR') {
        return '24h Market Volume: ' . number_format($eur_volume, 2, '.', ',') . '€';
    } elseif ($fiat == 'CNY') {
        return '24h Market Volume: ¥' . number_format($cny_volume, 2, '.', ',');
    } else {
        return '24h Market Volume: ' . number_format($btc_volume, 2, '.', ',') . ' BTC';
    }
    
}

function GetMarketCap()
{        
    global $fiat,$btc_marketcap,$usd_marketcap,$eur_marketcap,$cny_marketcap;
    if ($fiat == 'USD'){
        return 'Market Cap: $' . number_format($usd_marketcap, 2, '.', ',');  
    } elseif ($fiat == 'EUR') {
        return 'Market Cap: ' . number_format($eur_marketcap, 2, '.', ',') . '€';
    } elseif ($fiat == 'CNY') {
        return 'Market Cap: ¥' . number_format($cny_marketcap, 2, '.', ',');
    } else {
        return 'Market Cap: ' . number_format($btc_marketcap, 2, '.', ',') . ' BTC';
    }
}

?>