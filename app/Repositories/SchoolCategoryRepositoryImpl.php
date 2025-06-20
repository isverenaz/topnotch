<?php

namespace App\Repositories;

use App\Contracts\SchoolCategoryRepository;
use App\Models\SchoolCategory;

class SchoolCategoryRepositoryImpl implements SchoolCategoryRepository
{
    protected $model;

    public function __construct()
    {
        $this->model  = new SchoolCategory();
    }

    public function getAll()
    {
        return $this->model->orderBy('id','DESC')->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function edit($id)
    {
        return $this->model->whereId($id)->first();
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
