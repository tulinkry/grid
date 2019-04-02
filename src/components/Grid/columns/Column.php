<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-04-02
 * Time: 08:56
 */

namespace Tulinkry\Components\Grid\Columns;


use Nette\Application\UI\Control;
use Nette\InvalidArgumentException;
use ReflectionClass;

abstract class Column extends Control
{
    protected $key;
    protected $entity;

    /**
     * Column constructor.
     * @param $entity
     * @param $heading
     * @param $text
     */
    public function __construct($entity, $key)
    {
        parent::__construct();
        $this->entity = $entity;
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    abstract protected function fillTemplate();

    public function render()
    {
        $template = sprintf(__DIR__ . '/templates/%s.latte', strtolower(str_replace('Column', '', (new ReflectionClass($this))->getShortName())));
        if (!file_exists($template)) {
            throw new InvalidArgumentException('Template ' . $template . ' does not exist');
        }
        $this->template->setFile($template);
        $this->fillTemplate();
        $this->template->render();
    }
}