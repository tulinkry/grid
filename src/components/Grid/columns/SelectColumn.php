<?php

namespace Tulinkry\Components\Grid\Columns;

use Nette\InvalidArgumentException;

class SelectColumn extends Column
{
    private $options;
    private $dataCallback;

    /**
     * SelectColumn constructor.
     * @param $heading
     * @param $text
     */
    public function __construct($entity, $key, $options = array(), $dataCallback)
    {
        parent::__construct($entity, $key);
        $this->options = $options;
        $this->dataCallback = $dataCallback;

        foreach ($options as $value => $option) {
            if (!isset($option['label'])) {
                throw new InvalidArgumentException('Need "handle" parameter for option');
            }
            if (!isset($option['class'])) {
                throw new InvalidArgumentException('Need "handle" parameter for option');
            }
        }
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function handleClick($id, $value)
    {
        if ($this->dataCallback !== null) {
            $callback = $this->dataCallback;
            $this->entity = $callback($id, $value);
            $this->presenter->flashMessage('Záznam byl změněn.', 'success');

            if ($this->presenter->isAjax()) {
                $this->redrawControl();
                $this->presenter->redrawControl('flashes');
            } else {
                $this->redirect('this');
            }
        }
    }

    protected function fillTemplate()
    {
        $this->template->options = $this->options;
        $this->template->entity = $this->entity;
        $this->template->selected = $this->options[$this->entity[$this->key]];
    }
}