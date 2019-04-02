<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:02
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\Utils\Callback;

abstract class ColumnFactory
{
    protected $key;
    protected $decode;

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

    public function convertEntity($entity)
    {
        if ($this->decode !== null) {
            return Callback::invoke($this->decode, $entity);
        }
        return $entity;
    }

    abstract public function __invoke();
}
