<?php

namespace App\Repositories;

use App\Contracts\TeachersRepository;
use App\Models\Teacher;

class TeachersRepositoryImpl implements TeachersRepository
{
    protected $model;

    public function __construct()
    {
        $this->model  = new Teacher();
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
