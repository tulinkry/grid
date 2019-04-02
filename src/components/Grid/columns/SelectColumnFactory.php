<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:05
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\InvalidArgumentException;

class SelectColumnFactory extends ColumnFactory
{
    protected $options = array();
    protected $dataCallback;

    /**
     * SelectColumnFactory constructor.
     * @param $key
     * @param $heading
     * @param array $options
     */
    public function __construct($key, array $options)
    {
        parent::__construct($key);
        $this->options = $options;
    }

    /**
     * @param callable $dataCallback
     */
    public function setDataCallback($dataCallback)
    {
        $this->dataCallback = $dataCallback;
        return $this;
    }

    public function __invoke()
    {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException('Calling ' . get_class() . ' expects at least one argument');
        }

        return new SelectColumn(func_get_arg(0), $this->key, $this->options, $this->dataCallback);
    }
}