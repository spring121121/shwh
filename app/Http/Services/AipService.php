<?php

namespace App\Http\Services;


use AipFace;

class AipService
{
    const APP_ID = '15390398';
    const API_KEY = 'xUGuXcBLpHROcBvVSys3N1f4';
    const SECRET_KEY = 'n1aQFHDjWFgbL6U6XZEpGvTIf3SKiGNy';


    public static function getAipFace()
    {
        return new AipFace(self::APP_ID, self::API_KEY, self::SECRET_KEY);
    }

    public function addUser($image_url)
    {
        $image = base64_encode(file_get_contents('http://106.13.11.79:8084/images/smm.jpg'));
        $imageType = 'BASE64';
        $groupId = 'cave_user';
        $userId = 1;
        $re = self::getAipFace()->addUser($image, $imageType, $groupId, $userId);
    }

    public function match()
    {
        $matchArr = [
            [
                'image' => base64_encode(file_get_contents('http://106.13.11.79:8084/images/smm.jpg')),
                'image_type'=>'BASE64',
            ],
            [
                'image' => base64_encode(file_get_contents('http://106.13.11.79:8084/images/qdy1.jpg')),
                'image_type'=>'BASE64',
            ],
        ];
        $re = self::getAipFace()->match($matchArr);
        dd($re);
    }

}

