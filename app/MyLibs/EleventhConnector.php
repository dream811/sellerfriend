<?php
namespace App\Mylibs;

use SimpleXMLElement;
use XMLParser;

//11번가 
class EleventhConnector {

    protected $USER_ID="songfh0502";
    protected $USER_PWD="vnxndqk68!";
    protected $ACCESS_API_KEY="21f79033b93db3ab96d43792a6f36a59";
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($accessApiKey="21f79033b93db3ab96d43792a6f36a59", $userId="C00235119", $pwd="c00235119")
    {
        $this->USER_ID=$userId;
        $this->USER_PWD=$pwd;
        $this->ACCESS_API_KEY=$accessApiKey;
        
        date_default_timezone_set("Asia/Seoul");

    }
    
    /**
     * 상품등록(post)
     */
    public function addProduct($data = "") {
        if(empty($data)){
            return false;
        }
/*
        $data = <<<_EOT_
<?xml version="1.0" encoding="euc-kr" ?>
<Product>
    <abrdBuyPlace>A</abrdBuyPlace>
    <abrdSizetableDispYn>Y</abrdSizetableDispYn>
    <selMnbdNckNm>SongFa</selMnbdNckNm>
    <selMthdCd>01</selMthdCd>
    <dispCtgrNo>1011958</dispCtgrNo>
    <prdTypCd>01</prdTypCd>
    <hsCode>1233</hsCode>
    <prdNm>tsss</prdNm>
    <prdNmEng>asdf</prdNmEng>
    <advrtStmt>asdf</advrtStmt>
    <brand>asdf</brand>
    <apiPrdAttrBrandCd>asdf</apiPrdAttrBrandCd>
    <rmaterialTypCd>01</rmaterialTypCd>
    <orgnTypCd>01</orgnTypCd>
    <orgnTypDtlsCd>asdf</orgnTypDtlsCd>
    <orgnNmVal>asdf</orgnNmVal>
    <ProductRmaterial>
        <rmaterialNm>asdf</rmaterialNm>
        <ingredNm>asdf</ingredNm>
        <orgnCountry>adsf</orgnCountry>
        <content>asdf</content>
    </ProductRmaterial>
    <beefTraceStat>01</beefTraceStat>
    <beefTraceNo>asdf</beefTraceNo>
    <sellerPrdCd>asdf</sellerPrdCd>
    <suplDtyfrPrdClfCd>01</suplDtyfrPrdClfCd>
    <yearEndTaxYn>Y</yearEndTaxYn>
    <forAbrdBuyClf>01</forAbrdBuyClf>
    <importFeeCd>01</importFeeCd>
    <prdStatCd>01</prdStatCd>
    <useMon>asdf</useMon>
    <paidSelPrc>asdf</paidSelPrc>
    <exteriorSpecialNote>asasdf</exteriorSpecialNote>
    <minorSelCnYn>Y</minorSelCnYn>
    <prdImage01>asdf</prdImage01>
    <prdImage02>asdf</prdImage02>
    <prdImage03>asdf</prdImage03>
    <prdImage04>asdf</prdImage04>
    <prdImage05>asdf</prdImage05>
    <prdImage09>asdf</prdImage09>
    <prdImage01Src>asdf</prdImage01Src>
    <htmlDetail>aasdf</htmlDetail>
    <ProductCertGroup>
        <crtfGrpTypCd>02</crtfGrpTypCd>
        <crtfGrpObjClfCd>02</crtfGrpObjClfCd>
        <crtfGrpExptTypCd>02</crtfGrpExptTypCd>
        <ProductCert>
        <certTypeCd>109</certTypeCd>
        <certKey>asdf</certKey>
        </ProductCert>
    </ProductCertGroup>
    <ProductMedical>
        <MedicalKey>asdf</MedicalKey>
        <MedicalRetail>asdf</MedicalRetail>
        <MedicalAd>asdf</MedicalAd>
    </ProductMedical>
    <reviewDispYn>asdf</reviewDispYn>
    <reviewOptDispYn>asdf</reviewOptDispYn>
    <selPrdClfCd>0:100</selPrdClfCd>
    <aplBgnDy>asdf</aplBgnDy>
    <aplEndDy>asdf</aplEndDy>
    <setFpSelTermYn>Y</setFpSelTermYn>
    <selTermUseYn>Y</selTermUseYn>
    <selPrdClfFpCd>0:100</selPrdClfFpCd>
    <wrhsPlnDy>asdf</wrhsPlnDy>
    <contractCd>01</contractCd>
    <chargeCd>asdf</chargeCd>
    <periodCd>01</periodCd>
    <phonePrc>12311</phonePrc>
    <maktPrc>12000</maktPrc>
    <selPrc>8000</selPrc>
    <cuponcheck>Y</cuponcheck>
    <dscAmtPercnt>899</dscAmtPercnt>
    <cupnDscMthdCd>01</cupnDscMthdCd>
    <cupnUseLmtDyYn>Y</cupnUseLmtDyYn>
    <cupnIssEndDy>8900</cupnIssEndDy>
    <pay11YN>N</pay11YN>
    <pay11Value>12090</pay11Value>
    <pay11WyCd>02</pay11WyCd>
    <intFreeYN>Y</intFreeYN>
    <intfreeMonClfCd>05</intfreeMonClfCd>
    <pluYN>Y</pluYN>
    <pluDscCd>01</pluDscCd>
    <pluDscBasis>12000</pluDscBasis>
    <pluDscAmtPercnt>12000</pluDscAmtPercnt>
    <pluDscMthdCd>02</pluDscMthdCd>
    <pluUseLmtDyYn>Y</pluUseLmtDyYn>
    <pluIssStartDy>1200</pluIssStartDy>
    <pluIssEndDy>12</pluIssEndDy>
    <hopeShpYn>N</hopeShpYn>
    <hopeShpPnt>12</hopeShpPnt>
    <hopeShpWyCd>02</hopeShpWyCd>
    <optSelectYn>12</optSelectYn>
    <txtColCnt>12</txtColCnt>
    <optionAllQty>12</optionAllQty>
    <optionAllAddPrc>12</optionAllAddPrc>
    <optionAllAddWght>12</optionAllAddWght>
    <prdExposeClfCd>00</prdExposeClfCd>
    <optMixYn>Y</optMixYn>
    <ProductOption>
        <useYn>Y</useYn>
        <colOptPrice>12</colOptPrice>
        <colValue0>12</colValue0>
        <colCount>12</colCount>
        <colSellerStockCd>12</colSellerStockCd>
    </ProductOption>
    <ProductRootOption>
        <colTitle>12</colTitle>
        <ProductOption>
        <colOptPrice>12</colOptPrice>
        <colValue0>12</colValue0>
        </ProductOption>
    </ProductRootOption>
    <ProductOptionExt>
        <ProductOption>
        <useYn>Y</useYn>
        <colOptPrice>12</colOptPrice>
        <colOptCount>12</colOptCount>
        <colCount>12</colCount>
        <optWght>12</optWght>
        <colSellerStockCd>12</colSellerStockCd>
        <optionMappingKey>12</optionMappingKey>
        </ProductOption>
    </ProductOptionExt>
    <ProductCustOption>
        <colOptName>12</colOptName>
        <colOptUseYn>Y</colOptUseYn>
    </ProductCustOption>
    <useOptCalc>12</useOptCalc>
    <optCalcTranType>reg</optCalcTranType>
    <optTypCd>12</optTypCd>
    <optItem1Nm>12</optItem1Nm>
    <optItem1MinValue>1200</optItem1MinValue>
    <optItem1MaxValue>1200</optItem1MaxValue>
    <optItem2Nm>1200</optItem2Nm>
    <optItem2MinValue>1200</optItem2MinValue>
    <optItem2MaxValue>1200</optItem2MaxValue>
    <optUnitPrc>1200</optUnitPrc>
    <optUnitCd>02</optUnitCd>
    <optSelUnit>1200</optSelUnit>
    <ProductComponent>
        <addPrdGrpNm>1200</addPrdGrpNm>
        <compPrdNm>1200</compPrdNm>
        <sellerAddPrdCd>121212</sellerAddPrdCd>
        <addCompPrc>1200</addCompPrc>
        <compPrdQty>1200</compPrdQty>
        <compPrdVatCd>02</compPrdVatCd>
        <addUseYn>Y</addUseYn>
        <addPrdWght>1200</addPrdWght>
    </ProductComponent>
    <prdSelQty>1200</prdSelQty>
    <selMinLimitTypCd>00</selMinLimitTypCd>
    <selMinLimitQty>10</selMinLimitQty>
    <selLimitTypCd>01</selLimitTypCd>
    <selLimitQty>00</selLimitQty>
    <townSelLmtDy>00</townSelLmtDy>
    <useGiftYn>Y</useGiftYn>
    <ProductGift>
        <giftInfo>asdfadf</giftInfo>
        <giftNm>tksk</giftNm>
        <aplBgnDt>2020/12/12</aplBgnDt>
        <aplEndDt>2022/12/12</aplEndDt>
    </ProductGift>
    <gftPackTypCd>01</gftPackTypCd>
    <gblDlvYn>Y</gblDlvYn>
    <gblHsCode/>
    <dlvCnAreaCd>01</dlvCnAreaCd>
    <dlvWyCd>01</dlvWyCd>
    <dlvEtprsCd>00034</dlvEtprsCd>
    <dlvSendCloseTmpltNo>12000</dlvSendCloseTmpltNo>
    <dlvCstInstBasiCd>02</dlvCstInstBasiCd>
    <dlvCst1>12000</dlvCst1>
    <dlvCst3>12000</dlvCst3>
    <dlvCst4>12000</dlvCst4>
    <dlvCstInfoCd>01</dlvCstInfoCd>
    <PrdFrDlvBasiAmt>1200</PrdFrDlvBasiAmt>
    <dlvCnt1>1200</dlvCnt1>
    <dlvCnt2>1200</dlvCnt2>
    <bndlDlvCnYn>Y</bndlDlvCnYn>
    <dlvCstPayTypCd>01</dlvCstPayTypCd>
    <jejuDlvCst>1200</jejuDlvCst>
    <islandDlvCst>12200</islandDlvCst>
    <addrSeqOut>12000</addrSeqOut>
    <outsideYnOut>Y</outsideYnOut>
    <visitDlvYn>N</visitDlvYn>
    <visitDlvAddrSeq>12122</visitDlvAddrSeq>
    <addrSeqOutMemNo>1212</addrSeqOutMemNo>
    <addrSeqIn>12112</addrSeqIn>
    <outsideYnIn>Y</outsideYnIn>
    <addrSeqInMemNo>12111</addrSeqInMemNo>
    <abrdCnDlvCst>2000</abrdCnDlvCst>
    <rtngdDlvCst>2000</rtngdDlvCst>
    <exchDlvCst>12</exchDlvCst>
    <rtngdDlvCd>02</rtngdDlvCd>
    <asDetail>1221</asDetail>
    <rtngExchDetail>12</rtngExchDetail>
    <dlvClf>01</dlvClf>
    <abrdInCd>03</abrdInCd>
    <prdWght>12</prdWght>
    <ntShortNm>12</ntShortNm>
    <globalOutAddrSeq>12</globalOutAddrSeq>
    <mbAddrLocation05>01</mbAddrLocation05>
    <globalInAddrSeq>12</globalInAddrSeq>
    <mbAddrLocation06>01</mbAddrLocation06>
    <mnfcDy/>
    <eftvDy/>
    <ProductNotification>
        <type>12</type>
        <item>
        <code>1111</code>
        <name>2020/12/12</name>
        </item>
    </ProductNotification>
    <company>asdf</company>
    <modelNm>asdf</modelNm>
    <modelCd>asdf</modelCd>
    <mnfcDy>asdf</mnfcDy>
    <mainTitle/>
    <artist>asdf</artist>
    <mudvdLabel>asdf</mudvdLabel>
    <maker>asdf</maker>
    <albumNm>asdf</albumNm>
    <dvdTitle>asdf</dvdTitle>
    <bcktExYn>Y</bcktExYn>
    <prcCmpExpYn>Y</prcCmpExpYn>
    <stdPrdYn>12</stdPrdYn>
    <ProductTag>
        <tagName>12</tagName>
    </ProductTag>
</Product>
_EOT_;
*/
        $method = "POST";
        $curl = curl_init();
        $headers = array("Content-type: text/xml; charset=EUC-KR", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/prodservices/product");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result=curl_exec($curl);

        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//ClientMessage');
        
        $response = json_decode(json_encode((array)$retData), TRUE);
        //print_r($response);
        
        return($response);
    }

    /**
     *발송마감 템플렛등록(post)
     */
    public function addTemplate($data = "") {
        // if(empty($data)){
        //     return false;
        // }
        
        date_default_timezone_set("GMT+0");
        

        $xml = new SimpleXMLElement('<xml/>');
        
        for ($i = 1; $i <= 8; ++$i) {
            $track = $xml->addChild('track');
            $track->addChild('path', "song$i.mp3");
            $track->addChild('title', "Track $i - Track Title");
        }
        
        //echo $xml->asXML();

        $simplexml= new SimpleXMLElement('<?xml version="1.0" ?><books/>');

        $book1= $simplexml->addChild('book');
        $book1->addChild("booktitle", "The Wandering Oz");
        $book1->addChild("publicationdate", 2007);

        $book2= $simplexml->addChild('book');
        $book2->addChild("booktitle", "The Roaming Fox");
        $book2->addChild("publicationdate", 2009);  

        $book3= $simplexml->addChild('book');
        $book3->addChild("booktitle", "The Dominant Lion");
        $book3->addChild("publicationdate", 2012);  

        //echo $simplexml->asXML();
        //echo  response($simplexml, 200, ['Content-Type' => 'application/xml']);
        return response()->view('simplexml')->header('Content-Type', 'text/xml');
        // $curl = curl_init();        
        // $headers = array("Content-type: text/xml;charset=EUC-KR", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        // curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/prodservices/sendCloseTemplate");
        // curl_setopt($curl, CURLOPT_HEADER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // $result=curl_exec($curl);
        // $result;
        // return($result);
    }

    /**
     *발송마감 템플렛등록(post)
     */
    public function getTemplate($data = "") {
        // if(empty($data)){
        //     return false;
        // }
        
        date_default_timezone_set("GMT+0");
        

        $xml = new SimpleXMLElement('<xml/>');
        
        for ($i = 1; $i <= 8; ++$i) {
            $track = $xml->addChild('track');
            $track->addChild('path', "song$i.mp3");
            $track->addChild('title', "Track $i - Track Title");
        }
        
        $curl = curl_init();        
        $headers = array("Content-type: text/xml;charset=EUC-KR", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/prodservices/sendCloseTemplate");
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result=curl_exec($curl);
        //$result;
        return($result);
    }

    /**
     * 카테고리 목록 조회(get)
     */
    public function getCategoryListInfo($data = "") {
        // if(empty($data)){
        //     return false;
        // }
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/cateservice/category");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: application/json;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        

        //print_r($this->xml_to_object($result));
        //echo response()->json(["status" => "success", "data" => $this->xml_to_object($result)]);
        // $xml_string = simplexml_load_string($result) ;
        // $xmlData = $xml_string->asXML();
        // echo $xmlData;

        //$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result);
        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//ns2:category');
        
        // print_r($retData);
        $arrCategorys = json_decode(json_encode((array)$retData), TRUE);
        print_r($arrCategorys);

        // $simplexml= new SimpleXMLElement($xml_str);
        // creating object of SimpleXMLElement
        // $xml_data = simplexml_load_string($xml_string);
        // $xml_data = simplexml_load_string($xml_string, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);

        // saving generated xml file; 
        // echo ($xml_data->asXML());
        
        // $xml_string = mb_convert_encoding ($result, 'UTF-8', 'EUC-KR') ;
        // $p = xml_parser_create();
        // xml_parse_into_struct($p, $result, $values, $tags);
        // xml_parser_free($p);
        
        // $xml->asXML(); // outputs as UTF-8 (same as input by default)
        // print_r((array)$xml);
        // $xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
        // $json = json_encode($xml);
        // $arrayXML = json_decode($json,TRUE);
        // print_r($arrayXML);
        // return($result);
    }

    /**
     * 하위 카테고리 조회(get)
     */
    public function getCategoryInfo($categoryId = "1009412") {
        // if(empty($data)){
        //     return false;
        // }
        
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/cateservice/category/".$categoryId);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: application/json;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//ns2:category');
        print_r($retData);
        //$arrCategorys = json_decode(json_encode((array)$retData), TRUE);
        return $retData;
    }

    /**
     * 발송템플렛 조회(get)
     */
    public function getSendCloseTplListInfo() {
        // if(empty($data)){
        //     return false;
        // }
        
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/prodservices/sendCloseList");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: application/json;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//templateBOList');
        $arrTpls = json_decode(json_encode((array)$retData), TRUE);
        return $arrTpls;
    }

    /**
     * 출고지 목록 조회(get)
     */
    public function getOutboundListInfo() {
        // if(empty($data)){
        //     return false;
        // }
        
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/areaservice/outboundarea");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: application/json;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//ns2:inOutAddress');
        //print_r($retData);
        $arrOutbounds = json_decode(json_encode((array)$retData), TRUE);
        return $arrOutbounds;
    }

    /**
     * 반품지 목록 조회(get)
     */
    public function getInboundListInfo() {
        // if(empty($data)){
        //     return false;
        // }
        
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.11st.co.kr/rest/areaservice/inboundarea");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: application/json;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $xml = new SimpleXMLElement($result);
        $retData = $xml->xpath('//ns2:inOutAddress');

        $arrInbounds = json_decode(json_encode((array)$retData), TRUE);
        return $arrInbounds;
    }

    /**
     * 반품지 목록 조회(get)
     */
    public function getOrderServiceListInfo($startDate, $endDate) {
        // if(empty($data)){
        //     return false;
        // }
        
        $method = "GET";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.11st.co.kr/rest/ordservices/complete/".$startDate."/".$endDate);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        $headers = array("Content-type: text/xml;charset=euc-kr", "openapikey:".$this->ACCESS_API_KEY); //SampleKey 사용불가
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $result = <<<XML
<?xml version='1.0' encoding='euc-kr' standalone='yes'?>
<ns2orders>
    <ns2order>
    <addPrdNo>0</addPrdNo>
    <addPrdYn>N</addPrdYn>
    <bndlDlvSeq>4506571</bndlDlvSeq>
    <bndlDlvYN>Y</bndlDlvYN>
    <custGrdNm/>
    <dlvCst>0</dlvCst>
    <dlvCstType>03</dlvCstType>
    <bmDlvCst>4500</bmDlvCst>
    <bmDlvCstType>04</bmDlvCstType>
    <dlvNo>40860365</dlvNo>
    <gblDlvYn>N</gblDlvYn>
    <giftCd/>
    <memID>test11st</memID>
    <memNo>1111111</memNo>
    <ordAmt>19000</ordAmt>
    <ordBaseAddr>충북 청주시 상당구 용암동</ordBaseAddr>
    <ordDlvReqCont>null</ordDlvReqCont>
    <ordDt>2010-01-10 04:07:11</ordDt>
    <ordDtlsAddr>00번지</ordDtlsAddr>
    <ordMailNo>360100</ordMailNo>
    <ordNm>홍길동</ordNm>
    <ordNo>201001108318120</ordNo>
    <ordOptWonStl>0</ordOptWonStl>
    <ordPayAmt>16310</ordPayAmt>
    <ordPrdSeq>1</ordPrdSeq>
    <ordPrtblTel>010-9999-9999</ordPrtblTel>
    <ordQty>1</ordQty>
    <ordStlEndDt>2010-01-12 16:20:59</ordStlEndDt>
    <ordTlphnNo>070-9999-9999</ordTlphnNo>
    <prdNm>셔링 브이넥 니트 티셔츠</prdNm>
    <prdNo>29370295</prdNo>
    <prdStckNo>999999999</prdStckNo>
    <rcvrBaseAddr>충북 청주시 상당구 용암동</rcvrBaseAddr>
    <rcvrDtlsAddr>00번지 8809호</rcvrDtlsAddr>
    <rcvrMailNo>360100</rcvrMailNo>
    <rcvrMailNoSeq>011</rcvrMailNoSeq>
    <rcvrNm>홍길동</rcvrNm>
    <rcvrPrtblNo>010-9999-9999</rcvrPrtblNo>
    <rcvrTlphn>070-9999-9999</rcvrTlphn>
    <selPrc>19000</selPrc>
    <sellerDscPrc>2280</sellerDscPrc>
    <sellerPrdCd>000000000133275</sellerPrdCd>
    <slctPrdOptNm>사이즈/색상:사이즈 - S(66)/색상 - 아이보리 [0000346774]-1개</slctPrdOptNm>
    <tmallDscPrc>410</tmallDscPrc>
    <gifeser>1</gifeser>
    <typeAdd>01</typeAdd>
    <typeBilNo/>
    <lstTmallDscPrc>0</lstTmallDscPrc>
    <lstSellerDscPrc>0</lstSellerDscPrc>
    <referSeq>455221112</referSeq>
    <sellerStockCd>43434232</sellerStockCd>
    <appmtDdDlvDy>20170420</appmtDdDlvDy>
    <appmtEltRefuseYn/>
    <appmtselStockCd/>
    <engNm>CHULSU KIM</engNm>
    <psnCscUniqNo>P000000000000</psnCscUniqNo>
    <dlvSndDue>2019-05-30 04:07:11</dlvSndDue>
    <delaySendDt>2019-05-30 04:07:11</delaySendDt>
    <visitDlvYn/>
    </ns2order>
</ns2orders>
XML;
//$xml = simplexml_load_string($result);
$result = mb_convert_encoding ($result, 'EUC-KR', 'UTF-8') ;
        $xml = new SimpleXMLElement($result);
        //$xml = simplexml_load_string($result);
        //$retData = $xml->xpath('//ns2:order');authmessage


        $retData = [];
        if(isset($xml->AuthMessage)){
            
            $retData = $xml->xpath('//AuthMessage');
        }else{
            
            $retData = $xml->xpath('//ns2order');
        }
        $arrOrderInfos = $retData;//json_decode(json_encode((array)$retData), TRUE);
        return $arrOrderInfos;
    }

}