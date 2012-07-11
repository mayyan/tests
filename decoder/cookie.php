<?php
require_once(APPLICATION_PATH.'/models/services/restriction_service.php');
//Read ci_cookies: UserInfo -- checkin password for UserKey is not implemented

class CWeb_Cookie
{
  public $_name  = "";
  public $_expires;
  public $_path   = '/';    // all paths
  public $_domain  = '';
  public $_sep = '&';
  private $_val = '';
  private $_parts;
  private $_maskAry = array('H','A','R','I','S','E','M','B','U','K');
  private $_unMaskAry = array('1','2','3','4','5','6','7','8','9');

  private $_maskVal = array('mac','acc','uid','nid');
  private $_intVal = array('isPrinterSupported','rememberMeCookie','cbStatus');
  private $_logger;
  private static $_RAWCOOKIE = array();
  /**
   * Constructor -- creates and initializes the given cookie from the HTTP
   * request.  The remaining parameters are used when setting/clearing the
   * cookie in the HTTP response.
   *
   * @param $cname Cookie to create/initialize
   * @param $cexpires Expiration time (in Unix time) to use when setting
   *     cookie.  Defaults to 0 which means session cookie.
   * @param $cpath Server path on which to set the cookie.  Defaults to
   *     '/'.
   * @param $cdomain Domain on which to set the cookie.  Defaults to the base
   *     domain of the request (e.g., "coupons.com" for a "www.coupons.com"
   *     request), if determinable, else to "" which means to use the request
   *     host name as the domain.
   * @param $csep Separator to use between cookie value fields.
   *
   * @returns void
   */
  public function __construct($cname, $cexpires=0, $cpath="/", $cdomain="", $csep="") {
    $this->_logger = Logger::GetLogger(__CLASS__);
    $this->_name = $cname;

    $this->_expires = $cexpires ? $cexpires : false;

    $this->_path = $cpath;

    // Unless otherwise specified, set domain to base domain of request
    if (!empty($cdomain)) {
        $this->_domain = $cdomain;
    } else {
        $this->_domain = $this->getBaseDomainName();
        static $first = true;
        if ($first) {
            $this->_logger->debug("Setting cookie domain to {$this->_domain}");
            $first = false;
        }
    }
    static $firstLoad = true;
    if($firstLoad){
        self::getRawCookie();
        $firstLoad = false;
    }
    if ( isset(self::$_RAWCOOKIE[$cname]) ) {
        $this->_val=urldecode(self::$_RAWCOOKIE[$cname]);

        $this->_sep = $csep ? $csep : $this->_sep;
        $arr = explode($this->_sep, $this->_val);
        if ( count($arr) ) {
            foreach ($arr as $value) {
                // explode only on the first of "=" with the rest of "=" as a whole string.
                $arr_element = explode("=",$value,2);
                if ( isset($arr_element[1]) ) {
                    $this->_parts[$arr_element[0]] = $arr_element[1];
                }
            }
        }
        return $this;
    } else {
        return null;
    }
  }

  /**
   * Determines whether cookie is empty/missing.
   *
   * @returns bool
   */
  public function isEmpty() {
      return empty($this->_val);
  }

  // get value from cookie where name/values sets deivded by defined sign
  public function get_val_byname($varName) {
    $return_val = '';
    if ( count($this->_parts) ) {
        $return_val = isset($this->_parts[$varName]) ? $this->_parts[$varName] : '';
    }

    if (in_array( $varName, $this->_maskVal)) {
        $return_val = $this->GetUnMackedValue($return_val);
    }

    if (in_array( $varName, $this->_intVal)){
        $return_val = $this->toIntVal($return_val);
    }

    return $return_val;
  }

  // get value from cookie where name/values sets deivded by defined sign
  public function set_val_byname($varName, $varValue) {
    $this->_parts[$varName] = $varValue;
    $arr = array();
    foreach ( $this->_parts as $k => $v ) {
        array_push($arr, "$k=$v");
    }
    $this->set(implode($this->_sep, $arr));
  }

  public function set($value)
  {
    $str = $this->_name.'='.$value.'; ';
    if ( $this->_expires ) {
        $str .= 'expires='.date('D, d-M-Y H:i:s T', strtotime($this->_expires)).'; ';
    }
    if ( $this->_path ) {
        $str .= 'path='.$this->_path.'; ';
    } else {
        $str .= 'path=/; ';
    }
    if ( $this->_domain ) {
        $str .= 'domain='.$this->_domain.';';
    }
    header('Set-Cookie: ' . $str);
  }

  public function get()
  {
    return $this->_val;
  }

