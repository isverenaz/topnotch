<?php

namespace App\Repositories;

use App\Contracts\SlidersRepository;
use App\Models\Slider;

class SlidersRepositoryImpl implements SlidersRepository
{
    protected $model;
    protected $slider;

    public function __construct()
    {
        $this->model  = new Slider();
    }

    public function getAll()
    {
        return $this->model->first();
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
