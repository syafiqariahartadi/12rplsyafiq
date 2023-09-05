<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;


class Create extends Component
{
    use WithFileUploads;
//image
#[Rule('required', message: 'Masukkan Gambar Post')]
#[Rule('image', message: 'File Harus Gambar')]
#[Rule('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    //title
#[Rule('required', message: 'Masukkan Judul Post')]
public $title;

    //content

public $content;


/**
* store
*
* @return void
*/
public function store()
{
$this->validate();

$this->image->storeAs('public/posts', $this->image->hashName());

Post::create([
    'image' => $this->image->hashName(),
'title' => $this->title,  
'content' => $this->content,
]);
//flash message

session()->flash('message', 'Data Berhasil Disimpan.');
//redirect
return redirect()->route('posts.index');
}

    public function render()
    {
        return view('livewire.posts.create');
    }
}

