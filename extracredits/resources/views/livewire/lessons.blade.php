<div class="d-block w-100 p-2">
    <div class="d-flex justify-content-between">
        <div class="form-group">
            <select wire:model="subject" name="subjects" id="" class="form-control">
                <option value="" selected>All subjects</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ ucfirst($subject->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" wire:model="search" type="search" name="search" placeholder="Search lessons by title...">
        </div>
    </div>
    <ul>
        @foreach ($lessons as $lesson)
            <li>{{ $lesson->title }}
        @endforeach
    </ul>
</div>
