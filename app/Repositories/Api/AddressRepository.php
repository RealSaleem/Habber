<?php

namespace App\Repositories\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class AddressRepository implements RepositoryInterface {
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    public function all($with = null)
    {
        if($with) {
            return $this->model->with($with)->where('status',true)->get();
        }
        else {
            return $this->model->get();
        }
        
    }


    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    // Insert data in multiple rows
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
    public function delete($id)
    {
        $this->model->find($id);
        $this->model->delete();
        return true;
    }

    // show the record with the given id
    public function UserAddresses($id)
    {
        return $this->model->where('user_id',$id)->get();
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}