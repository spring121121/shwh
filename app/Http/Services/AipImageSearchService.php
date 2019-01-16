<?php

namespace App\Http\Services;


use AipImageSearch;

class AipImageSearchService
{
    const APP_ID = '15417808';
    const AIP_KEY = 'wATjKyGjIsehqiQnnrW3FDVZ';
    const SECRET_KEY = 'xTIfsLgZFarizMY231pXOu7DMr9rNrI6';
    const IMAGE_TYPE = 'BASE64';


    /**
     * 获取图片检索的类
     * @return AipImageSearch
     */
    public static function getImageSearchAip()
    {
        return new AipImageSearch(self::APP_ID, self::AIP_KEY, self::SECRET_KEY);
    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $imageContent - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $imageName
     * @param int $imageId
     * @return array
     */
    public function sameHqAdd($imageContent,$imageName,$imageId)
    {

        $options["brief"] = urldecode(json_encode(["name"=>$imageName,"id"=>$imageId]));
        return self::getImageSearchAip()->sameHqAdd($imageContent,$options);

    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $imageContent - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @return array
     */
    public function sameHqSearch($imageContent)
    {
        return self::getImageSearchAip()->sameHqSearch($imageContent);
    }

}

