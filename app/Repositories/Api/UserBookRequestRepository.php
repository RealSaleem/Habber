<?php

namespace App\Repositories\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserBookRequestRepository implements RepositoryInterface
{
    protected $model;

    
    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    public function all($with)
    {
        return $this->model->with($with)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        $data['status'] = 0;
        if(isset($data['image'])) {
            $file = $data['image'];
            $data['image'] = null;
            $data['user_id'] = auth()->user()->id;
            $userRequest = $this->model->create($data);
            $userRequestUpdate = $this->model->findOrFail($userRequest->id);
            Storage::disk('public')->deleteDirectory('user_requests/' .  $userRequest->id);
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "user_requests/". $userRequest->id.'/' . $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $userRequestUpdate->image = $filePath;
            $userRequestUpdate->update();
            $userRequestResponse = $this->model->findOrFail($userRequest->id);
            return $userRequestResponse;
        }
        else {
            $data['user_id'] = auth()->user()->id;
            return $this->model->create($data);
        }
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