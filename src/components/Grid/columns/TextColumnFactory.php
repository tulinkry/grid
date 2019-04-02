<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:05
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\InvalidArgumentException;

class TextColumnFactory extends ColumnFactory
{

    public function __invoke()
    {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException('Calling ' . get_class() . ' expects at least one argument');
        }
        return new TextColumn(func_get_arg(0), $this->key, $this->heading);
    }
}