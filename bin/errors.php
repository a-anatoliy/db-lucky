<?php
/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 14.02.2018
 * Time: 16:51
 */
$ip     = $_SERVER['REMOTE_ADDR'];
$status = $_SERVER['REDIRECT_STATUS'];
$reqUri = $_SERVER["REQUEST_URI"];
$refer  = $_SERVER["HTTP_REFERER"];
$additionalInfo = "";

$codes = array(
    400 => array('400 Bad Request', 'The server cannot or will not process the request due to an apparent client error (e.g., malformed request syntax, size too large, invalid request message framing, or deceptive request routing).'),
    403 => array('403 Forbidden', 'The server understood the request, but is refusing to fulfil it. Authorization will not help and the request SHOULD NOT be repeated. If the request method was not HEAD and the server wishes to make public why the request has not been fulfilled, it SHOULD describe the reason for the refusal in the entity.'),
    404 => array('404 Not Found', 'The requested resource could not be found but may be available in the future. Subsequent requests by the client are permissible.'),
    405 => array('405 Method Not Allowed', 'A request method is not supported for the requested resource; for example, a GET request on a form that requires data to be presented via POST, or a PUT request on a read-only resource.'),
    408 => array('408 Request Timeout', 'The server timed out waiting for the request. According to HTTP specifications: "The client did not produce a request within the time that the server was prepared to wait. The client MAY repeat the request without modifications at any later time."'),
    500 => array('500 Internal Server Error', 'A generic error message, given when an unexpected condition was encountered and no more specific message is suitable.'),
    502 => array('502 Bad Gateway', 'The server was acting as a gateway or proxy and received an invalid response from the upstream server.'),
    504 => array('504 Gateway Timeout', 'The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.'),
);

$title = $codes[$status][0];
$message = $codes[$status][1];
if ($title == false || strlen($status) != 3) { $message = 'Undefined HTTP response code: '.$status; }
if (isset($ip)) {
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
    if(isset($details->country)) {
        $additionalInfo = sprintf("<div>[%s] %s</div><div>%s<br><em>%s</em></div>",
            $details->country, $details->region, $details->org, $details->city);
    }
}
?>

<!doctype html><html lang="en"><head><?php header('refresh:4;url=http://lucky-dress.eu/ '); ?><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><meta name="description" content="Error"><title>Lucky DRESS | atelier</title><link href="/css/bootstrap.min.css" rel="stylesheet"></head>
<body><div class="container"><div class="row"><div class="col-12 justify-content-between">
<?php echo
    '<h3>Oh, Snap! &nbsp; Error: <small>'.$title.'!</small></h3><p>'.$message.'</p>'.
    '<div><small>'.$reqUri.' -- '.$refer.'</small></div>'.
    $additionalInfo
    ;
?>
</div></div></div><script src="/js/bootstrap.min.js"></script></body></html>