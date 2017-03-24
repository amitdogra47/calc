<?php

// get users IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //return $ip;
echo $ip;
}



// get user browser details
function getBrowser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
		
		//$yourbrowser= $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: " . $ua['userAgent'];
		//echo $yourbrowser;
}

// used with previous browser function
function gb(){
$ua=getBrowser();
$yourbrowser= $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] ;
echo $yourbrowser;
}


//not sure what this is - probably tested by not used
// it looks as though it is it meant to work with jquery
class Browser
{
    private $props    = array("Version" => "0.0.0",
                                "Name" => "unknown",
                                "Agent" => "unknown") ;

    public function __Construct()
    {
        $browsers = array("firefox", "msie", "opera", "chrome", "safari",
                            "mozilla", "seamonkey",    "konqueror", "netscape",
                            "gecko", "navigator", "mosaic", "lynx", "amaya",
                            "omniweb", "avant", "camino", "flock", "aol");

        $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        foreach($browsers as $browser)
        {
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match))
            {
                $this->Name = $match[1] ;
                $this->Version = $match[2] ;
                break ;
            }
        }
    }

    public function __Get($name)
    {
        if (!array_key_exists($name, $this->props))
        {
            die ("No such property or function $name");
			//$name"";
			;
        }
        return $this->props[$name] ;
    }

    public function __Set($name, $val)
    {
        if (!array_key_exists($name, $this->props))
        {
            SimpleError("No such property or function.", "Failed to set $name", $this->props) ;
            die ;
        }
        $this->props[$name] = $val ;
    }
}

?>