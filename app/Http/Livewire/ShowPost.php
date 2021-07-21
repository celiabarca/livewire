<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPost extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $title;
    public $search='';
    public $sort = 'id';
    public $direction = 'desc';
    // Editat post 
    public $post, $open_edit=false, $image, $identificador;
    public $cant="10";

    public $readyToLoad = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];
    protected $listeners = ['render' => 'render', 'delete']; 
    protected $queryString =[
        'cant' => ['except'=>'10'],
        'sort' => ['except'=>'id'],
        'search' => ['except'=>''],
        'direction' => ['except'=>'desc']
    ];


    public function loadPosts () {
        $this->readyToLoad = true;
    }

    public function mount() {
        $this->identificador=rand();
        $this->post = New Post();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                             ->orWhere('title', 'like', '%' . $this->search . '%')
                             ->orderBy($this->sort, $this->direction)
                             ->paginate($this->cant);
        } else {
            $posts = [];
        }
        return view('livewire.show-post', compact('posts'));
    }
    public function order($sort) {
        if ($this->sort==$sort) {
            if ($this->direction=='desc') {
                $this->direction= 'asc';
            } else {
                $this->direction= 'desc';
            }

        } else {
            $this->sort = $sort;
        }
       

    }
    public function edit (Post $post) {
        $this->post = $post;
        $this->open_edit = true;
    } 
    public function update () {
        $this->validate();
        if($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }
        $this->post->save();
        $this->reset(['open_edit', 'image']);
        $this->identificador=rand();
        $this->emit('alert', 'post se ha actualizado');
    }
    public function updatingSearch() {
        $this->resetPage();
    } 
    public function delete (Post $post) {
        $post->delete();
    }
    // public function openEdit (Post $post) {
    //     $this->post = $post;
    // } 
}
