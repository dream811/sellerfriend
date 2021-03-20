<?php
namespace App\Mylibs;
//지마켓과 옥션 
class ESMConnector {

    protected $MARKET_CODE="gmarket";
    protected $USER_ID="c00235119";
    protected $USER_PWD="c00235119";
    protected $ACCESS_KEY="1e9a79d6-06b6-4fa7-80ef-8f095e00d40a";
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($market_code="gmarket", $userId="C00235119", $pwd="c00235119", $accessKey="1e9a79d6-06b6-4fa7-80ef-8f095e00d40a")
    {
        $this->MARKET_CODE=$market_code;
        $this->USER_ID=$userId;
        $this->USER_PWD=$pwd;
        $this->ACCESS_KEY=$accessKey;
        $this->AUTHORIZATION = "";
        
        date_default_timezone_set("Asia/Seoul");

    }
    public function getReturnShippingCenterInfo($returnCenterCodes = "1000000051"){
        date_default_timezone_set("GMT+0");


        $method = "GET";
        $path = "/v2/providers/greatwall_api/apis/api/v2/return/shipping-places/center-code";
        $query = "returnCenterCodes={$returnCenterCodes}";

        $authorization  = "Bearer ".$this->AUTHORIZATION;

        $url = 'https://sa.esmplus.com/item/v1/categories/site-cats/{siteCatCode}'.$path.'?'.$query;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
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