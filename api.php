<?php


$headers = array_change_key_case(getallheaders(), CASE_LOWER);

// Prefer explicit POST params, then headers
$AT = $headers['at'] ?? null;
$jsonData = file_get_contents('php://input');
$FREQ_RAW = $jsonData;

// cookies: prefer explicit POST param, then standard Cookie header, then custom header X-Cookies
$COOKIE = $headers['cookies'] ?? null;

$missing = [];
if (!$AT) $missing[] = 'at';
if (!$FREQ_RAW) $missing[] = 'freq_raw';
if (!$COOKIE) $missing[] = 'cookies';
if (!empty($missing)) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode([
    'status' => 'error',
    'missing_fields' => $missing
  ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  exit;
}



$FSID = '-1165716089292329246';
$REQID = '962571';
$BL = 'boq_payments-merchant-console-ui_20250803.08_p0';
$HL = 'en-GB';
$SOURCE_PATH = '/g4b/transactions/BCR2DN4T5HYOZ4AP';
$ORIGIN = 'https://pay.google.com';


// yaha per order id paas karna hai 
$FILTER_REMARKS = "rr";

$base = 'https://pay.google.com/g4b/_/SMBConsoleUI/data/batchexecute';
$q = http_build_query([
  'rpcids'       => 'RPtkab',
  'source-path'  => $SOURCE_PATH,
  'f.sid'        => $FSID,
  'bl'           => $BL,
  'hl'           => $HL,
  'soc-app'      => '1',
  'soc-platform' => '1',
  'soc-device'   => '2',
  '_reqid'       => $REQID,
  'rt'           => 'c',
], '', '&', PHP_QUERY_RFC3986);
$url = $base.'?'.$q;

function cookie_value(string $blob, string $name): ?string {
  foreach (explode(';', $blob) as $p) { 
    $kv = explode('=', trim($p), 2); 
    if (count($kv)==2 && $kv[0]===$name) return $kv[1]; 
  }
  return null;
}
function sapisidhash(string $cookie, string $origin): ?string {
  $sapisid = cookie_value($cookie, 'SAPISID') ?: cookie_value($cookie, '__Secure-3PAPISID');
  if (!$sapisid) return null;
  $ts = (string) time();
  return 'SAPISIDHASH '.$ts.'_'.sha1($ts.' '.$sapisid.' '.$origin);
}

$headers = [
  'accept: */*',
  'content-type: application/x-www-form-urlencoded;charset=UTF-8',
  'origin: '.$ORIGIN,
  'referer: '.$ORIGIN.'/',
  'accept-encoding: gzip, deflate, br, zstd',
  'accept-language: en-US,en;q=0.9,hi;q=0.8',
  'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36',
  'sec-fetch-dest: empty',
  'sec-fetch-mode: cors',
  'sec-fetch-site: same-origin',
  'x-browser-channel: stable',
  'x-browser-year: 2025',
  'x-same-domain: 1',
  'x-client-data: CIu2yQEIprbJAQipncoBCLbgygEIk6HLAQiko8sBCIWgzQEI/qXOAQjrgM8BCPaDzwEIgYTPAQiVhM8BCKCFzwEY4eLOARjS/s4B',
  "cookie: $COOKIE",
];
if ($auth = sapisidhash($COOKIE, $ORIGIN)) {
  $headers[] = 'authorization: '.$auth;
  $headers[] = 'x-origin: '.$ORIGIN;
}

if ($AT === 'PASTE_FRESH_AT_HERE') {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode([
    'status' => 'error',
    'message' => 'Please paste a fresh `at` token from DevTools into the `at` parameter.'
  ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  exit;
}

$useRaw = (strncmp($FREQ_RAW, '%5B', 3) === 0 || strncmp($FREQ_RAW, '%5b', 3) === 0);
if ($useRaw) {
  $postBody = 'f.req='.$FREQ_RAW.'&at='.rawurlencode($AT);
} else {
  $postBody = http_build_query(['f.req' => $FREQ_RAW, 'at' => $AT], '', '&', PHP_QUERY_RFC3986);
}

$ch = curl_init();
curl_setopt_array($ch, [
  CURLOPT_URL            => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST           => true,
  CURLOPT_HTTPHEADER     => $headers,
  CURLOPT_POSTFIELDS     => $postBody,
  CURLOPT_ENCODING       => '',
  CURLOPT_TIMEOUT        => 30,
]);
$raw  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($err) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(['status' => 'error', 'message' => 'cURL error: '.$err], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  exit;
}

function parse_chunks(string $resp): array {
  if (strpos($resp, ")]}'") === 0) $resp = substr($resp, 4);
  $resp = ltrim($resp, "\r\n");
  $lines = preg_split("/\r\n|\n|\r/", $resp);
  $out = [];
  for ($i=0; $i<count($lines); ) {
    while ($i<count($lines) && trim($lines[$i])==='') $i++;
    if ($i>=count($lines)) break;
    $len = trim($lines[$i++]);
    while ($i<count($lines) && trim($lines[$i])==='') $i++;
    if ($i>=count($lines)) break;
    $json = $lines[$i++];

    $arr = json_decode($json, true);
    $rpc = $arr[0][1] ?? null;
    $payload = $arr[0][2] ?? null;

    for ($k=0; $k<3; $k++) {
      if (is_string($payload)) { 
        $tmp = json_decode($payload, true); 
        if ($tmp !== null) $payload = $tmp; else break; 
      }
    }
    $out[] = ['rpc'=>$rpc, 'payload'=>$payload, 'raw'=>$json, 'len'=>ctype_digit($len)?(int)$len:null];
  }
  return $out;
}

$useRawFlag = $useRaw ? 'true' : 'false';
if ($code !== 200) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode([
    'status' => 'error',
    'http_code' => $code,
    'message' => substr((string)$raw,0,700),
    'note' => "Note: HTTP 400 often means wrong f.req encoding or an expired `at` token. useRaw={$useRawFlag}"
  ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  exit;
}

$chunks = parse_chunks((string)$raw);
$payload = null;
foreach ($chunks as $c) if (($c['rpc'] ?? null) === 'RPtkab') { $payload = $c['payload']; break; }

if ($payload === null) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode([
    'status' => 'error',
    'message' => 'RPtkab payload not found',
    'raw_preview' => substr((string)$raw,0,400)
  ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
  exit;
}

function map_txns(array $payload): array {
  if (!isset($payload[0]) || !is_array($payload[0])) return [];
  $txns = $payload[0]; $out = [];
  foreach ($txns as $t) {
    if (!is_array($t)) continue;
    $sec = $t[2][0] ?? null;
    $out[] = [
      'txn_id'     => $t[0] ?? '',
      'order_id'   => $t[1] ?? '',
      'time'       => $sec ? date('Y-m-d H:i:s', (int)$sec) : '',
      'amount'     => $t[3][1] ?? null,
      'currency'   => $t[3][0] ?? '',
      'payer_name' => $t[8][0] ?? '',
      'payer_upi'  => $t[8][1] ?? '',
      'remarks'    => $t[9] ?? '',
      'status'     => (isset($t[10]) && (int)$t[10] === 5) ? 'SUCCESS' : 'PENDING/FAILED',
    ];
  }
  return $out;
}

$txnList = map_txns($payload);

// 🔎 Filter सिर्फ वही txn दिखेगा जिसका remarks match करे
//if ($FILTER_REMARKS) {
//  $txnList = array_values(array_filter($txnList, function($t) use ($FILTER_REMARKS) {
//    return isset($t['remarks']) && $t['remarks'] === $FILTER_REMARKS;
//  }));
//}

// ✅ JSON output
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'status' => 'success',
  'count'  => count($txnList),
  'transactions' => $txnList
], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
exit;

