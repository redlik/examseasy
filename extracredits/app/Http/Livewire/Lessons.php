<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Lesson;

class Lessons extends Component
{
    public $search;

    protected $queryString = ['search'];


    public function render()
    {
        return view('livewire.lessons', ['lessons' => Lesson::where('title', 'like', '%'.$this->search.'%')->get()]);
    }
}
