<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use App\Lesson;
use App\Subject;
use Auth;

class Lessons extends Component
{
    public $search;

    public $subject;

    protected $queryString = ['search', 'subject'];

    protected $query;

    public function render()
    {
        $subject = $this->subject;
        $query = Lesson::where('title', 'like', '%'.$this->search.'%')->when($subject, function ($query, $subject){
            return $query->where('subject_id', $subject);
        })->has('user', '=', Auth::id())
        ->get();

        $subjects = Subject::orderBy('name', 'asc')->get();
        return view('livewire.lessons', ['lessons' => $query, 'subjects'=>$subjects]);
    }
}
