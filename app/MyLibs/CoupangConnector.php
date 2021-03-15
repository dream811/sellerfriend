<?php
namespace App\Mylibs;
 
class CoupangConnector {
    protected $ACCESS_KEY="1e9a79d6-06b6-4fa7-80ef-8f095e00d40a";
    protected $SECRET_KEY="0878a06ff9a041a977b8e2d9634694bfb85fc2d0";
    protected $VENDOR_ID="C00235119";
    protected $USER_ID="c00235119";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($accessKey="1e9a79d6-06b6-4fa7-80ef-8f095e00d40a", $secretKey="0878a06ff9a041a977b8e2d9634694bfb85fc2d0", $vendorId="C00235119", $userId="c00235119")
    {
        $this->ACCESS_KEY=$accessKey;
        $this->SECRET_KEY=$secretKey;
        $this->VENDOR_ID=$vendorId;
        $this->USER_ID=$userId;
        date_default_timezone_set("Asia/Seoul");

    }

    /**
     * 상품등록(post)
     */
    public function addProduct($strjson = "") {
        if(empty($strjson)){
            return false;
        }
        
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "POST";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/seller-products";
        
        $message = $datetime.$method.$path;
        
        $algorithm = "HmacSHA256";
        
        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);
        
        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;
        
        $url = 'https://api-gateway.coupang.com'.$path;
        
