<?php
namespace App\Mylibs;
 
class ScrapperAPI {
    protected $KEY="tel18563102241";
    protected $SECRET="20210422";
    protected $APP_KIND="1688";
    protected $API_NAME="item_get";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($accessKey="tel18563102241", $secretKey="20210422", $appKind="1688", $apiName="item_get")
    {
        $this->KEY=$accessKey;
        $this->SECRET=$secretKey;
        $this->APP_KIND=$appKind;
        $this->API_NAME=$apiName;
        date_default_timezone_set("Asia/Seoul");
    }

    public function getCategoryMetaInfo($apiKind="1688", $itemId = 78877) {
        $this->API_NAME = "item_get";
        $this->APP_KIND = $apiKind;
        $method = "GET";
        $url = 'https://api-gw.onebound.cn/'.$this->APP_KIND.'/item_get/?key='.$this->KEY.'&num_iid='.$itemId.'&&lang=zh-CN&secret='.$this->SECRET;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $result;

        $result='{
                "item": {
                    "num_iid": "639741530227",
                    "title": "220克全棉翻领T恤印logo 企业团体工作服定做 纯棉男女polo衫定制",
                    "desc_short": "",
                    "price": "39.00",
                    "total_price": 0,
                    "suggestive_price": "39.00",
                    "orginal_price": "43.00",
                    "nick": "深圳市华造实业有限公司",
                    "num": "55876",
                    "detail_url": "https://detail.1688.com/offer/639741530227.html",
                    "pic_url": "https://cbu01.alicdn.com/img/ibank/O1CN01W1rmt71W6xsm39efh_!!2207146052740-0-cib.jpg",
                    "brand": "",
                    "brandId": "",
                    "rootCatId": "",
                    "cid": "122232007",
                    "desc": "<div id=\"offer-template-0\"></div><p><img src=\"https://cbu01.alicdn.com/img/ibank/O1CN01iWAeFQ1W6xsnlmn2S_!!2207146052740-0-cib.jpg\" usemap=\"#WCGGI\" /><map name=\"WCGGI\"></map></p><p>&nbsp;</p><p><span >工作服 厂服 工衣 polo衫 广东工作服定制 深圳工作服定制 纯棉polo衫定做 印logo 绣花 东莞polo衫定制 全棉翻领T恤衫定制 北京polo衫定制</span></p><p>&nbsp;<img alt=\"商品信息.jpg\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01IiH3SW1W6xsnoSD2e_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"undefined\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01qCE1tY1W6xsnPPJjX_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_15\" height=\"1292\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN010XbFAJ1W6xsqiahbS_!!2207146052740-0-cib.jpg\" width=\"787\" /><br /><br /><br /><img alt=\"1_22\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN013PXWTf1W6xslXZwze_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_21\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01040Cso1W6xst0QJGH_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_20\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN014CRZ1Y1W6xssZLLLD_!!2207146052740-0-cib.jpg\" /><br /><br /><img alt=\"1_19\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01Uaxq381W6xssZLg7E_!!2207146052740-0-cib.jpg\" /><br /><br /><img alt=\"1_18\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01X60QXL1W6xsvWEl3C_!!2207146052740-0-cib.jpg\" /><br /><br /><img alt=\"1_17\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01q7R0d21W6xsnR1Lo8_!!2207146052740-0-cib.jpg\" /><br /><br /><br /><br /><img alt=\"1_07\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01E63dxG1W6xssaFfPF_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_05\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01L6bkRg1W6xsqSt30R_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_06\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01jgpils1W6xsqSrN2x_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_09\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01tzEMPR1W6xst1GLBQ_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_08仓库\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN011v2Elb1W6xsqRQU5e_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_10定制\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01iIrYsv1W6xsqjbTGY_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_11\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01FwMwSb1W6xslYU0Uu_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_12\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01K8v8lA1W6xsvXAQWZ_!!2207146052740-0-cib.jpg\" /><br /><img alt=\"1_13\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN014pKT5l1W6xsvXBMiQ_!!2207146052740-0-cib.jpg\" /></p><div id=\"offer-template-1452144038967\"></div><p><img alt=\"undefined\" src=\"https://cbu01.alicdn.com/img/ibank/O1CN01qCE1tY1W6xsnPPJjX_!!2207146052740-0-cib.jpg\" /><br /><br />&nbsp;</p>",
                    "item_imgs": [
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01W1rmt71W6xsm39efh_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN018lVhXV1W6xssvaMBW_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01K8ccNg1W6xspPKbHs_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01OaOTgN1W6xstZeSxX_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01UGdPXF1W6xsphqrWL_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01YG0oWJ1W6xsv2QkfC_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01FJSyax1W6xsmR0pu6_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01rjtTwK1W6xsuVWGbN_!!2207146052740-0-cib.jpg"
                        },
                        {
                            "url": "https://cbu01.alicdn.com/img/ibank/O1CN01UyFPl41W6xsfpD0x9_!!2207146052740-0-cib.jpg"
                        }
                    ],
                    "item_weight": "",
                    "post_fee": "",
                    "express_fee": "",
                    "ems_fee": "",
                    "shipping_to": "",
                    "video": [],
                    "sample_id": "",
                    "props_name": "0:0:색깔:하얀;0:1:색깔:빨간;0:2:색깔:노랑;0:3:색깔:회색;0:4:색깔:검정;0:5:색깔:彩蓝色;0:6:색깔:티베트 블루;0:7:색깔:果绿色;1:0:크기:S;1:1:크기:M;1:2:크기:L;1:3:크기:XL;1:4:크기:XXL;1:5:크기:XXXL;1:6:크기:XXXXL",
                    "prop_imgs": {
                        "prop_img": [
                            {
                                "properties": "0:0",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01SB7fiC1W6xsv2Eo08_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:1",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01SX5RrT1W6xspiReoG_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:2",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01rjtTwK1W6xsuVWGbN_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:3",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01ns8rvI1W6xsrZIg90_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:4",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01FJSyax1W6xsmR0pu6_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:5",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01YG0oWJ1W6xsv2QkfC_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:6",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01UyFPl41W6xsfpD0x9_!!2207146052740-0-cib.jpg"
                            },
                            {
                                "properties": "0:7",
                                "url": "https://cbu01.alicdn.com/img/ibank/O1CN01q1LwrZ1W6xspRpoQ7_!!2207146052740-0-cib.jpg"
                            }
                        ]
                    },
                    "property_alias": "0:0:하얀;1:0:S;0:0:하얀;1:1:M;0:0:하얀;1:2:L;0:0:하얀;1:3:XL;0:0:하얀;1:4:XXL;0:0:하얀;1:5:XXXL;0:0:하얀;1:6:XXXXL;0:1:빨간;1:0:S;0:1:빨간;1:1:M;0:1:빨간;1:2:L;0:1:빨간;1:3:XL;0:1:빨간;1:4:XXL;0:1:빨간;1:5:XXXL;0:1:빨간;1:6:XXXXL;0:2:노랑;1:0:S;0:2:노랑;1:1:M;0:2:노랑;1:2:L;0:2:노랑;1:3:XL;0:2:노랑;1:4:XXL;0:2:노랑;1:5:XXXL;0:2:노랑;1:6:XXXXL;0:3:회색;1:0:S;0:3:회색;1:1:M;0:3:회색;1:2:L;0:3:회색;1:3:XL;0:3:회색;1:4:XXL;0:3:회색;1:5:XXXL;0:3:회색;1:6:XXXXL;0:4:검정;1:0:S;0:4:검정;1:1:M;0:4:검정;1:2:L;0:4:검정;1:3:XL;0:4:검정;1:4:XXL;0:4:검정;1:5:XXXL;0:4:검정;1:6:XXXXL;0:5:彩蓝色;1:0:S;0:5:彩蓝色;1:1:M;0:5:彩蓝色;1:2:L;0:5:彩蓝色;1:3:XL;0:5:彩蓝色;1:4:XXL;0:5:彩蓝色;1:5:XXXL;0:5:彩蓝色;1:6:XXXXL;0:6:티베트 블루;1:0:S;0:6:티베트 블루;1:1:M;0:6:티베트 블루;1:2:L;0:6:티베트 블루;1:3:XL;0:6:티베트 블루;1:4:XXL;0:6:티베트 블루;1:5:XXXL;0:6:티베트 블루;1:6:XXXXL;0:7:果绿色;1:0:S;0:7:果绿色;1:1:M;0:7:果绿色;1:2:L;0:7:果绿色;1:3:XL;0:7:果绿色;1:4:XXL;0:7:果绿色;1:5:XXXL;0:7:果绿色;1:6:XXXXL",
                    "props": [
                        {
                            "name": "소스 카테고리",
                            "value": "자리"
                        },
                        {
                            "name": "스타일",
                            "value": "基础大众"
                        },
                        {
                            "name": "소매 길이",
                            "value": "짧은 소매"
                        },
                        {
                            "name": "版型",
                            "value": "合体型"
                        },
                        {
                            "name": "무늬",
                            "value": "단단한 색깔"
                        },
                        {
                            "name": "特殊工艺",
                            "value": "水洗"
                        },
                        {
                            "name": "두께",
                            "value": "普通"
                        },
                        {
                            "name": "적절한 계절",
                            "value": "여름"
                        },
                        {
                            "name": "타오 상품 카테고리",
                            "value": "时尚都市（24-35岁）"
                        },
                        {
                            "name": "품목 번호",
                            "value": "511HZ"
                        },
                        {
                            "name": "연도 / 시즌",
                            "value": "봄 2021."
                        },
                        {
                            "name": "패브릭 이름",
                            "value": "코튼 콤비네이션"
                        },
                        {
                            "name": "주 직물 성분의 내용",
                            "value": "100"
                        },
                        {
                            "name": "주요 직물 성분",
                            "value": "면"
                        },
                        {
                            "name": "해당 장면",
                            "value": "上班"
                        },
                        {
                            "name": "재고 유형",
                            "value": "전부의"
                        },
                        {
                            "name": "색깔",
                            "value": "白色,红色,黄色,灰色,黑色,彩蓝色,藏青色,果绿色"
                        },
                        {
                            "name": "크기",
                            "value": "S,M,L,XL,XXL,XXXL,XXXXL"
                        },
                        {
                            "name": "주 다운 스트림 플랫폼",
                            "value": "eBay, 아마존, 소원, Aliexpress, 분리 된 역, Lazada"
                        },
                        {
                            "name": "주요 판매 영역",
                            "value": "아프리카, 유럽, 남미, 동남아시아, 북미, 동북 아시아, 중동"
                        },
                        {
                            "name": "접근 가능한 자기 브랜드",
                            "value": "예"
                        },
                        {
                            "name": "국경 간 수출이 공급 전용 여부",
                            "value": "예"
                        },
                        {
                            "name": "服装款式细节",
                            "value": "开衩"
                        },
                        {
                            "name": "원래 디자인",
                            "value": "예"
                        },
                        {
                            "name": "품질 검사 보고서",
                            "value": "아니"
                        }
                    ],
                    "total_sold": "1",
                    "scale": "",
                    "sellUnit": "",
                    "skus": {
                        "sku": [
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "21",
                                "properties": "0:0;1:0",
                                "properties_name": "0:0:색깔:하얀;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662214",
                                "spec_id": "94d1d179497744028aa76873afdeba62"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "175",
                                "properties": "0:0;1:1",
                                "properties_name": "0:0:색깔:하얀;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662215",
                                "spec_id": "cef93beef156f1799e736c649f36efae"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "521",
                                "properties": "0:0;1:2",
                                "properties_name": "0:0:색깔:하얀;1:2:크기:L",
                                "quantity": "998",
                                "sku_id": "4759768662216",
                                "spec_id": "82114cbd2c10b5e97b01af1510807e2d"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "184",
                                "properties": "0:0;1:3",
                                "properties_name": "0:0:색깔:하얀;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662217",
                                "spec_id": "c45d8408137e34adf8e695250c42a2e9"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "93",
                                "properties": "0:0;1:4",
                                "properties_name": "0:0:색깔:하얀;1:4:크기:XXL",
                                "quantity": "999",
                                "sku_id": "4759768662218",
                                "spec_id": "df78564262818d6eb0c428a37ab4a251"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "10",
                                "properties": "0:0;1:5",
                                "properties_name": "0:0:색깔:하얀;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662219",
                                "spec_id": "e36b5ea0b0624852e776139a5e97d448"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "10",
                                "properties": "0:0;1:6",
                                "properties_name": "0:0:색깔:하얀;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662220",
                                "spec_id": "2f98b4a58a7ad50a7938e7bc67e4fd9a"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "10",
                                "properties": "0:1;1:0",
                                "properties_name": "0:1:색깔:빨간;1:0:크기:S",
                                "quantity": "994",
                                "sku_id": "4759768662221",
                                "spec_id": "4b3436849e25eacb755f6f29ea09e809"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "28",
                                "properties": "0:1;1:1",
                                "properties_name": "0:1:색깔:빨간;1:1:크기:M",
                                "quantity": "982",
                                "sku_id": "4759768662222",
                                "spec_id": "a105e7d232cfb509d4253d59cfe30bbd"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "55",
                                "properties": "0:1;1:2",
                                "properties_name": "0:1:색깔:빨간;1:2:크기:L",
                                "quantity": "955",
                                "sku_id": "4759768662223",
                                "spec_id": "3dbe840b47bcb8f849bff38fc1f049fb"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "26",
                                "properties": "0:1;1:3",
                                "properties_name": "0:1:색깔:빨간;1:3:크기:XL",
                                "quantity": "984",
                                "sku_id": "4759768662224",
                                "spec_id": "ce7fb37f848bc060cfece58cfbe38c19"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "23",
                                "properties": "0:1;1:4",
                                "properties_name": "0:1:색깔:빨간;1:4:크기:XXL",
                                "quantity": "979",
                                "sku_id": "4759768662225",
                                "spec_id": "17a001fccdc38e767030004ac03b8881"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "13",
                                "properties": "0:1;1:5",
                                "properties_name": "0:1:색깔:빨간;1:5:크기:XXXL",
                                "quantity": "987",
                                "sku_id": "4759768662226",
                                "spec_id": "4455da11dac1943daf05752397817392"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "1",
                                "properties": "0:1;1:6",
                                "properties_name": "0:1:색깔:빨간;1:6:크기:XXXXL",
                                "quantity": "999",
                                "sku_id": "4759768662227",
                                "spec_id": "3a7eb19c8862a0c5f0c5ecc3046e8453"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:2;1:0",
                                "properties_name": "0:2:색깔:노랑;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662228",
                                "spec_id": "f7cfb00a132043840d0115e49050bd67"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "1",
                                "properties": "0:2;1:1",
                                "properties_name": "0:2:색깔:노랑;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662229",
                                "spec_id": "ff1d933eb41d9e32beaf1b0064537a3d"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "2",
                                "properties": "0:2;1:2",
                                "properties_name": "0:2:색깔:노랑;1:2:크기:L",
                                "quantity": "999",
                                "sku_id": "4759768662230",
                                "spec_id": "9a826b44d8958d60b1e85e0f33920056"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:2;1:3",
                                "properties_name": "0:2:색깔:노랑;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662231",
                                "spec_id": "ed81697906683a5320d8095bff5b25e8"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:2;1:4",
                                "properties_name": "0:2:색깔:노랑;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4759768662232",
                                "spec_id": "a4ce0721f1ec34c206516ba8a1e09868"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:2;1:5",
                                "properties_name": "0:2:색깔:노랑;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662233",
                                "spec_id": "1bde0e25a51649d2405515d6acfc538c"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:2;1:6",
                                "properties_name": "0:2:색깔:노랑;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662234",
                                "spec_id": "c5e46d860566585056467c4595a0c5a0"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:3;1:0",
                                "properties_name": "0:3:색깔:회색;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662235",
                                "spec_id": "b4ec52b39f4c3cb76bf667d126591349"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "20",
                                "properties": "0:3;1:1",
                                "properties_name": "0:3:색깔:회색;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662236",
                                "spec_id": "2e578fba8900edcb236eff5cdc5eefb5"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "20",
                                "properties": "0:3;1:2",
                                "properties_name": "0:3:색깔:회색;1:2:크기:L",
                                "quantity": "1000",
                                "sku_id": "4759768662237",
                                "spec_id": "43b0e72e98731aed69e1f0cc7d64bf4d"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "100",
                                "properties": "0:3;1:3",
                                "properties_name": "0:3:색깔:회색;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662238",
                                "spec_id": "893746f5330dc3273d24aa1ac1a9a8b5"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "20",
                                "properties": "0:3;1:4",
                                "properties_name": "0:3:색깔:회색;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4759768662239",
                                "spec_id": "42d994cba0210528142a743d4069700f"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:3;1:5",
                                "properties_name": "0:3:색깔:회색;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662240",
                                "spec_id": "23424d07d2e30e4f94821ebb808306a1"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:3;1:6",
                                "properties_name": "0:3:색깔:회색;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662241",
                                "spec_id": "016bbf0c2e4b5a273892c9dcab53fec9"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:4;1:0",
                                "properties_name": "0:4:색깔:검정;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662242",
                                "spec_id": "eb81c61de14f4adb405ffcc2c8a4a3fb"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "1",
                                "properties": "0:4;1:1",
                                "properties_name": "0:4:색깔:검정;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662243",
                                "spec_id": "4b2120e532948daa11e58e09bb260801"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "1",
                                "properties": "0:4;1:2",
                                "properties_name": "0:4:색깔:검정;1:2:크기:L",
                                "quantity": "1000",
                                "sku_id": "4759768662244",
                                "spec_id": "b99ece08861a79e13a4dba90e97ebff8"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:4;1:3",
                                "properties_name": "0:4:색깔:검정;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662245",
                                "spec_id": "5c337082186ff55b2d8267560ac89d59"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:4;1:4",
                                "properties_name": "0:4:색깔:검정;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4759768662246",
                                "spec_id": "dc048f4577f72dd6b932615edef1fab6"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:4;1:5",
                                "properties_name": "0:4:색깔:검정;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662247",
                                "spec_id": "02d07207e1c160be04819b06fec91879"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:4;1:6",
                                "properties_name": "0:4:색깔:검정;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662248",
                                "spec_id": "d5721b1da3a0fa2c26dd6cca96fa4057"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "24",
                                "properties": "0:5;1:0",
                                "properties_name": "0:5:색깔:彩蓝色;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662249",
                                "spec_id": "2742c29225c2e82f91e51e9a6c54401f"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "136",
                                "properties": "0:5;1:1",
                                "properties_name": "0:5:색깔:彩蓝色;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662250",
                                "spec_id": "d54091524b7989935fd8e26d75d7f27c"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "104",
                                "properties": "0:5;1:2",
                                "properties_name": "0:5:색깔:彩蓝色;1:2:크기:L",
                                "quantity": "1000",
                                "sku_id": "4759768662251",
                                "spec_id": "3b43e98d32a2bae97fb2f74ca63e9212"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "132",
                                "properties": "0:5;1:3",
                                "properties_name": "0:5:색깔:彩蓝色;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662252",
                                "spec_id": "c731e48b52f47ad7b90f17d4cc3ca1eb"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "124",
                                "properties": "0:5;1:4",
                                "properties_name": "0:5:색깔:彩蓝色;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4759768662253",
                                "spec_id": "175bb1ca9fb35f5afdf010b86adad4b3"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "10",
                                "properties": "0:5;1:5",
                                "properties_name": "0:5:색깔:彩蓝色;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662254",
                                "spec_id": "40d55a048680cbbfb795c8624c0a187a"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "10",
                                "properties": "0:5;1:6",
                                "properties_name": "0:5:색깔:彩蓝色;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662255",
                                "spec_id": "57778bb94f1000770bfeed54dfc38954"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:0",
                                "properties_name": "0:6:색깔:티베트 블루;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4759768662256",
                                "spec_id": "be4a0cef2150e8d0d1dd249dd0ad5466"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:1",
                                "properties_name": "0:6:색깔:티베트 블루;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4759768662257",
                                "spec_id": "25ca78f123191952fe010922cdc4627b"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:2",
                                "properties_name": "0:6:색깔:티베트 블루;1:2:크기:L",
                                "quantity": "1000",
                                "sku_id": "4759768662258",
                                "spec_id": "c9b528a37576532a2c97c94148c47c37"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:3",
                                "properties_name": "0:6:색깔:티베트 블루;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4759768662259",
                                "spec_id": "3244a5949021d6c9b4379a73b4d80f15"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:4",
                                "properties_name": "0:6:색깔:티베트 블루;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4759768662260",
                                "spec_id": "379d5e52865724f1b0562928694daa14"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:5",
                                "properties_name": "0:6:색깔:티베트 블루;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662261",
                                "spec_id": "59f6c02748fbcc6be3fb6b7e25b917ca"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:6;1:6",
                                "properties_name": "0:6:색깔:티베트 블루;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4759768662262",
                                "spec_id": "35968a2fa610f81bc7cbef5db735d946"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:0",
                                "properties_name": "0:7:색깔:果绿色;1:0:크기:S",
                                "quantity": "1000",
                                "sku_id": "4612677021910",
                                "spec_id": "c9d922581336f730db690b3916666963"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:1",
                                "properties_name": "0:7:색깔:果绿色;1:1:크기:M",
                                "quantity": "1000",
                                "sku_id": "4612677021911",
                                "spec_id": "8a7db4b0256d4bd4b55b4ab208d63fa2"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:2",
                                "properties_name": "0:7:색깔:果绿色;1:2:크기:L",
                                "quantity": "1000",
                                "sku_id": "4612677021912",
                                "spec_id": "a2893d386aeb48d8d1fb3b046bb938c1"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:3",
                                "properties_name": "0:7:색깔:果绿色;1:3:크기:XL",
                                "quantity": "1000",
                                "sku_id": "4612677021913",
                                "spec_id": "f6de063f01d9cff803d46f17cbe92dbb"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:4",
                                "properties_name": "0:7:색깔:果绿色;1:4:크기:XXL",
                                "quantity": "1000",
                                "sku_id": "4612677021914",
                                "spec_id": "8b5e93c699d34c3da2c0446d4b47e184"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:5",
                                "properties_name": "0:7:색깔:果绿色;1:5:크기:XXXL",
                                "quantity": "1000",
                                "sku_id": "4612677021915",
                                "spec_id": "a1a70187c74b236df806a22bd004cebf"
                            },
                            {
                                "price": "39.00",
                                "total_price": 0,
                                "sales": "0",
                                "properties": "0:7;1:6",
                                "properties_name": "0:7:색깔:果绿色;1:6:크기:XXXXL",
                                "quantity": "1000",
                                "sku_id": "4612677021916",
                                "spec_id": "f0f31ae40a9de2a95146f9ec17e59c30"
                            }
                        ]
                    },
                    "seller_id": "2207146052740",
                    "sales": 124,
                    "shop_id": "",
                    "props_list": {
                        "0:0": "색깔:하얀",
                        "0:1": "색깔:빨간",
                        "0:2": "색깔:노랑",
                        "0:3": "색깔:회색",
                        "0:4": "색깔:검정",
                        "0:5": "색깔:彩蓝色",
                        "0:6": "색깔:티베트 블루",
                        "0:7": "색깔:果绿色",
                        "1:0": "크기:S",
                        "1:1": "크기:M",
                        "1:2": "크기:L",
                        "1:3": "크기:XL",
                        "1:4": "크기:XXL",
                        "1:5": "크기:XXXL",
                        "1:6": "크기:XXXXL"
                    },
                    "seller_info": {
                        "nick": "深圳市华造实业有限公司",
                        "user_num_id": "2207146052740",
                        "sid": "b2b-2207146052740e484c",
                        "title": "深圳市华造实业有限公司",
                        "zhuy": "https://winport.m.1688.com/page/index.html?memberId=b2b-2207146052740e484c",
                        "shop_name": "深圳市华造实业有限公司"
                    },
                    "tmall": "",
                    "data_from": "1688app",
                    "error": "",
                    "unit": "件",
                    "is_support_mix": null,
                    "mix_amount": null,
                    "mix_begin": null,
                    "mix_number": null,
                    "min_num": "2",
                    "props_img": {
                        "0:0": "https://cbu01.alicdn.com/img/ibank/O1CN01SB7fiC1W6xsv2Eo08_!!2207146052740-0-cib.jpg",
                        "0:1": "https://cbu01.alicdn.com/img/ibank/O1CN01SX5RrT1W6xspiReoG_!!2207146052740-0-cib.jpg",
                        "0:2": "https://cbu01.alicdn.com/img/ibank/O1CN01rjtTwK1W6xsuVWGbN_!!2207146052740-0-cib.jpg",
                        "0:3": "https://cbu01.alicdn.com/img/ibank/O1CN01ns8rvI1W6xsrZIg90_!!2207146052740-0-cib.jpg",
                        "0:4": "https://cbu01.alicdn.com/img/ibank/O1CN01FJSyax1W6xsmR0pu6_!!2207146052740-0-cib.jpg",
                        "0:5": "https://cbu01.alicdn.com/img/ibank/O1CN01YG0oWJ1W6xsv2QkfC_!!2207146052740-0-cib.jpg",
                        "0:6": "https://cbu01.alicdn.com/img/ibank/O1CN01UyFPl41W6xsfpD0x9_!!2207146052740-0-cib.jpg",
                        "0:7": "https://cbu01.alicdn.com/img/ibank/O1CN01q1LwrZ1W6xspRpoQ7_!!2207146052740-0-cib.jpg"
                    },
                    "sales_data": "",
                    "location": "广东省 深圳市",
                    "sales_info": {
                        "seller_num": "",
                        "repeat_rate_purchase": "",
                        "per_capita_purchases": "",
                        "comment_num": "",
                        "comment_url": ""
                    },
                    "desc_img": [
                        "https://cbu01.alicdn.com/img/ibank/O1CN01iWAeFQ1W6xsnlmn2S_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01IiH3SW1W6xsnoSD2e_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01qCE1tY1W6xsnPPJjX_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN010XbFAJ1W6xsqiahbS_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN013PXWTf1W6xslXZwze_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01040Cso1W6xst0QJGH_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN014CRZ1Y1W6xssZLLLD_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01Uaxq381W6xssZLg7E_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01X60QXL1W6xsvWEl3C_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01q7R0d21W6xsnR1Lo8_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01E63dxG1W6xssaFfPF_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01L6bkRg1W6xsqSt30R_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01jgpils1W6xsqSrN2x_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01tzEMPR1W6xst1GLBQ_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN011v2Elb1W6xsqRQU5e_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01iIrYsv1W6xsqjbTGY_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01FwMwSb1W6xslYU0Uu_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01K8v8lA1W6xsvXAQWZ_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN014pKT5l1W6xsvXBMiQ_!!2207146052740-0-cib.jpg",
                        "https://cbu01.alicdn.com/img/ibank/O1CN01qCE1tY1W6xsnPPJjX_!!2207146052740-0-cib.jpg"
                    ],
                    "shop_item": [],
                    "relate_items": []
                },
                "secache": "559ce81e0f74eab658d3648550569f36",
                "secache_time": 1619622831,
                "secache_date": "2021-04-28 23:13:51",
                "translate_status": "error",
                "translate_time": 3.005,
                "language": {
                    "current_lang": "ko",
                    "source_lang": "cn"
                },
                "error": "",
                "reason": "",
                "error_code": "0000",
                "cache": 0,
                "api_info": "today:5 max:200",
                "execution_time": 8.252,
                "server_time": "Beijing/2021-04-28 23:13:54",
                "client_ip": "121.137.37.95",
                "call_args": {
                    "num_iid": "639741530227"
                },
                "api_type": "1688",
                "translate_language": "ko",
                "translate_engine": "google_cn",
                "server_memory": "4.04MB",
                "request_id": "gw-4.60897baacae7d"
            }';
/**/         
        
        return $result;
    }

}