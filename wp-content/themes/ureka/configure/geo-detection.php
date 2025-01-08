<?php
function getRandomIP() {
    $ranges = [
        ['109.196.176.0', '109.196.183.255'],
        ['109.196.184.0', '109.196.184.255'],
        ['109.196.185.0', '109.196.191.255'],
        ['128.124.28.0', '128.124.28.255'],
        ['128.124.176.0', '128.124.176.223'],
        ['128.124.204.0', '128.124.204.255'],
        ['161.123.55.0', '161.123.55.255'],
        ['176.102.221.0', '176.102.221.255'],
        ['176.105.193.0', '176.105.193.255'],
        ['176.105.194.0', '176.105.194.255'],
        ['176.109.169.0', '176.109.169.255'],
        ['176.109.172.0', '176.109.173.255'],
        ['178.93.16.0', '178.93.16.255'],
        ['178.94.107.0', '178.94.107.255'],
        ['178.133.145.120', '178.133.145.255'],
        ['178.133.153.80', '178.133.153.255']
    ];



    $selectedRange = $ranges[array_rand($ranges)];
    $start = ip2long($selectedRange[0]);
    $end = ip2long($selectedRange[1]);
    $randomIP = long2ip(rand($start, $end));

    return $randomIP;
}
function geo_ip_region()
{
    $ipserver = $_SERVER['REMOTE_ADDR'];
//    $public_ip = file_get_contents('https://api.ipify.org');
    $public_ip = getRandomIP();
    $geo_data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $public_ip));

    if ($geo_data && isset($geo_data['geoplugin_region'])) {
        return $geo_data['geoplugin_region'];
    }
}

function region_to_ua_code($region)
{
    $region = mb_strtolower($region);
    $map = [
        'vinnyts' => 'UA05', 'volyn' => 'UA07', 'luhansk' => 'UA09', 'dnipro' => 'UA12', 'donets' => 'UA14',
        'zhytom' => 'UA18', 'zakarpat' => 'UA21', 'zaporizh' => 'UA23', 'ivano-frankiv' => 'UA26', 'kirovohrad' => 'UA35',
        'sevastopol' => 'UA40', 'crimea' => 'UA43', 'lviv' => 'UA46', 'mykola' => 'UA48', 'odes' => 'UA51', 'poltav' => 'UA53',
        'rivne' => 'UA56', 'sumy' => 'UA59', 'ternop' => 'UA61', 'kharkiv' => 'UA63', 'kherson' => 'UA65',
        'khmelnyts' => 'UA68', 'cherkas' => 'UA71', 'chernihiv' => 'UA74', 'chernivts' => 'UA77'
    ];
    if (stripos($region, 'kyiv') !== false && stripos($region, 'city') !== false) return 'UA32';
    if (stripos($region, 'kiev') !== false && stripos($region, 'city') !== false) return 'UA32';
    if (stripos($region, 'kyiv') !== false) return 'UA30';
    if (stripos($region, 'kiev') !== false) return 'UA30';
    foreach ($map as $key => $val) if (strpos($region, $key) !== false) return $val;
    return '';
}