  public function clear()
  {
    setcookie($this->_name, "", time() - 3600, $this->_path, $this->_domain);
  }

  private function GetUnMackedValue($valToUnMack)
  {
      $myChar = str_split($valToUnMack);
      $tempStr = "";

      for ($i = 0; $i < strlen($valToUnMack); $i++)
      {
        $tempStr = $tempStr . $this->getIntVal2($myChar[$i]);
      }

      return $this->toIntVal($tempStr);
  }

  private function GetMackedValue($valToMack)
  {

      $myChar = str_split($valToMack);
      $tempStr = "";

      for ($i = 0; $i < strlen($valToMack); $i++)
      {
        $iIndex =  $myChar[$i] - 48;
        $tempStr = $tempStr . $this->_maskAry[$iIndex];
      }

      return $tempStr;
  }

  private function getIntVal2($c)
  {
      $i = 0;
      foreach($this->_maskAry as $value)
      {
        if ( $value == $c )
            return $i;
        $i++;
      }
      return -1;
  }

  private function toIntVal($str)
  {
      $iStr = "";
      $isNumeric = false;

      if (is_null($str)) return 0;
      $arr_str = str_split($str);

      foreach($arr_str as $value)
      {
        if ( $value >= '0' && $value <= '9' )
        {
            $iStr = $iStr . $value;
            $isNumeric = true;
        }
        elseif (strlen($iStr) == 0 && $value == "-")
        {
            $iStr = $iStr . $value;
        }
      }

      if ($isNumeric)
          return intval($iStr);
      else
         return 0;
  }
/**
   * Function returns the raw cookie value array without the urlencode from a cookie.
   * @return array
   */
  public static function getRawCookie(){
    foreach(explode('; ',$_SERVER['HTTP_COOKIE']) as $rawcookie)
    {
        list($k,$v) = explode('=',$rawcookie, 2);
        self::$_RAWCOOKIE[$k] = $v;
    }
  }
  /**
   * Function returns the restrictions array from a cookie.
   * @return type
   */
  public static function getRestrictionsFromCookie() {
        $restrictionArray = array();
        if (isset ($_COOKIE["UserRestr"])) { // parse coolie

            if(Zend_Registry::isRegistered('currentRestrictions')) {
                $restrictionArray = Zend_Registry::get('currentRestrictions');

            } else {
                $restrictions_cookie = explode("$",$_COOKIE["UserRestr"]);
                foreach($restrictions_cookie as $key=>$restriction)
                {
                    $restrictionArray[$key] = explode("|", $restriction);
                    $splited = explode("#", $restrictionArray[$key][0]);
                    if(count($splited) > 1) {
                        $restrictionArray[$key][0] = $splited[1];
                    }

                }
                Zend_Registry::set('currentRestrictions', $restrictionArray);


            }

            return $restrictionArray;

        }

  }

  /**
   * Sets the restriction cookie.
   */
  public static function setRestrictionsCookie($pid, $accountId, $deviceId) {
      $service = new couponCom_mapper_RestrictionService(new JsonFiller(), $pid, $deviceId, $accountId );
      $Restrictions = $service->getRestrictions($pid, $deviceId, $accountId);

      $restrictionCookie = "Restr=RC:";

      $cpnList = $Restrictions['UserRestrictionsWithPC'];
      $cpnList = $cpnList['CouponList'];
      $cpnList = $cpnList['CouponLimitsWithPC'];
      $PCCount = count($cpnList);

      $restrictionCookie = $restrictionCookie . $PCCount;

      foreach($cpnList as $key => $value) {
          $printed_v = ($value['Printed'] == true) ? "0" : "1";
          $cookieSubText = '$'.$value['ID'].'|'. $printed_v . "|".$value["State"]."|".$value["SubState"]."$";
          $restrictionCookie = $restrictionCookie.'$'.$cookieSubText;

      }
      setcookie("UserRestr", $restrictionCookie);
      return $Restrictions;

  }

    /**
     * Gets and returns the base domain name (e.g., "coupons.com") of the URL
     * host through which the current request was made (e.g.,
     * "www.coupons.com") if the host name is a fully qualified domain name,
     * else returns "" as is suitable for the domain field setcookie().
     *
     * @note Currently only supports '.com' and '.net' top-level domains.
     *
     * @returns string Base domain name, or "" if unable to determine.
     */
  private function getBaseDomainName() {
      $req = Zend_Controller_Front::getInstance()->getRequest();
      $host = CWeb_Util::getUriHost($req);
      $host = strtolower($host);
      $parts = explode('.', $host);
      $nparts = count($parts);
      if (($nparts >= 2) && (in_array($parts[$nparts-1], array('com', 'net')))) {
          return $parts[$nparts-2] . '.' . $parts[$nparts-1];
      } else {
          return "";
      }
  }

