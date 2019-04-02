<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;

use Nette\Database\IRow;
use Nette\Utils\Callback;
use Tulinkry\Forms\Container;

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

    /**
     * Process data from the form in this component.
     * @param array $data array of data from the form
     */
    public function fillContainer(Container $container)
    {
        if ($this->toValues) {
            $converted = Callback::invoke($this->toValues, $this->entity);
            $container->setDefaults($converted ?: $this->entity);
        }
    }

    /**
     * @return boolean when this component handles insertion
     */
    public function isInsert()
    {
        return false;
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
            self::QUERY_PARAM => $this->entity->id
        ];
    }

    /**
     * Process data from the form in this component.
     * @param array $data array of data from the form
     */
    public function processData($data)
    {
        $this->model->update($this->entity->id, $data);
    }
}