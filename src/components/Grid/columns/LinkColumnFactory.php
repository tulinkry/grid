<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 09:05
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\InvalidArgumentException;

class LinkColumnFactory extends ColumnFactory
{
    protected $openInNewTab = false;

    /**
     * @param mixed $openInNewTab
     */
    public function openInNewTab($openInNewTab = true)
    {
        $this->openInNewTab = $openInNewTab;
        return $this;
    }

    public function __invoke()
    {
        if (func_num_args() < 1) {
            throw new InvalidArgumentException('Calling ' . get_class() . ' expects at least one argument');
        }
        return new LinkColumn(func_get_arg(0), $this->key, $this->heading, $this->openInNewTab);
    }
}