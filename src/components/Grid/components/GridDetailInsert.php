<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;

use Tulinkry\Forms\Container;

class GridDetailInsert extends GridDetail
{
    const QUERY_PARAM = 'insert';

    /**
     * Process data from the form in this component.
     * @param array $data array of data from the form
     */
    public function fillContainer(Container $container)
    {
    }

    /**
     * Process data from the form in this component.
     * @param array $data array of data from the form
     */
    public function processData($data)
    {
        $this->model->create($data);
    }

    /**
     * Return additional query parameters appended to the form action URL.
     * <pre>
     * $params = array(
     *  'id' => 3,
     * );
     * </pre>
     * @return array
     */
    public function getQueryParameters()
    {
        return [
            self::QUERY_PARAM => true
        ];
    }

    /**
     * @return boolean when this component handles insertion
     */
    public function isInsert()
    {
        return true;
    }
}