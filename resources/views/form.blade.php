@extends("layout.app")

@section("title", isset($task) ? "Edit Task" : "Add Task")

@section("styles")
    <style>
        .error_message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection


@section("content")

    <form method="POST" action="{{ isset($task) ? route("task.update" , ["task" => $task->id]) : route("task.store") }}">
        @csrf
        @isset($task)
            @method("PUT")
        @endisset
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old("title")  }}"
                @class(["border-red-500" =>$errors->has("title")])>
            @error("title")
                 <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="10" @class(["border-red-500" =>$errors->has("description")])>{{ $task->long_description ?? old("long_description") }}</textarea>
            @error("description")
                <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="long_description">Description</label>
            <textarea name="long_description" id="long_description" rows="10" @class(["border-red-500" =>$errors->has("long_description")])>{{ $task->description ?? old("description")  }}</textarea>
            @error("long_description")
                <p class="error_message">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="btn">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route("task.index") }}" class="btn">Cancel</a>
        </div>
    </form>
@endsection