  public function setRestrictionsList() {
    //  $this->
  }
}

/**
 * Class representing SessionInfo cookie.
 *
 * This class is already in need of refactoring.  It should be a singleton
 * since only one instance is ever needed per request and it's dumb and
 * expensive to keep creating identical instances.  But refactoring this class
 * also requires refactoring CWeb_Cookie and so is left til later.
 *
 * As it stands, static member variables are used to share the read-only data
 * across instances and preclude parsing / decoding the incoming cookie value
 * more than once.
 */
class CWeb_SessionInfoCookie extends CWeb_Cookie {
    private static $unencSessionInfoCookie;
    private static $sessionInfoParts;
    private static $constrException;
    private static $firstCall = true;
    private $_logger;

    public function __construct() {
        try {
            $this->_logger = Logger::GetLogger(__CLASS__);
            parent::__construct('SessionInfo');

            // If not first call for this request, reuse saved results
            if (!self::$firstCall) {
                if (isset(self::$constrException)) {
                    throw self::$constrException;
                } else {
                    // We're done, data is already stored in static members
                    return;
                }
            }

            // First call for this request, do the work and store the results
            self::$firstCall = false;
            if ($this->isEmpty()) {
                // Accommodate empty/missing cookies, e.g., for bots
                return;
            }
            self::$unencSessionInfoCookie = CWeb_CryptoServices::Decode($this);
            /* Sample unencSessionInfoCookie
            TrID= MS2011Uyfxpaza2194933018:|:Email= abcd@acme.com:|:FirstName= :|:LastName= :|:Address= :|:City= :|:IsLoggedIn= 1:|:IsAutoReg= 0:|:CVL= :|:BID= :|:IsInitialOffersView= :|:TrEvents= :|:ZIP= :|:IsPerCookie= 1:|:rdrPID= :|:EanData= :|:ExtUID= :|:CartTtl= :|:CartAmt= 0:|:HHID= :|:PriceZone= :|:Token=
            */
            self::$sessionInfoParts = array();
            if (!empty(self::$unencSessionInfoCookie)) {
                self::$sessionInfoParts = explode(':|:', self::$unencSessionInfoCookie);
                $this->_logger->debug("sessionInfoParts: " . implode(', ', self::$sessionInfoParts));
            } else {
                self::$constrException = new CookieException(CookieName::SESSION_INFO);
                throw self::$constrException;
            }
        } catch (Exception $e) {
            self::$constrException = new CookieException(CookieName::SESSION_INFO);
            throw self::$constrException;
        }
    }

    public static function toArray() {
        static $first = true;
        static $sessionInfoArray = array();
        static $excep;

        if (!$first) {
            if (isset($excep)) {
                throw $excep;
            } else {
                return $sessionInfoArray;
            }
        }

        $first = false;
        try {
            $parts = self::$sessionInfoParts;
            if (count($parts) > 0) {
                foreach ($parts as $part) {
                    $pair = explode('=', $part);
                    $sessionInfoArray[$pair[0]] = trim($pair[1]);
                }
            }
        } catch (Exception $e) {
            $excep = new CookieException(CookieName::SESSION_INFO);
            throw $excep;
        }
        return $sessionInfoArray;
    }
}

class CWeb_ClientSessionInfoCookie extends CWeb_Cookie {
    private $_podIds;
    private $_tafInfo;

    public function __construct() {
        $podIds = array();
        if (array_key_exists(Constant::CLIENTSESSIONINFOCOOKIE, $_COOKIE)) {
            $cookieValue = $_COOKIE[Constant::CLIENTSESSIONINFOCOOKIE];
        } else {
            $cookieValue = '';
        }

        // get the pod id part as string
        $podString = $this->getPodIdsAsString();


        // get pods ids into array
        if (strlen($podString) > 0) {
            $this->_podIds = explode(',', $podString);
        } else {
            $this->_podIds = array();
        }

        // get TAF info
        $tafMatches = array();
        $tafPattern = "/(CLIENTCOOKIETAF4)(=)([\S]+)(:)(CLIENTCOOKIETAFNAME)(=)([\S]+)(:)/";
        $matchCount = preg_match_all($tafPattern, $cookieValue, $tafMatches);

        if ($matchCount > 0) {
            $this->_tafInfo["email"] = $tafMatches[3][0];
            $this->_tafInfo["name"] = $tafMatches[7][0];
        } else {
            $this->_tafInfo["email"] = '';
            $this->_tafInfo["name"] = '';
        }

    }

