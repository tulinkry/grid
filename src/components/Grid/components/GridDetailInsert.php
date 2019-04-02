<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;


class GridDetailInsert extends GridDetail
{
    const QUERY_PARAM = 'insert';

    public function isInsert()
    {
        return true;
    }

    public function getQueryParameters()
    {
        return [
            self::QUERY_PARAM => true
        ];
    }
}