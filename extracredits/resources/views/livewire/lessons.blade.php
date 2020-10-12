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
    <table class="table">
        <thead class="thead-dark rounded">
            <tr>
                <th scope="col">Title</th>
                {{-- <th scope="col">Unlocked on</th> --}}
                <th scope="col">Subject</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
            <tr>
                <th scope="row">
                    {{ $lesson->title }}<br>
                    <span class="text-secondary"><small>{{ ucfirst($lesson->subject->name) }} >>
                            {{ $lesson->topic->subcategory->name }} >> {{ $lesson->topic->name }}</small></span>
                </th>
                <td>{{ ucfirst($lesson->subject->name) }}</td>
                <td><a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}"
                        class="text-success mr-2" title="View lesson"><i class="far fa-eye"></i> View lesson</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

                