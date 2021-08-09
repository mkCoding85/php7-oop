<?php 

// Definition einer Klasse //
class BrowserDetective {

    public $userAgent;
    public $platform;
    public $browserName;

    public function __construct() {
        $this->set_user_agent();
        $this->reset();
    }

    public function set_user_agent() {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        } else {
            $this->userAgent = '';
        }
    }

    public function reset() {
        $this->platform = 'Unbekannt';
        $this->browserName = 'Unbekannt';
    }

    public function detect() {
        $this->detect_platform();
        $this->detect_browser();
        return array($this->platform, $this->browserName);
    }

    public function detect_platform() {
        if (preg_match('/linux/i', $this->userAgent)) {
            $this->platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os/i', $this->userAgent)) {
            $this->platform = 'Mac';
        } elseif (preg_match('/windows|win32/i', $this->userAgent)) {
            $this->platform = 'Windows';
        }
    }

    public function detect_browser() {
        if (preg_match('/MSIE/i', $this->userAgent)) {
            $this->browserName = 'Internet Explorer';
        }  elseif(preg_match('/firefox/i', $this->userAgent)) {
            $this->browserName = 'Firefox';
        } elseif(preg_match('/Chrome/i', $this->userAgent)) {
            $this->browserName = 'Chrome';
        } elseif(preg_match('/Safari/i', $this->userAgent)) {
            $this->browserName = 'Safari';
        } elseif(preg_match('/Netscape/i', $this->userAgent)) {
            $this->browserName = 'Netscape';
        }
    }

}

// Der Inspector //
$inspector = new BrowserDetective();
$inspector->detect();
// Close //
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browser Informationen</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <p>Remote IP: <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?></p>
    <p>User Agent: <?php echo htmlspecialchars($_SERVER['HTTP_USER_AGENT']); ?></p>
    <p>Platform: <?php echo htmlspecialchars($inspector->platform); ?></p>
    <p>Browser: <?php echo htmlspecialchars($inspector->browserName); ?></p>
    <p>Referer: <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?></p>
    <p>Request Time (Unix): <?php echo htmlspecialchars($_SERVER['REQUEST_TIME']); ?></p>
    <?php date_default_timezone_set("Europe/Berlin"); ?>
    <p>Request Time (formatiert): <?php echo htmlspecialchars(date('Y-m-d H:s:i', $_SERVER['REQUEST_TIME'])); ?></p>
    <p>Request URI: <?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></p>
    <p>Request Method: <?php echo htmlspecialchars($_SERVER['REQUEST_METHOD']); ?></p>
    <p>Query String: <?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?></p>
    <p>HTTP Accept: <?php echo htmlspecialchars($_SERVER['HTTP_ACCEPT']); ?></p>
    <p>HTTP Accept Charset: <?php echo htmlspecialchars('HTTP_ACCEPT_CHARSET'); ?></p>
    <p>HTTP Accept Encoding: <?php echo htmlspecialchars($_SERVER['HTTP_ACCEPT_ENCODING']); ?></p>
    <p>HTTP Accept Language: <?php echo htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE']); ?></p>
    <p>HTTPS: <?php if(isset($_SERVER['HTTPS'])) { echo 'Ja'; } else { echo 'Nein'; } ?></p>
    <p>Remote Port: <?php echo htmlspecialchars($_SERVER['REMOTE_PORT']); ?></p>

</body>
</html>