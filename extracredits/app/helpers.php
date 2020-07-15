<?php

Use App\Lesson;
Use App\User;

function user_unlocked($lesson_id) {
    $lesson_id = $lesson_id;
    $current_user_id = Auth::user()->id;
    $current_lesson = Lesson::find($lesson_id);
    // dd($current_user->id);
    return ! is_null(
        DB::table('lesson_user')
          ->where('user_id', $current_user_id)
          ->where('lesson_id', $lesson_id)
          ->first()
    );

}
