<?php
namespace App\Repositories\Api;
use App\Genre;
use App\Book;
use App\Bookmark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class OrderRepository implements RepositoryInterface {
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        // $this->$key = $model;
        $this->model = $model;
    }

    public function all($with)
    {
        return $this->model->with($with)->where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        $books =  [];
        $bookmarks = [];
        $arr['user_id'] = auth()->user()->id;
        $arr['total_price'] = $data['total_price'];
        $arr['total_quantity'] = $data['total_quantity'];
        $arr['address_id'] = $data['address_id'];
        $arr['status'] = "pending";
    
        if( count($data['cartProducts']->books) > 0) {
            foreach($data['cartProducts']->books as $i) {
                if($this->decreaseBookQuantity($i->id,$i->pivot->quantity) == true) {
                    array_push($books, $i);
                }
                else {
                    return false;
                }
            }
            $order = $this->model->create($arr);
           
        }
        if(count($data['cartProducts']->bookmarks) > 0) {
            foreach($data['cartProducts']->bookmarks as $j) {
                if($this->decreaseBookmarkQuantity($j->id,$j->pivot->quantity) == true) {
                    array_push($bookmarks, $j);
                }
                else {
                    return false;
                }
            }       
        }
        for($i = 0; $i < count($books); $i++) {
            $order->books()->attach($books[$i]->id, ['quantity' => $books[$i]->pivot->quantity , 'price' => $books[$i]->pivot->price,'product_type' =>'book' ]);
        }
        for($i = 0; $i < count($bookmarks); $i++) {
            $order->bookmarks()->attach($bookmarks[$i]->id,['quantity' => $bookmarks[$i]->pivot->quantity , 'price' => $bookmarks[$i]->pivot->price,'product_type' => 'bookmark' ]);
        }
        return $order;

    }
    // Insert data in multiple rows
    public function createInArray(array $data, Model $model)
    {
        $this->model = $model;
        
        return $this->model->insert($data);
    }

    public function decreaseBookQuantity($id,$quantity) {
        $book = Book::find($id);
        if($book->quantity > $quantity) {
            $book->quantity = $book->quantity - $quantity;
            $book->update();
            return true;
        }
        else {
            return false;
        }
    }

    public function decreaseBookmarkQuantity($id,$quantity) {
        $bookmark = Bookmark::find($id);
        if($bookmark->quantity > $quantity) {
            $bookmark->quantity = $bookmark->quantity - $quantity;
            $bookmark->update();
            return true;
        }
        else {
            return false;
        }
    }

    // update record in the database
    public function update(array $data, Model $model)
    {
        // dd($model);
        $books =  [];
        $bookmarks = [];
        $arr['total_price'] = $data['total_price'];
        $model->update($arr);
        $model->books()->detach();
        $model->bookmarks()->detach();
        foreach($data['product'] as $i) {
            if( $i['product_type'] == "book") {
                array_push($books, $i);
            }
            else {
                array_push($bookmarks ,$i);
            }
        }
        if(count($books) > 0) {
        
            for($i = 0; $i < count($books); $i++) {
                $model->books()->attach($books[$i]['product_id'], ['quantity' => $books[$i]['quantity'] , 'price' => $books[$i]['price'],'product_type' => $books[$i]['product_type'] ]);
            }
        }
        if(count($bookmarks) > 0) {
            for($i = 0; $i < count($bookmarks); $i++) {
                $model->bookmarks()->attach($bookmarks[$i]['product_id'],['quantity' => $bookmarks[$i]['quantity'] , 'price' => $bookmarks[$i]['price'],'product_type' => $bookmarks[$i]['product_type'] ]);
            }
        }
        return $model;
        // return $model->update($data);
    }

    // remove record from the database
    public function delete(Model $model)
    {
        $model->books()->detach();
        $model->bookmarks()->detach();
        return $model->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
     
    public function userCart($id) {
        return $this->model->where('user_id',$id)->first();
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
        return $this->model->orWhere('title', 'like', "%{$data}%")->orWhere('author_name','like',"%{$data}%")->orWhere('description','like',"%{$data}%")->where('status',1)->get();
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