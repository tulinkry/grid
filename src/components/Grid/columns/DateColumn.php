<?php

namespace Tulinkry\Components\Grid\Columns;

class DateColumn extends Column
{
    protected $format;

    /**
     * DateColumn constructor.
     * @param $openInNewTab
     */
    public function __construct($entity, $key, $openInNewTab)
    {
        parent::__construct($entity, $key);
        $this->format = $openInNewTab;
    }

    protected function fillTemplate()
    {
        $this->template->date = $this->entity[$this->key];
        $this->template->format = $this->format;
    }
}