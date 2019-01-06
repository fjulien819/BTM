<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06/01/2019
 * Time: 14:34
 */

namespace App\Service;



class PostMetaDescriptionGenerator
{
    const LENGTH_META_DESCRIPTION = 150;

    public function getMetaDescription($text)
    {
        return mb_strimwidth($text, 0, self::LENGTH_META_DESCRIPTION, "...");
    }
}