    /**
     * List of pod Ids withoput trailing comma ,
     * @return string
     */
    public function getPodIdsAsString() {
        if (array_key_exists(Constant::CLIENTSESSIONINFOCOOKIE, $_COOKIE)) {
            $cookieValue = $_COOKIE[Constant::CLIENTSESSIONINFOCOOKIE];

            if (strrpos($cookieValue, ',CLIENTCOOKIETAF4') === false) {
                if (strrpos($cookieValue, ',') === false) {
                    $podString = '';
                } else {
                    $podString = substr($cookieValue, 0, strrpos($cookieValue, ','));
                }
            } else {
                $podString = substr($cookieValue, 0, strrpos($cookieValue, ',CLIENTCOOKIETAF4'));
            }
        } else {
            $podString = '';
        }
        return $podString;
    }

    public function getPodIds() {
        return $this->_podIds;
    }

    public function setPodIds($ids) {
        $this->_podIds = $ids;
    }

    public function getTAFInfo() {
        return $this->_tafInfo;
    }

    public function setTAFInfo($info) {
        $this->_tafInfo = $info;
    }

    public function save() {
        $value = '';
        if (count($this->_podIds) > 0) {
            $value .= implode(',', $this->_podIds) .',';
        }
        if ($this->_tafInfo['email'] != '') {
            $value .= 'CLIENTCOOKIETAF4=' + $this->_tafInfo['email'];
        }
        if ($this->_tafInfo['name'] != '') {
            $value .= 'CLIENTCOOKIETAFNAME=' + $this->_tafInfo['name'];
        }
        $_COOKIE[Constant::CLIENTSESSIONINFOCOOKIE] = $value;
        setcookie(Constant::CLIENTSESSIONINFOCOOKIE, $value);
    }
}

/*
http://merc/hg/index.cgi/CryptoServices/raw-file/fe52813758aa/CipherKey2.cs
CipherKey2.Decode(_shortkey, _longkey, _context, _encID, Utility.decodeX);
private static string _shortkey = "abcdef12345";//"bma83uzkfw";
private static string _longkey = "SzHv54$EVO2q7gdnRTMy.m@36eGQW9w_UFlpijxYLhba8ArCKtNI^! 0XPZB%uosDcJ1kf";
private static string _context = "13028";
*/
class CWeb_CryptoServices {
   /*
    Read in the  SessionInfo=TrackingID=MS2071Uyfqmdhk463414680&SI=iG0O=FburFQe%BYle!n~axiYYr0St:|:~3~34=y:|:aG@ys4l4b=~:|:70Nrdj$j=h:|:r.DXpU9=Q:|:Wcaw=b:|:1Z.qkQZM_4=yR:|:aiBZUzm~3=pl:|:!eP=q:|:OM@=Ga$4$d.sbHCM~wgRe_b@OksN:|:voyEDoeN.j4tGRq!bfK=Kp:|:BCJohF_5=H:|:whs=4:|:wmPxip$CMPU=rK:|:L@MUYA=C:|:ZQgF2$P=!:|:ZxMaJd=U:|:!UWH.kx=8:|:BU@MYU5=5P:|:fql^=S:|:lwT8v_5N3=Y:|:4J!x5=5ZKplY; domain=192.168.102.71; path=/; HttpOnly
    */
    public static function Decode($sessionInfoCookie){
        try{
            // read in SI portion from SessionInfo cookie for decoding
            $encID = $sessionInfoCookie->get_val_byname("SI");
            $unencSessionInfoCookie = "";
            if (!empty($encID)) {
                // Current SessionInfoCookie is using the "~" to fillin the space.
                //We need to put back the space before decrypt.
                $encID = str_replace("~", " ", $encID);
                $unencSessionInfoCookie = self::_decrypt($encID);
            }
            else {
                throw new CookieException(CookieName::SESSION_INFO);
            }
            // read in sC portion from SessionInfo cookie for decoding
            //Sample:TrackingID=MS2001Uygtqblq2675986134&SI=iG0O=FburF.M!^F_G^MsNACIBSOTfX:|:ulc8G=8:|:k0I6kdaMu=E:|:p7EET8gK=^:|:1hyqDul=U:|:j5Xt=c:|:.nCbzlc9bG=Lh:|:kcMsj2w1b=ZP:|:2^M=d:|:ReF=jDQw_ibuL4!UHXANBvPtLFmm@:|:tbvcWHYkbfCe$SfT^gJ=Sk:|:U6CCwkby=m:|:!5i=^DzV%K:
            //|:PiX_yL9@q8v=4u:|:hgvpDM=b:|:aSLKOfL=Z:|:qgqwja=A:|:~3g4AhF=9:|:UBjTUnO=QU:|:ok4q=g:|:pmHCW5fpJ=J:|:.crmO=QFh@4k&sC=yxzLLsYRc=fk:|:ni1FRsi$YmOXr=JS:|:QGY8W5@sPi=ZsA/G7/fZoSS$OM4
            $scID = $sessionInfoCookie->get_val_byname("sC");
            $unencSCCookie = "";
            if (!empty($scID)) {
                // Current SessionInfoCookie is using the "~" to fillin the space.
                //We need to put back the space before decrypt.
                $scID = str_replace("~", " ", $scID);
                $unencSCCookie = self::_decrypt($scID);

                if(!isset($unencSCCookie)){
                }
                else {
                   $unencSessionInfoCookie =$unencSessionInfoCookie .':|:' .  $unencSCCookie;
                }
            }

            return $unencSessionInfoCookie;
        }
        catch (Exception $e) {
            throw new CookieException(CookieName::SESSION_INFO);
        }
    }

