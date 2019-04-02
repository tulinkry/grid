<?php

namespace Tulinkry\Components\Grid\Columns;

class TextColumn extends Column
{
    protected function fillTemplate()
    {
        $this->template->text = $this->entity[$this->key];
    }
}