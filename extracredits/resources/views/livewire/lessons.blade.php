<div>
    <input wire:model="search" type="search" placeholder="Search lessons by title...">
    <ul>
        @foreach ($lessons as $lesson)
            <li>{{ $lesson->title }}
        @endforeach
    </ul>
</div>
