@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>
                    <div class="card-body">
                        <form action="{{ route('task.store') }}" method="POST" class="mt-4 p-4">
                            @csrf
                            @if(Session::has('task_msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi-check-circle-fill"></i> {{ session('task_msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Enter a Task"
                                       aria-label="Enter a Task" aria-describedby="button-add-task">
                                <button class="btn btn-primary" type="submit" id="button-add-task">Add Task</button>
                            </div>
                        </form>
                        <hr>
                        <ul class="list-group mt-4 p-4">
                            @foreach($tasks as $task)
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            {{ $task->name }}
                                        </div>
                                        <div class="col-md-2">
                                            <span class="text-muted small">{{ $task->user->name }}</span>
                                        </div>
                                        <div class="col-md-1 text-end">
                                            @if(Auth::user())
                                                @if(Auth::user()->id == $task->user_id)
                                                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                                class="bi-trash-fill"></i></button>
                                                    </form>
                                                @elseif(Auth::user()->roles->first()->id == 1)
                                                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                                class="bi-trash-fill"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{ $tasks->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
