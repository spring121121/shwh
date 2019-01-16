<?php

namespace App\Http\Services;


use AipFace;

/**
 *
 * @todo 人脸识别
 * Class AipFaceService
 * @package App\Http\Services
 */

class AipFaceService
{
    const APP_ID = '15390398';
    const API_KEY = 'xUGuXcBLpHROcBvVSys3N1f4';
    const SECRET_KEY = 'n1aQFHDjWFgbL6U6XZEpGvTIf3SKiGNy';
    const IMAGE_TYPE = 'BASE64';
    /**
     * 艺术家上传的作品检测
     */
    const GROUP_ARTIST = "cave_artist";
    const GROUP_USER = "cave_user";



    public static function getAipFace()
    {
        return new AipFace(self::APP_ID, self::API_KEY, self::SECRET_KEY);
    }

    public function addImage($imageContent,$groupId,$userId)
    {
        $image = base64_encode($imageContent);
        $imageType = 'BASE64';
        $re = self::getAipFace()->addUser($image, $imageType, $groupId, $userId);

    }

    public function addImageByContent($fileContent,$groupId){
        $image = base64_encode($fileContent);
        $userId = 100;
        $re = self::getAipFace()->addUser($image, self::IMAGE_TYPE, $groupId, $userId);
    }

    public function match()
    {
        $matchArr = [
            [
                'image' => base64_encode(file_get_contents('http://106.13.11.79:8084/images/smm.jpg')),
                'image_type' => 'BASE64',
            ],
            [
                'image' => base64_encode(file_get_contents('http://106.13.11.79:8084/images/qdy1.jpg')),
                'image_type' => 'BASE64',
            ],
        ];
        $re = self::getAipFace()->match($matchArr);
        dd($re);
    }

    public function search($imageContent,$groupId)
    {

        $image = base64_encode($imageContent);
        $re = self::getAipFace()->search($image, self::IMAGE_TYPE,$groupId);
        dd($re);
    }

}

