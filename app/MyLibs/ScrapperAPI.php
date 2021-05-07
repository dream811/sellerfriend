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
                "num_iid": "615228589244",
                "title": "GamerFinger摇杆按键 30mm 常规按键 GF按键 gamer finger",
                "desc_short": "",
                "price": "40",
                "total_price": "",
                "suggestive_price": "",
                "orginal_price": "40.00",
                "nick": "gamden",
                "num": 1454,
                "detail_url": "https://item.taobao.com/item.htm?id=615228589244",
                "pic_url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01MtHWSh1adGDJCN7iu_!!30783352.png",
                "brand": "CHERRY",
                "brandId": "52916786",
                "rootCatId": "50024099",
                "cid": "50018821",
                "desc": "\n  <p><span ><span >GamerFinger按键——高玩的选择</span></span></p> \n  <p><span ><span >CHERRY原厂轴</span></span></p> \n  <p><span ><span >精准、耐用、静音</span></span></p> \n  <p>&nbsp;</p> \n  <p><strong><span ><span ><span >注意</span></span></span></strong></p> \n  <p><span ><span >1、拳霸Q3hitbox 30mm按键（上方向）、</span></span><span ><span >雷蛇进化版</span></span></p> \n  <p><span ><span >以上两款摇杆请选择<span ><strong>卡扣式</strong></span>安装的按键。其他摇杆选择<strong>螺母式</strong>安装或<strong>卡扣式</strong>安装均可。<strong>不要再问“我的XX（框体）摇杆能不能安装螺母”</strong>。</span></span></p> \n  <p><span ><span >2、港澳买家请直接填写港澳地址</span></span></p> \n  <p><font face=\"microsoft yahei\"><span >3、此商品<span ><strong>不包邮</strong></span>，一律<strong>到付</strong>。到付邮费根据地区人民币60-80元不等。</span></font></p> \n  <p><span ><span >4、按键配色可自行选择</span></span></p> \n  <p>&nbsp;</p> \n  <p><img align=\"absmiddle\" src=\"http://img.alicdn.com/imgextra/i3/30783352/O1CN01sBs3Ha1adGCnakRa3_!!30783352.png\"  /><img align=\"absmiddle\" src=\"http://img.alicdn.com/imgextra/i1/30783352/O1CN01AgEkaS1adGCozFHZq_!!30783352.png\"  /></p>\n  ",
                "item_imgs": [
                    {
                        "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01MtHWSh1adGDJCN7iu_!!30783352.png"
                    },
                    {
                        "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01BnBjiO1adGCkYXeDo_!!30783352.png"
                    },
                    {
                        "url": "//img.alicdn.com/imgextra/i4/30783352/O1CN01ViAA9e1adGCzPcIuw_!!30783352.jpg"
                    },
                    {
                        "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN012tLjU71adGCrTnVjP_!!30783352.png"
                    },
                    {
                        "url": "//img.alicdn.com/imgextra/i4/30783352/O1CN01O9pYMA1adGCoBP8Qi_!!30783352.png"
                    }
                ],
                "item_weight": "",
                "post_fee": "",
                "freight": "快递: 快递包邮",
                "express_fee": null,
                "ems_fee": "",
                "shipping_to": "",
                "video": [],
                "sample_id": "",
                "props_name": "-3:-6:轴体:青轴（有声）;-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;-1:-8:安装方式:螺母;1627207:28341:颜色分类:黑色;1627207:107121:颜色分类:透明;1627207:6368793836:颜色分类:龙珠橙;1627207:7724488810:颜色分类:骑空士蓝;1627207:232908634:颜色分类:深蓝;1627207:28329:颜色分类:紫色;1627207:28324:颜色分类:黄色;1627207:52913982:颜色分类:樱花;1627207:3441373:颜色分类:深红;1627207:28335:颜色分类:绿色;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                "prop_imgs": {
                    "prop_img": [
                        {
                            "properties": "1627207:28341",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01BGsz091adGCoBDeid_!!30783352.png"
                        },
                        {
                            "properties": "1627207:107121",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01BnBjiO1adGCkYXeDo_!!30783352.png"
                        },
                        {
                            "properties": "1627207:6368793836",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01k61sIn1adGCmpIir5_!!30783352.png"
                        },
                        {
                            "properties": "1627207:7724488810",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01jhOJU51adGCnDGkoQ_!!30783352.png"
                        },
                        {
                            "properties": "1627207:232908634",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01LC12jW1adGCp32JFe_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28329",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN019Tty7x1adGCqReSlW_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28324",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01hJR3ki1adGCrTcyOn_!!30783352.png"
                        },
                        {
                            "properties": "1627207:52913982",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01UtHvxM1adGCnDKmN1_!!30783352.png"
                        },
                        {
                            "properties": "1627207:3441373",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01asgDkA1adGCjavMNe_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28335",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01pZEn7Z1adGDWXu81N_!!30783352.png"
                        },
                        {
                            "properties": "1627207:7724459526",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01YLMbzE1adGCesnqOD_!!30783352.png"
                        }
                    ]
                },
                "props_imgs": {
                    "prop_img": [
                        {
                            "properties": "1627207:28341",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01BGsz091adGCoBDeid_!!30783352.png"
                        },
                        {
                            "properties": "1627207:107121",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01BnBjiO1adGCkYXeDo_!!30783352.png"
                        },
                        {
                            "properties": "1627207:6368793836",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01k61sIn1adGCmpIir5_!!30783352.png"
                        },
                        {
                            "properties": "1627207:7724488810",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01jhOJU51adGCnDGkoQ_!!30783352.png"
                        },
                        {
                            "properties": "1627207:232908634",
                            "url": "//img.alicdn.com/imgextra/i3/30783352/O1CN01LC12jW1adGCp32JFe_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28329",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN019Tty7x1adGCqReSlW_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28324",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01hJR3ki1adGCrTcyOn_!!30783352.png"
                        },
                        {
                            "properties": "1627207:52913982",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01UtHvxM1adGCnDKmN1_!!30783352.png"
                        },
                        {
                            "properties": "1627207:3441373",
                            "url": "//img.alicdn.com/imgextra/i2/30783352/O1CN01asgDkA1adGCjavMNe_!!30783352.png"
                        },
                        {
                            "properties": "1627207:28335",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01pZEn7Z1adGDWXu81N_!!30783352.png"
                        },
                        {
                            "properties": "1627207:7724459526",
                            "url": "//img.alicdn.com/imgextra/i1/30783352/O1CN01YLMbzE1adGCesnqOD_!!30783352.png"
                        }
                    ]
                },
                "property_alias": "",
                "props": [
                    {
                        "name": "品牌",
                        "value": "CHERRY"
                    },
                    {
                        "name": "型号",
                        "value": "青轴、银轴"
                    },
                    {
                        "name": "产地",
                        "value": "港澳台地区"
                    },
                    {
                        "name": "颜色分类",
                        "value": "黑色,透明,紫色,黄色,绿色,龙珠橙,骑空士蓝,深蓝,樱花,深红,透明可嵌图片（DIY）"
                    }
                ],
                "total_sold": "395",
                "skus": {
                    "sku": [
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:28341",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28341:颜色分类:黑色",
                            "quantity": "40",
                            "sku_id": "4527316341981"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:28341",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28341:颜色分类:黑色",
                            "quantity": "10",
                            "sku_id": "4527316649003"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:28341",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28341:颜色分类:黑色",
                            "quantity": "40",
                            "sku_id": "4527316341992"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:28341",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28341:颜色分类:黑色",
                            "quantity": "12",
                            "sku_id": "4527316649014"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:28341",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28341:颜色分类:黑色",
                            "quantity": "0",
                            "sku_id": "4778239535995"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:28341",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28341:颜色分类:黑色",
                            "quantity": "0",
                            "sku_id": "4773979698017"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:28341",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28341:颜色分类:黑色",
                            "quantity": "0",
                            "sku_id": "4773979698006"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:28341",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28341:颜色分类:黑色",
                            "quantity": "0",
                            "sku_id": "4773979698028"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:107121",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4527316341976"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:107121",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4527316341998"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:107121",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4527316341987"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:107121",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4527316649009"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:107121",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4778239535990"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:107121",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4773979698012"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:107121",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4773979698001"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:107121",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:107121:颜色分类:透明",
                            "quantity": "0",
                            "sku_id": "4773979698023"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:6368793836",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "99",
                            "sku_id": "4527316341984"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:6368793836",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "66",
                            "sku_id": "4527316649006"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:6368793836",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "98",
                            "sku_id": "4527316341995"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:6368793836",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "96",
                            "sku_id": "4527316649017"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:6368793836",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "0",
                            "sku_id": "4778239535998"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:6368793836",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "0",
                            "sku_id": "4773979698020"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:6368793836",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "0",
                            "sku_id": "4773979698009"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:6368793836",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:6368793836:颜色分类:龙珠橙",
                            "quantity": "0",
                            "sku_id": "4773979698031"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:7724488810",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "30",
                            "sku_id": "4527316341986"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:7724488810",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "14",
                            "sku_id": "4527316649008"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:7724488810",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "16",
                            "sku_id": "4527316341997"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:7724488810",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "5",
                            "sku_id": "4527316649019"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:7724488810",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "0",
                            "sku_id": "4778239536000"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:7724488810",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "0",
                            "sku_id": "4773979698022"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:7724488810",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "0",
                            "sku_id": "4773979698011"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:7724488810",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:7724488810:颜色分类:骑空士蓝",
                            "quantity": "0",
                            "sku_id": "4773979698033"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:232908634",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:232908634:颜色分类:深蓝",
                            "quantity": "40",
                            "sku_id": "4527316341977"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:232908634",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:232908634:颜色分类:深蓝",
                            "quantity": "32",
                            "sku_id": "4527316341999"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:232908634",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:232908634:颜色分类:深蓝",
                            "quantity": "49",
                            "sku_id": "4527316341988"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:232908634",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:232908634:颜色分类:深蓝",
                            "quantity": "11",
                            "sku_id": "4527316649010"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:232908634",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:232908634:颜色分类:深蓝",
                            "quantity": "0",
                            "sku_id": "4778239535991"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:232908634",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:232908634:颜色分类:深蓝",
                            "quantity": "0",
                            "sku_id": "4773979698013"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:232908634",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:232908634:颜色分类:深蓝",
                            "quantity": "0",
                            "sku_id": "4773979698002"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:232908634",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:232908634:颜色分类:深蓝",
                            "quantity": "0",
                            "sku_id": "4773979698024"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:28329",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4527316341979"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:28329",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4527316649001"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:28329",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4527316341990"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:28329",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4527316649012"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:28329",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4778239535993"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:28329",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4773979698015"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:28329",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4773979698004"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:28329",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28329:颜色分类:紫色",
                            "quantity": "0",
                            "sku_id": "4773979698026"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:28324",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28324:颜色分类:黄色",
                            "quantity": "98",
                            "sku_id": "4527316341978"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:28324",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28324:颜色分类:黄色",
                            "quantity": "84",
                            "sku_id": "4527316342000"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:28324",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28324:颜色分类:黄色",
                            "quantity": "98",
                            "sku_id": "4527316341989"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:28324",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28324:颜色分类:黄色",
                            "quantity": "89",
                            "sku_id": "4527316649011"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:28324",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28324:颜色分类:黄色",
                            "quantity": "0",
                            "sku_id": "4778239535992"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:28324",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28324:颜色分类:黄色",
                            "quantity": "0",
                            "sku_id": "4773979698014"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:28324",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28324:颜色分类:黄色",
                            "quantity": "0",
                            "sku_id": "4773979698003"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:28324",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28324:颜色分类:黄色",
                            "quantity": "0",
                            "sku_id": "4773979698025"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:52913982",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:52913982:颜色分类:樱花",
                            "quantity": "28",
                            "sku_id": "4527316341983"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:52913982",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:52913982:颜色分类:樱花",
                            "quantity": "8",
                            "sku_id": "4527316649005"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:52913982",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:52913982:颜色分类:樱花",
                            "quantity": "30",
                            "sku_id": "4527316341994"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:52913982",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:52913982:颜色分类:樱花",
                            "quantity": "20",
                            "sku_id": "4527316649016"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:52913982",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:52913982:颜色分类:樱花",
                            "quantity": "0",
                            "sku_id": "4778239535997"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:52913982",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:52913982:颜色分类:樱花",
                            "quantity": "0",
                            "sku_id": "4773979698019"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:52913982",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:52913982:颜色分类:樱花",
                            "quantity": "0",
                            "sku_id": "4773979698008"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:52913982",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:52913982:颜色分类:樱花",
                            "quantity": "0",
                            "sku_id": "4773979698030"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:3441373",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4527316341982"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:3441373",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4527316649004"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:3441373",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4527316341993"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:3441373",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4527316649015"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:3441373",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4778239535996"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:3441373",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4773979698018"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:3441373",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4773979698007"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:3441373",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:3441373:颜色分类:深红",
                            "quantity": "0",
                            "sku_id": "4773979698029"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:28335",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28335:颜色分类:绿色",
                            "quantity": "97",
                            "sku_id": "4527316341980"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:28335",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:28335:颜色分类:绿色",
                            "quantity": "64",
                            "sku_id": "4527316649002"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:28335",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28335:颜色分类:绿色",
                            "quantity": "98",
                            "sku_id": "4527316341991"
                        },
                        {
                            "price": "40",
                            "total_price": 0,
                            "orginal_price": "40",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:28335",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:28335:颜色分类:绿色",
                            "quantity": "82",
                            "sku_id": "4527316649013"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:28335",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28335:颜色分类:绿色",
                            "quantity": "0",
                            "sku_id": "4778239535994"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:28335",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:28335:颜色分类:绿色",
                            "quantity": "0",
                            "sku_id": "4773979698016"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:28335",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28335:颜色分类:绿色",
                            "quantity": "0",
                            "sku_id": "4773979698005"
                        },
                        {
                            "price": "42",
                            "total_price": 0,
                            "orginal_price": "42",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:28335",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:28335:颜色分类:绿色",
                            "quantity": "0",
                            "sku_id": "4773979698027"
                        },
                        {
                            "price": "45",
                            "total_price": 0,
                            "orginal_price": "45",
                            "properties": "-3:-6;-2:-2;-1:-1;1627207:7724459526",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4527316341985"
                        },
                        {
                            "price": "45",
                            "total_price": 0,
                            "orginal_price": "45",
                            "properties": "-3:-7;-2:-2;-1:-1;1627207:7724459526",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-1:安装方式:卡扣;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4527316649007"
                        },
                        {
                            "price": "45",
                            "total_price": 0,
                            "orginal_price": "45",
                            "properties": "-3:-6;-2:-3;-1:-1;1627207:7724459526",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4527316341996"
                        },
                        {
                            "price": "45",
                            "total_price": 0,
                            "orginal_price": "45",
                            "properties": "-3:-7;-2:-3;-1:-1;1627207:7724459526",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-1:安装方式:卡扣;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4527316649018"
                        },
                        {
                            "price": "48",
                            "total_price": 0,
                            "orginal_price": "48",
                            "properties": "-3:-6;-2:-2;-1:-8;1627207:7724459526",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4778239535999"
                        },
                        {
                            "price": "48",
                            "total_price": 0,
                            "orginal_price": "48",
                            "properties": "-3:-7;-2:-2;-1:-8;1627207:7724459526",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-2:座颜色:透明;-1:-8:安装方式:螺母;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4773979698021"
                        },
                        {
                            "price": "48",
                            "total_price": 0,
                            "orginal_price": "48",
                            "properties": "-3:-6;-2:-3;-1:-8;1627207:7724459526",
                            "properties_name": "-3:-6:轴体:青轴（有声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4773979698010"
                        },
                        {
                            "price": "48",
                            "total_price": 0,
                            "orginal_price": "48",
                            "properties": "-3:-7;-2:-3;-1:-8;1627207:7724459526",
                            "properties_name": "-3:-7:轴体:银轴（无声）;-2:-3:座颜色:黑透;-1:-8:安装方式:螺母;1627207:7724459526:颜色分类:透明可嵌图片（DIY）",
                            "quantity": "0",
                            "sku_id": "4773979698032"
                        }
                    ]
                },
                "seller_id": "30783352",
                "sales": 500,
                "shop_id": "314675268",
                "props_list": {
                    "-3:-6": "轴体:青轴（有声）",
                    "-3:-7": "轴体:银轴（无声）",
                    "-2:-2": "座颜色:透明",
                    "-2:-3": "座颜色:黑透",
                    "-1:-1": "安装方式:卡扣",
                    "-1:-8": "安装方式:螺母",
                    "1627207:28341": "颜色分类:黑色",
                    "1627207:107121": "颜色分类:透明",
                    "1627207:6368793836": "颜色分类:龙珠橙",
                    "1627207:7724488810": "颜色分类:骑空士蓝",
                    "1627207:232908634": "颜色分类:深蓝",
                    "1627207:28329": "颜色分类:紫色",
                    "1627207:28324": "颜色分类:黄色",
                    "1627207:52913982": "颜色分类:樱花",
                    "1627207:3441373": "颜色分类:深红",
                    "1627207:28335": "颜色分类:绿色",
                    "1627207:7724459526": "颜色分类:透明可嵌图片（DIY）"
                },
                "seller_info": {
                    "nick": "gamden",
                    "item_score": "4.9 ",
                    "score_p": "5.0 ",
                    "delivery_score": "4.9 ",
                    "shop_type": "C",
                    "user_num_id": "30783352",
                    "sid": "314675268",
                    "title": "格斗家杂货铺",
                    "zhuy": "https://shop314675268.taobao.com/",
                    "shop_name": "格斗家杂货铺"
                },
                "tmall": false,
                "error": "",
                "fav_count": "270",
                "fans_count": "262",
                "location": "台湾新北",
                "data_from": "tbf",
                "has_discount": "false",
                "is_promotion": "false",
                "promo_type": null,
                "props_img": {
                    "1627207:28341": "//img.alicdn.com/imgextra/i3/30783352/O1CN01BGsz091adGCoBDeid_!!30783352.png",
                    "1627207:107121": "//img.alicdn.com/imgextra/i2/30783352/O1CN01BnBjiO1adGCkYXeDo_!!30783352.png",
                    "1627207:6368793836": "//img.alicdn.com/imgextra/i2/30783352/O1CN01k61sIn1adGCmpIir5_!!30783352.png",
                    "1627207:7724488810": "//img.alicdn.com/imgextra/i3/30783352/O1CN01jhOJU51adGCnDGkoQ_!!30783352.png",
                    "1627207:232908634": "//img.alicdn.com/imgextra/i3/30783352/O1CN01LC12jW1adGCp32JFe_!!30783352.png",
                    "1627207:28329": "//img.alicdn.com/imgextra/i2/30783352/O1CN019Tty7x1adGCqReSlW_!!30783352.png",
                    "1627207:28324": "//img.alicdn.com/imgextra/i2/30783352/O1CN01hJR3ki1adGCrTcyOn_!!30783352.png",
                    "1627207:52913982": "//img.alicdn.com/imgextra/i1/30783352/O1CN01UtHvxM1adGCnDKmN1_!!30783352.png",
                    "1627207:3441373": "//img.alicdn.com/imgextra/i2/30783352/O1CN01asgDkA1adGCjavMNe_!!30783352.png",
                    "1627207:28335": "//img.alicdn.com/imgextra/i1/30783352/O1CN01pZEn7Z1adGDWXu81N_!!30783352.png",
                    "1627207:7724459526": "//img.alicdn.com/imgextra/i1/30783352/O1CN01YLMbzE1adGCesnqOD_!!30783352.png"
                },
                "rate_grade": "",
                "desc_img": [
                    "http://img.alicdn.com/imgextra/i3/30783352/O1CN01sBs3Ha1adGCnakRa3_!!30783352.png",
                    "http://img.alicdn.com/imgextra/i1/30783352/O1CN01AgEkaS1adGCozFHZq_!!30783352.png"
                ],
                "shop_item": [],
                "relate_items": []
            },
            "secache": "f1f426e1d33fcccefd62da2fcfc47a91",
            "secache_time": 1620295932,
            "secache_date": "2021-05-06 18:12:12",
            "translate_status": "",
            "translate_time": 0,
            "language": {
                "default_lang": "cn",
                "current_lang": "cn"
            },
            "error": "",
            "reason": "",
            "error_code": "0000",
            "cache": 0,
            "api_info": "today:13 max:200",
            "execution_time": 2.473,
            "server_time": "Beijing/2021-05-06 18:12:12",
            "client_ip": "121.137.37.80",
            "call_args": {
                "num_iid": "615228589244",
                "is_promotion": "1"
            },
            "api_type": "taobao",
            "translate_language": "zh-CN",
            "translate_engine": "google_cn",
            "server_memory": "5.49MB",
            "request_id": "gw-4.6093c0fc0c76b"
        }';
/**/         
        
        return $result;
    }

}