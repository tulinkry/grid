<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;

use Nette\Database\IRow;

class GridDetailUpdate extends GridDetail
{
    const QUERY_PARAM = 'edit-id';

    /**
     * @var IRow
     */
    protected $entity;

    /**
     * GridDetail constructor.
     * @param IRow $entity
     * @param $model
     * @param callable $formFactory
     * @param $toValues
     * @param $fromValues
     */
    public function __construct(IRow $entity, $model, $formFactory, $toValues, $fromValues)
    {
        parent::__construct($model, $formFactory, $toValues, $fromValues);
        $this->entity = $entity;
    }

    public function isInsert()
    {
        return false;
    }

    public function getQueryParameters()
    {
        return [
            self::QUERY_PARAM => $this->entity->id
        ];
    }

    public function processData($data)
    {
        $this->model->update($this->entity->id, $data);
    }
}