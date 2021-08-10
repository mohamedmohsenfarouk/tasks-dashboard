<div class="container">
    <div class="row justify-content-md-center mt-3 text-center">
        <div class="col-sm-12">

            @if (session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Tasks</h1>
            <div>
                <a style="margin: 19px;" href="{{ route('newTask') }}" class="btn btn-primary">New Task</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Subject</td>
                        <td colspan=2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->subject }}</td>
                            <td>
                                <a href="{{ route('editTask', $task->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('destroyTask', $task->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
            </div>
            {{ $tasks->links('vendor.pagination.bootstrap-4') }}

        @endsection
