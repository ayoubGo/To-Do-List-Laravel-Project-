@extends("layout.app")


@section("title","hello I am blade template !" )

@section("content")
    <div>
        @if (count($tasks))
            @foreach ($tasks as $task)
            <div>
                <a href="{{ route("task.show",["task" => $task->id]) }}">{{ $task->title }}</a>

            </div>

            @endforeach
        @else
            <div>There are no tasks</div>
        @endif
    </div>
@endsection
