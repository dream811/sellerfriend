<?php
namespace App\Mylibs;

class WeMakePriceConnector {

    protected $USER_ID="";
    protected $USER_PWD="";
    protected $AUTH_KEY="e67b202fc45c212dc62518a04059b9354c444c2a77241919a10762bc5eb1b5a396ac8dbe51a673e35b9127c3a6d5f776";
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($userId="onnj92", $pwd="dhsdoswpdl12!!", $authKey="e67b202fc45c212dc62518a04059b9354c444c2a77241919a10762bc5eb1b5a396ac8dbe51a673e35b9127c3a6d5f776")
    {
        $this->USER_ID=$userId;
        $this->USER_PWD=$pwd;
        $this->AUTH_KEY=$authKey;
        date_default_timezone_set("Asia/Seoul");

    }
    public function getReturnShippingCenterInfo($returnCenterCodes = "1000000051"){
        date_default_timezone_set("GMT+0");


        $method = "GET";
        $path = "/v2/providers/greatwall_api/apis/api/v2/return/shipping-places/center-code";
        $query = "returnCenterCodes={$returnCenterCodes}";

        $authorization  = "Bearer ".$this->AUTH_KEY;

        $url = 'https://sa.esmplus.com/item/v1/categories/site-cats/{siteCatCode}'.$path.'?'.$query;
        
        $credential = array();
        $credential['username'] = 'abc';
        $credential['domainnew'] = '123';
        $credential['updateme'] = 'update';

        $credential=json_encode($credential);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_POSTFIELDS, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }
}