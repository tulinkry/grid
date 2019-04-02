<?php

namespace Tulinkry\Components\Grid\Columns;

class LinkColumn extends TextColumn
{
    protected $openInNewTab;

    /**
     * DateColumn constructor.
     * @param $openInNewTab
     */
    public function __construct($entity, $key, $openInNewTab)
    {
        parent::__construct($entity, $key);
        $this->openInNewTab = $openInNewTab;
    }

    protected function fillTemplate()
    {
        parent::fillTemplate();
        $this->template->openInNewTab = $this->openInNewTab;
    }
}