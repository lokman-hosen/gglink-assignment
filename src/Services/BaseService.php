<?php

namespace Gglink\CrudPermission\Services;

class BaseService
{
    /**
     * @var model
     */
    protected $model;

    /**
     * Get list
     *
     * @return dataObject
     */
    public function getData()
    {
        return $this->model->get();
    }
}
