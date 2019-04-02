<?php
/**
 * Created by PhpStorm.
 * User: ktulinger
 * Date: 2019-03-31
 * Time: 15:01
 */

namespace Tulinkry\Components\Grid;


use Exception;
use Nette\Application\UI\Multiplier;
use Nette\Database\IRow;
use Nette\Utils\Callback;
use Tulinkry\Application\UI\Control;
use Tulinkry\Components\Grid;

class GridRow extends Control
{
    /**
     * @var IRow
     */
    private $entity;
    /**
     * @var Grid
     */
    private $grid;

    /**
     * GridDetail constructor.
     * @param IRow $entity
     */
    public function __construct(IRow $entity, Grid $grid)
    {
        parent::__construct();
        $this->entity = $entity;
        $this->grid = $grid;
    }

    public function handleDelete()
    {
        try {
            $this->entity->delete();
            $this->entity = null;
            $this->presenter->flashMessage('Záznam byl smazán.', 'success');
        } catch (Exception $e) {
            $this->presenter->flashMessage('Záznam nebyl smazán: ' . $e->getMessage(), 'danger');
        }

        if ($this->presenter->isAjax()) {
            // do not redraw itself as the entity is now vanished
            $this->grid->redrawControl();
            $this->presenter->redrawControl('flashes');
        } else {
            $this->redirect('this');
        }
    }

    protected function createComponentColumn($name)
    {
        return new Multiplier(function ($key) {
            return Callback::invoke($this->grid->columnsFactories[$key], $this->entity);
        });
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/../templates/row.latte');
        $this->template->columns = $this->grid->columnsFactories;
        $this->template->entity = $this->entity;
        $this->template->grid = $this->grid;
        $this->template->query_param = GridDetailUpdate::QUERY_PARAM;
        $this->template->render();
    }
}