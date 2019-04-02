<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:05
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\InvalidArgumentException;

class DateColumnFactory extends ColumnFactory
{
    protected $format;

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function __invoke()
    {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException('Calling ' . get_class() . ' expects at least one argument');
        }
        return new DateColumn(func_get_arg(0), $this->key, $this->format);
    }
}