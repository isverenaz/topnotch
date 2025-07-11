<?php
namespace App\Repositories;

use App\Contracts\PositionRepository;
use App\Models\Category;
use App\Models\Position;

class PositionRepositoryImpl implements PositionRepository
{
    protected $model;
    protected $position;

    public function __construct()
    {
        $this->model  = new Position();
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
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
