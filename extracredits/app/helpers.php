<?php

Use App\Lesson;
Use App\User;

function user_unlocked($lesson_id) {
    $current_user_id = Auth::user()->id;
    $current_lesson = Lesson::find($lesson_id);
    dd($current_user_id);
    // if ($current_lesson->user->contains(1)) {
    //     return true;
    // }

}
