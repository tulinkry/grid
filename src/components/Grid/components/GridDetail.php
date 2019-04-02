<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;


use Exception;
use Nette\Application\UI\Control;
use Nette\Utils\Callback;
use Tulinkry\Application\UI\Form;

abstract class GridDetail extends Control
{
    /**
     * @var callable
     */
    protected $formFactory;
    /**
     * @var callable
     */
    protected $toValues;
    /**
     * @var callable
     */
    protected $fromValues;
    private $model;

    /**
     * GridDetail constructor.
     * @param callable $formFactory
     */
    public function __construct($model, $formFactory, $toValues, $fromValues)
    {
        parent::__construct();
        $this->formFactory = $formFactory;
        $this->toValues = $toValues;
        $this->fromValues = $fromValues;
        $this->model = $model;
    }

    abstract public function isInsert();

    abstract public function getQueryParameters();


    public function createComponentDetailForm($name)
    {
        $form = new Form($this, $name);
        $container = $form->addContainer('detail');

        if ($this->formFactory !== null) {
            Callback::invoke($this->formFactory, $container);
        }

        if ($this->toValues) {
            $converted = Callback::invoke($this->toValues, $this->entity);
            $container->setDefaults($converted ?: $this->entity);
        }

        $container->addSubmit('submit', $this->isInsert() ? 'Vložit' : 'Uložit')
            ->setAttribute('class', 'btn btn-primary');

        $form->action = $this->presenter->link('this', array_merge(['name' => $this->name], $this->getQueryParameters()));

        $form->onSuccess[] = function ($form, $values) {
            $converted = Callback::invoke($this->fromValues, $values['detail']);

            try {
                if ($this->isInsert()) {
                    $this->model->create($converted ?: $values['detail']);
                } else {
                    $this->model->update($this->entity->id, $converted ?: $values['detail']);
                }
                $this->presenter->flashMessage('Záznam byl ' . ($this->isInsert() ? 'v' : 'u') . 'ložen.', 'success');
            } catch (Exception $e) {
                $this->presenter->flashMessage('Záznam nebyl ' . ($this->isInsert() ? 'v' : 'u') . 'ložen: ' . $e->getMessage(), 'danger');
            }

            if ($this->presenter->isAjax()) {
                $this->redrawControl();
                $this->presenter->redrawControl('flashes');
            } else {
                $this->redirect('this');
            }
        };

        return $form;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/../templates/detail.latte');
        $this->template->render();
    }
}