<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:02
 */

namespace Tulinkry\Components\Grid\Columns;

use Nette\Object;
use Nette\Utils\Callback;

abstract class ColumnFactory extends Object
{
    protected $key;
    protected $decode;
    protected $sortable = false;

    /**
     * ColumnFactory constructor.
     * @param $key
     * @param $heading
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $decode
     */
    public function setDecode($decode)
    {
        $this->decode = $decode;
        return $this;
    }

    /**
     * @param mixed $sortable
     */
    public function setSortable($sortable = true)
    {
        $this->sortable = $sortable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSortable()
    {
        return $this->sortable;
    }

    public function convertEntity($entity)
    {
        if ($this->decode !== null) {
            return Callback::invoke($this->decode, $entity);
        }
        return $entity;
    }

    abstract public function __invoke();
}