    /*Logic was found at http://merc/hg/index.cgi/CryptoServices/raw-file/fe52813758aa/CipherKey2.cs.
    * CipherKey2.Decode(_shortkey, _longkey, _context, _encID, Utility.decodeX);
    * Return @string Decoded SI portion from SessionInfo cookie
    */
    private static function _decrypt($vInputText) {
        try{
            if (strlen(Constant::DECODEX) != Constant::dxLength) return "";

            $encodeModulo = array();
            $decodeModulo = array();
            $decodeTextArray = str_split(Constant::DECODEX);
            $vob = array();
            $vob[0] = (int) substr(Constant::CONTEXT, strlen(Constant::CONTEXT) - 2, 2);
            $vob[1] = (int) substr(Constant::CONTEXT, strlen(Constant::CONTEXT) - 4, 2);

            for ($i = 0; $i < 256; $i++) {
                $encodeModulo[] = -1;
                $decodeModulo[] = -1;
            }
            for ($i = 0; $i < Constant::dxLength; $i++) {
                $encodeModulo[ord($decodeTextArray[$i])] = $i;
                $decodeModulo[ord(substr(Constant::LONG_KEY, $i, 1))] = $i;
            }

            $k = strlen(Constant::SHORT_KEY);
            $s2Array = array();
            $s3Array = array();
            $SumArray = array();
            for ($i = 0; $i < $k; $i++) {
                $s2Array[$i] = 2 * $encodeModulo[ord(substr(Constant::SHORT_KEY, $i, 1))];
                $s3Array[$i] = $vob[$i % 2];
                $SumArray[$i] = $s2Array[$i] + $s3Array[$i];
            }
            for ($i = $k; $i < $k * 2; $i++) {
                $s2Array[$i] = 2 * $encodeModulo[ord(substr(Constant::SHORT_KEY, $i-$k, 1))];
                $s3Array[$i] = $vob[$i % 2];
                $SumArray[$i] = $s2Array[$i] + $s3Array[$i];
            }
            $k = $k * 2;

            $inputArray = str_split($vInputText);
            $eStringArray = array();
            $encThis = 0;
            $encLast = 0;
            $myDecode = 0;
            $mw = 0;
            for ($i = 0; $i < strlen($vInputText); $i++) {
                $mb = ord($inputArray[$i]);
                if ($mb < 256) {
                    $encThis = $decodeModulo[$mb];

                    if ($encThis >= 0) {
                        $mw++;
                        $myDecode = (4 * Constant::dxLength + $encThis - $encLast - $SumArray[$mw % $k]) % Constant::dxLength;
                        $eStringArray[$i] = $decodeTextArray[$myDecode];
                        $encLast = $encThis;
                    }
                    else {
                        $eStringArray[$i] = $inputArray[$i];
                    }
                } else {
                    $eStringArray[$i] = $inputArray[$i];
                }
            }
            $eString = implode('', $eStringArray);
            $decryStr = "";
            if (substr($eString, (strlen($eString) - strlen(Constant::CONTEXT)), strlen(Constant::CONTEXT)) == Constant::CONTEXT) {
                     $subStrLen = strlen($eString) - strlen(Constant::CONTEXT);

                $decryStr= trim(substr($eString,0, $subStrLen));
            }
            return $decryStr;
            }
        catch (Exception $e) {
            throw new CWeb_Exception(Constant::DECRYPT_SESSION_INFO_COOKIE_FAIL);
        }
    }
}
