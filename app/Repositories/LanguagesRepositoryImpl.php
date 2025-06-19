<?php

namespace App\Repositories;

use App\Contracts\LanguagesRepository;
use App\Models\Language;

class LanguagesRepositoryImpl implements LanguagesRepository
{
    protected $model;

    public function __construct()
    {
        $this->model  = new Language();
    }

    public function getAll()
    {
        return $this->model->with('parentLanguages')->orderBy('id','DESC')->get();
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
