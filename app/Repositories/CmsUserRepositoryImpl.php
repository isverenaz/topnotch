<?php

namespace App\Repositories;

use App\Contracts\CmsUserRepository;
use App\Models\CmsUser;

class CmsUserRepositoryImpl implements CmsUserRepository
{
    protected $model;
    protected $cms_user;

    public function __construct()
    {
        $this->model  = new CmsUser();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->whereId($id)->delete();
    }
}
