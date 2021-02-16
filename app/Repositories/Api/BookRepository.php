<?php
namespace App\Repositories\Api;
use App\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class BookRepository implements RepositoryInterface {
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    public function all($with)
    {
        return $this->model->with($with)->where('status',1)->get();
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
    public function delete(Model $model)
    {
        return $model->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByIsbn ($isbn) {
        return $this->model->where('isbn',$isbn)->first();
    }

    public function relatedGenreBooks ($id) {

        $ids = $this->model->find($id)->genres->pluck('id')->toArray();
        $genres = Genre::with('books')->whereIn('id',$ids)->get();
        return $genres[0]->books->where('status',1)->except($id);
       
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

    public function bookSearch($data) {
        return $this->model->where('status',1)->orWhere('title', 'like', "%{$data}%")->orWhere('author_name','like',"%{$data}%")->orWhere('description','like',"%{$data}%")->get();
    }

    public function filterByGenre($data) {
        if(is_array($data)) {
            $genres = Genre::with('books')->whereIn('title',$data)->get();
            
            
            $books = [];
           
            if(count($genres) > 1) {
              
                for ($i = 0; $i < count($genres); $i++) {
                    $books = $genres[$i]->books->where('status',1);
                }   
                return $books;
            }
            else {
                return $genres[0]->books->where('status',1);
            }
           
           
        }
        else {
            $genres = Genre::with('books')->where('title',$data)->get();
            if(count($genres) > 1) {
                for ($i = 0; $i < count($genres); $i++) {
                    $books = $genres[$i]->books->where('status',1);
                }   
                return $books;
            }
            else {
                return $genres[0]->books->where('status',1);
            }
        }
       
    }
}