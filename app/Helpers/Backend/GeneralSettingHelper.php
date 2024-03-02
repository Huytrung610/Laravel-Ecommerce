<?php
namespace App\Helpers\Backend;
class GeneralSettingHelper
{
    public static function formatPhoneNumber($phoneNumber)
    {
        if (strpos($phoneNumber, '+84') === false) {
            $phoneNumber = '+84 ' . ltrim($phoneNumber, '0');
        }
        $formattedPhoneNumber = preg_replace('/\+84/', '+84 ', $phoneNumber); 
        return $phoneNumber;
    }
}