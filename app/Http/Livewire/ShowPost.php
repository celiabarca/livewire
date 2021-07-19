<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPost extends Component
{
    public $title;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render' => 'render']; 
    // ##### CAMBIAR NOMBRE A VARIABLE #####
    // public $titulo;
    // public function mount($title) {
    //     $this->titulo = $title;
    // }
    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('title', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->get();
        // $posts = Post::all();
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
}