        //$image="<img src='http://image11.coupangcdn.com/image/product/content/vendorItem/2018/06/26/196713/738d905f-ed80-4fd8-ad21-ed87b195a19e.jpg'>";
        /*
        $strjson='
            {
                "displayCategoryCode": 56174,
                "sellerProductName": "상품등록_example",
                "vendorId": "'.$this->VENDOR_ID.'",
                "saleStartedAt": "2018-08-13T00:00:00",
                "saleEndedAt": "2099-01-01T23:59:59",
                "displayProductName": "해피바스 솝베리 클렌징 오일",
                "brand": "해피바스",
                "generalProductName": "솝베리 클렌징 오일",
                "productGroup": "클렌징 오일",
                "deliveryMethod": "SEQUENCIAL",
                "deliveryCompanyCode": "KGB",
                "deliveryChargeType": "FREE",
                "deliveryCharge": 0,
                "freeShipOverAmount": 0,
                "deliveryChargeOnReturn": 2500,
                "remoteAreaDeliverable": "N",
                "unionDeliveryType": "UNION_DELIVERY",
                "returnCenterCode": "1000274592",
                "returnChargeName": "반품지_1",
                "companyContactNumber": "02-1234-678",
                "returnZipCode": "135-090",
                "returnAddress": "서울특별시 강남구 삼성동",
                "returnAddressDetail": "333",
                "returnCharge": 2500,
                "returnChargeVendor": "N",
                "afterServiceInformation": "A/S안내 1544-1255",
                "afterServiceContactNumber": "1544-1255",
                "outboundShippingPlaceCode": "74010",
                "vendorUserId": "user01",
                "requested": false,
                "items": [
                    {
                        "itemName": "200ml_1개",
                        "originalPrice": 13000,
                        "salePrice": 10000,
                        "maximumBuyCount": "100",
                        "maximumBuyForPerson": "0",
                        "outboundShippingTimeDay": "1",
                        "maximumBuyForPersonPeriod": "1",
                        "unitCount": 1,
                        "adultOnly": "EVERYONE",
                        "taxType": "TAX",
                        "parallelImported": "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased": "NOT_OVERSEAS_PURCHASED",
                        "pccNeeded": "false",
                        "externalVendorSku": "0001",
                        "barcode": "",
                        "emptyBarcode": true,
                        "emptyBarcodeReason": "상품확인불가_바코드없음사유",
                        "modelNo": "1717171",
                        "extraProperties": null,
                        "certifications": [
                            {
                                "certificationType": "NOT_REQUIRED",
                                "certificationCode": ""
                            }
                        ],
                        "searchTags": [
                            "검색어1",
                            "검색어2"
                        ],
                        "images": [
                            {
                                "imageOrder": 0,
                                "imageType": "REPRESENTATION",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/25/3719529368/27a6b898-ff3b-4a27-b1e4-330a90c25e9c.jpg"
                            },
                            {
                                "imageOrder": 1,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2017/02/21/3000169918/34b79649-d625-4f49-a260-b78bf7a573a8.jpg"
                            },
                            {
                                "imageOrder": 2,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/28/3000169918/5716aa61-70bd-47cd-8f3d-f3d49e7f496d.jpg"
                            }
                        ],
                        "notices": [
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "용량(중량)",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제품 주요 사양",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용기한 또는 개봉 후 사용기간",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용방법",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제조업자 및 제조판매업자",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "제조국",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "화장품법에 따라 기재, 표시하여야 하는 모든 성분",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "식품의약품안전처 심사 필 유무",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "사용할 때 주의사항",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "품질보증기준",
                                "content": "제품 이상 시 공정거래위원회 고시 소비자분쟁해결기준에 의거 보상합니다."
                            },
                            {
                                "noticeCategoryName": "일반오일1",
                                "noticeCategoryDetailName": "소비자상담관련 전화번호",
                                "content": "상세페이지 참조"
                            }
                        ],
                        "attributes": [
                            {
                                "attributeTypeName": "수량",
                                "attributeValueName": "1개"
                            },
                            {
                                "attributeTypeName": "개당 용량",
                                "attributeValueName": "200ml"
                            }
                        ],
                        "contents": [
                            {
                                "contentsType": "TEXT",
                                "contentDetails": [
                                    {
                                        "content": "'.$image.'",
                                        "detailType": "TEXT"
                                    }
                                ]
                            }
                        ],
                        "offerCondition": "NEW",
                        "offerDescription": ""
                    },
                    
                ],
                "requiredDocuments": [
                    {
                        "templateName": "기타인증서류",
                        "vendorDocumentPath": "http://image11.coupangcdn.com/image/product/content/vendorItem/2018/07/02/41579010/eebc0c30-8f35-4a51-8ffd-808953414dc1.jpg"
                    }
                ],
                "extraInfoMessage": "",
                "manufacture": "아모레퍼시픽"
            }
        ';
        */
        //echo $strjson;
        //print nl2br($strjson);
        
        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization)); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        //return($httpcode);
        
        return($result);
    }
    /**
     * 상품수정(put)
     */
    public function editProduct() {
        date_default_timezone_set("GMT+0");
        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "PUT";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/seller-products";

        $message = $datetime.$method.$path;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path;

        $strjson=`
            {
                "sellerProductId": 309323422,
                "displayCategoryCode": 56137,
                "sellerProductName": "상품수정_example",
                "vendorId": "A00012345",
                "saleStartedAt": "2017-11-30T00:00:00",
                "saleEndedAt": "2099-01-01T23:59:59",
                "displayProductName": "해피바스 솝베리 클렌징 오일",
                "brand": "해피바스",
                "generalProductName": "솝베리 클렌징 오일",
                "productGroup": "클렌징 오일",
                "deliveryMethod": "SEQUENCIAL",
                "deliveryCompanyCode": "KGB",
                "deliveryChargeType": "FREE",
                "deliveryCharge": 0,
                "freeShipOverAmount": 0,
                "deliveryChargeOnReturn": 2500,
                "remoteAreaDeliverable": "N",
                "unionDeliveryType": "UNION_DELIVERY",
                "returnCenterCode": "1000274592",
                "returnChargeName": "반품지_1",
                "companyContactNumber": "02-1234-678",
                "returnZipCode": "135-090",
                "returnAddress": "서울특별시 강남구 삼성동",
                "returnAddressDetail": "333",
                "returnCharge": 2500,
                "returnChargeVendor": "N",
                "afterServiceInformation": "A/S안내 1544-1255",
                "afterServiceContactNumber": "1544-1255",
                "outboundShippingPlaceCode": "74010",
                "vendorUserId": "user01",
                "requested": false,
                "items": [
                    {
                        "sellerProductItemId": 769536471,
                        "itemName": "200ml_1개",
                        "originalPrice": 13000,
                        "salePrice": 10000,
                        "maximumBuyCount": "100",
                        "maximumBuyForPerson": "0",
                        "outboundShippingTimeDay": "1",
                        "maximumBuyForPersonPeriod": "1",
                        "unitCount": 1,
                        "adultOnly": "EVERYONE",
                        "taxType": "TAX",
                        "parallelImported": "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased": "NOT_OVERSEAS_PURCHASED",
                        "pccNeeded": "false",
                        "externalVendorSku": "0001",
                        "barcode": "",
                        "emptyBarcode": true,
                        "emptyBarcodeReason": "상품확인불가_바코드없음사유",
                        "modelNo": "171717",
                        "extraProperties": null,
                        "certifications": [
                            {
                                "certificationType": "NOT_REQUIRED",
                                "certificationCode": ""
                            }
                        ],
                        "searchTags": [
                            "검색어1",
                            "검색어2"
                        ],
                        "images": [
                            {
                                "imageOrder": 0,
                                "imageType": "REPRESENTATION",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/25/3719529368/27a6b898-ff3b-4a27-b1e4-330a90c25e9c.jpg"
                            },
                            {
                                "imageOrder": 1,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2017/02/21/3000169918/34b79649-d625-4f49-a260-b78bf7a573a8.jpg"
                            },
                            {
                                "imageOrder": 2,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/28/3000169918/5716aa61-70bd-47cd-8f3d-f3d49e7f496d.jpg"
                            }
                        ],
                        "notices": [
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "용량(중량)",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제품 주요 사양",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용기한 또는 개봉 후 사용기간",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용방법",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제조업자 및 제조판매업자",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제조국",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "화장품법에 따라 기재, 표시하여야 하는 모든 성분",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "식품의약품안전처 심사 필 유무",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용할 때 주의사항",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "품질보증기준",
                                "content": "제품 이상 시 공정거래위원회 고시 소비자분쟁해결기준에 의거 보상합니다."
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "소비자상담관련 전화번호",
                                "content": "상세페이지 참조"
                            }
                        ],
                        "attributes": [
                            {
                                "attributeTypeName": "수량",
                                "attributeValueName": "1개"
                            },
                            {
                                "attributeTypeName": "개당 용량",
                                "attributeValueName": "200ml"
                            }
                        ],
                        "contents": [
                            {
                                "contentsType": "TEXT",
                                "contentDetails": [
                                    {
                                        "content": "<img src='http://image11.coupangcdn.com/image/product/content/vendorItem/2018/06/26/196713/738d905f-ed80-4fd8-ad21-ed87b195a19e.jpg' />",
                                        "detailType": "TEXT"
                                    }
                                ]
                            }
                        ],
                        "offerCondition": "NEW",
                        "offerDescription": ""
                    },
                    {
                        "sellerProductItemId": 769536472,
                        "itemName": "200ml_2개",
                        "originalPrice": 26000,
                        "salePrice": 20000,
                        "maximumBuyCount": "100",
                        "maximumBuyForPerson": "0",
                        "outboundShippingTimeDay": "2",
                        "maximumBuyForPersonPeriod": "1",
                        "unitCount": 1,
                        "adultOnly": "EVERYONE",
                        "taxType": "TAX",
                        "parallelImported": "NOT_PARALLEL_IMPORTED",
                        "overseasPurchased": "NOT_OVERSEAS_PURCHASED",
                        "pccNeeded": "false",
                        "externalVendorSku": "0001",
                        "barcode": "",
                        "emptyBarcode": true,
                        "emptyBarcodeReason": "상품확인불가_바코드없음사유",
                        "modelNo": "171717",
                        "extraProperties": {
                            "GOODS_SEQ":"1",
                            "optuid":"18788597"
                        },
                        "certifications": [
                            {
                                "certificationType": "NOT_REQUIRED",
                                "certificationCode": ""
                            }
                        ],
                        "searchTags": [
                            "검색어1",
                            "검색어2"
                        ],
                        "images": [
                            {
                                "imageOrder": 0,
                                "imageType": "REPRESENTATION",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/26/3001519145/74100e2a-d1ad-4b50-9c78-840c12a3e10d.jpg"
                            },
                            {
                                "imageOrder": 1,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2017/02/21/3000169918/34b79649-d625-4f49-a260-b78bf7a573a8.jpg"
                            },
                            {
                                "imageOrder": 2,
                                "imageType": "DETAIL",
                                "vendorPath": "http://image11.coupangcdn.com/image/product/image/vendoritem/2018/06/28/3000169918/5716aa61-70bd-47cd-8f3d-f3d49e7f496d.jpg"
                            }
                        ],
                        "notices": [
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "용량(중량)",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제품 주요 사양",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용기한 또는 개봉 후 사용기간",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용방법",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제조업자 및 제조판매업자",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "제조국",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "화장품법에 따라 기재, 표시하여야 하는 모든 성분",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "식품의약품안전처 심사 필 유무",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "사용할 때 주의사항",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "품질보증기준",
                                "content": "상세페이지 참조"
                            },
                            {
                                "noticeCategoryName": "화장품",
                                "noticeCategoryDetailName": "소비자상담관련 전화번호",
                                "content": "상세페이지 참조"
                            }
                        ],
                        "attributes": [
                            {
                                "attributeTypeName": "수량",
                                "attributeValueName": "2개"
                            },
                            {
                                "attributeTypeName": "개당 용량",
                                "attributeValueName": "200ml"
                            }
                        ],
                        "contents": [
                            {
                                "contentsType": "TEXT",
                                "contentDetails": [
                                    {
                                        "content": "<img src='http://image11.coupangcdn.com/image/product/content/vendorItem/2018/06/26/196713/738d905f-ed80-4fd8-ad21-ed87b195a19e.jpg' />",
                                        "detailType": "TEXT"
                                    }
                                ]
                            }
                        ],
                        "offerCondition": "NEW",
                        "offerDescription": ""
                    }
                ],
                "requiredDocuments": [
                    {
                        "templateName": "기타인증서류",
                        "vendorDocumentPath": "http://image11.coupangcdn.com/image/product/content/vendorItem/2018/07/02/41579010/eebc0c30-8f35-4a51-8ffd-808953414dc1.jpg"
                    }
                ],
                "extraInfoMessage": "",
                "manufacture": "아모레퍼시픽"
            }
        `;

        print nl2br($strjson);

        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization,"X-EXTENDED-TIMEOUT:60000")); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        echo($httpcode);

        echo($result);
    }
    /**
     * 카테고리 메타정보 조회(get)
     */
    public function getCategoryMetaInfo($category_code = 78877) {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/meta/category-related-metas/display-category-codes/".$category_code;
        $query = "";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }

    /**
     * 카테고리 목록 조회(get)
     */
    public function getCategoryListInfo() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/meta/display-categories";
        $query = "";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        echo($httpcode);

        echo($result);
    }
    /**
     * 특정카테고리 코드를 리용해 카테고리 목록 조회(get)
     */
    public function getCategoryInfoViaCode($category_code = 0) {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/meta/display-categories/".$category_code;
        $query = "";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }
    /**
     * 반품/취소 요청목록 조회(get)
     */
    public function getCancelReqestList() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/openapi/apis/api/v4/vendors/A000*****/returnRequests";
        $query = "createdAtFrom=2019-11-29&createdAtTo=2019-11-29&status=UC";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        echo($httpcode);

        echo($result);
    }
    /**
     * 상품 아이템별 가격변경(put)
     */
    public function editItemPrice() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "PUT";
        //replace with your own vendorItemId and price
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/vendor-items/703********/prices/1200***";
        $query = "forceSalePriceUpdate=true";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization,"X-EXTENDED-TIMEOUT:60000")); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        echo($httpcode);

        echo($result);
    }
    /**
     * 상품 삭제(delete)
     */
    public function deleteProduct() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "DELETE";
        $path = "/v2/providers/seller_api/apis/api/v1/marketplace/seller-products/2401";

        $message = $datetime.$method.$path;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path;

        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization)); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);

        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        echo($httpcode);
        echo($result);
    }
    /**
     * 출고지 생성(test ok)
     */
    public function addOutboundShippingCenter() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "POST";
        $path = "/v2/providers/openapi/apis/api/v4/vendors/{$this->VENDOR_ID}/outboundShippingCenters";
        
        $message = $datetime.$method.$path;
        
        $algorithm = "HmacSHA256";
        
        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);
        
        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;
        
        $url = 'https://api-gateway.coupang.com'.$path;
        
        $strjson='
        {
            "vendorId": "'.$this->VENDOR_ID.'",
            "userId": "'.$this->USER_ID.'",
            "shippingPlaceName": "상품출고지1",
            "global": "false",
            "usable": "true",
            "placeAddresses": [
              {
                "addressType": "JIBUN",
                "countryCode": "KR",
                "companyContactNumber": "02-1234-5678",
                "phoneNumber2": "010-1234-5678",
                "returnZipCode": "10516",
                "returnAddress": "경기도 파주시 탄현면 월롱산로",
                "returnAddressDetail": "294-58"
              }
            ],
            "remoteInfos": [
              {
                "deliveryCode": "KGB",
                "jeju": "5000",
                "notJeju": "2500"
              },
              {
                "deliveryCode": "CJGLS",
                "jeju": "5000",
                "notJeju": "2500"
              }
            ]
        }
        ';
        echo $strjson;
        print nl2br($strjson);
        
        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization)); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        echo($httpcode);
        
        echo($result);
    }
    
    /**
     * 출고지 정보 조회 (목록)
     */
    public function getOutboundShippingCenterList($page_size = 50, $page_number = 1){
        date_default_timezone_set("GMT+0");


        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/marketplace_openapi/apis/api/v1/vendor/shipping-place/outbound";
        $query = "pageSize=".$page_size."&pageNum=".$page_number;

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        // echo($result);
        return $result;
    }
    /**
     * 출고지 정보 조회 (개별)
     */
    public function getOutboundShippingCenterInfo($place_names = "", $place_codes = 3384548){
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/marketplace_openapi/apis/api/v1/vendor/shipping-place/outbound";
        $query = "placeCodes=".$place_codes;

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }
    /**
     * 반품지 생성(test ok)
     */
    public function addReturnShippingCenter() {
        date_default_timezone_set("GMT+0");

        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "POST";
        $path = "/v2/providers/openapi/apis/api/v4/vendors/{$this->VENDOR_ID}/returnShippingCenters";
        
        $message = $datetime.$method.$path;
        
        $algorithm = "HmacSHA256";
        
        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);
        
        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;
        
        $url = 'https://api-gateway.coupang.com'.$path;
        
        $strjson='
        {
            "vendorId": "'.$this->VENDOR_ID.'",
            "userId": "'.$this->USER_ID.'",
            "shippingPlaceName": "반품지01",
            "goodsflowInfoOpenApiDto": {
                "deliverCode": "CJGLS",
                "contractNumber": "85500067",
                "contractCustomerNumber": "",
                "vendorCreditFee05kg": "2500",
                "vendorCreditFee10kg": "2500",
                "vendorCreditFee20kg": "2500",
                "vendorCashFee05kg": "2500",
                "vendorCashFee10kg": "2500",
                "vendorCashFee20kg": "2500",
                "consumerCashFee05kg": "2500",
                "consumerCashFee10kg": "2500",
                "consumerCashFee20kg": "2500",
                "returnFee05kg": "2500",
                "returnFee10kg": "2500",
                "returnFee20kg": "2500"
            },
            "placeAddresses": [
                {
                "addressType": "JIBUN",
                "companyContactNumber": "02-1234-5678",
                "phoneNumber2": "",
                "returnZipCode": "112207",
                "returnAddress": "경기도 파주시 탄현면 월롱산로",
                "returnAddressDetail": "294-58"
                }
            ]
        }
        ';
        print nl2br($strjson);
        
        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization)); 		
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        echo($httpcode);
        
        echo($result);
    }
    /**
     * 반품지 정보 조회 (목록)
     */
    public function getReturnShippingCenterList($page_size = 50, $page_number = 1){
        date_default_timezone_set("GMT+0");


        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/openapi/apis/api/v4/vendors/{$this->VENDOR_ID}/returnShippingCenters";
        $query = "pageNum={$page_number}&pageSize={$page_size}";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }
    /**
     * 반품지 정보 조회 (개별)
     */
    public function getReturnShippingCenterInfo($returnCenterCodes = "1000000051"){
        date_default_timezone_set("GMT+0");


        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "GET";
        $path = "/v2/providers/greatwall_api/apis/api/v2/return/shipping-places/center-code";
        $query = "returnCenterCodes={$returnCenterCodes}";

        $message = $datetime.$method.$path.$query;

        $algorithm = "HmacSHA256";

        $signature = hash_hmac('sha256', $message, $this->SECRET_KEY);

        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$this->ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;

        $url = 'https://api-gateway.coupang.com'.$path.'?'.$query;
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization, "X-EXTENDED-TIMEOUT:90000"));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        //echo($httpcode);

        //echo($result);
        return $result;
    }
}