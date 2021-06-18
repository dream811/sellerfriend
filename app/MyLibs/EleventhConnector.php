<?php
namespace App\Mylibs;
//지마켓과 옥션 
class EleventhConnector {

    protected $USER_ID="songfh0502";
    protected $USER_PWD="vnxndqk68!";
    protected $ACCESS_API_KEY="21f79033b93db3ab96d43792a6f36a59";
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($userId="C00235119", $pwd="c00235119", $accessApiKey="21f79033b93db3ab96d43792a6f36a59")
    {
        $this->USER_ID=$userId;
        $this->USER_PWD=$pwd;
        $this->ACCESS_API_KEY=$accessApiKey;
        
        date_default_timezone_set("Asia/Seoul");

    }
    public function getReturnShippingCenterInfo($returnCenterCodes = "1000000051"){
        date_default_timezone_set("GMT+0");


        $method = "GET";
        $path = "/v2/providers/greatwall_api/apis/api/v2/return/shipping-places/center-code";
        $query = "returnCenterCodes={$returnCenterCodes}";

        $authorization  = "Bearer ".$this->AUTHORIZATION;

        $url = 'https://sa.esmplus.com/item/v1/categories/site-cats/{siteCatCode}'.$path.'?'.$query;
        
        $credential=array();
        $credential['username']='abc';
        $credential['domainnew']='123';
        $credential['updateme']='update';

        $credential=json_encode($credential);

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

    /**
     * 상품등록(post)
     */
    public function addProduct($data = "") {
        if(empty($strjson)){
            return false;
        }
        
        date_default_timezone_set("GMT+0");
        
        $data = <<<_EOT_
        <?xml version="1.0" encoding="euc-kr" ?>
        <Product>
        
        </Product>
        _EOT_;

        $curl = curl_init();        
        $headers = array("Content-type: text/xml;charset=EUC-KR", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/prodservices/product");
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result=curl_exec($curl);
        echo "[MSG] Result -Xml : \n";
        echo $result;
        
        //return($httpcode);
        
        return($result);
    }
}