<?php

namespace App\Repositories\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use Hash;

class UserRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    
    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    // Get all instances of model
    // public function all()
    // {
    //     return $this->model->get();
    // }

    public function getAllUsers($order_by = 'id', $sort = 'asc') {
        return $this->model::orderBy($order_by, $sort)->get();
    }
    public function updateStatus($id,$data) {
        return $this->model::where('id', $id)->updateOrCreate(['status' => 1]);
    }

    public function createInArray(array $data, Model $model)
    {
        $this->model = $model;
        return $this->model->insert($data);
    }

    // update record in the database
    public function update(array $data, Model $model)
    {
        return $model->update($data);
    }

    // remove record from the database
    public function delete(Model $model)
    {
        return $model->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    public function all($with)
    {
        return $this->model->with($with)->get();
    }


    // create a new record in the database
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }
}