<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="display-3">Tasks</h1>
                        <div>
                            <a style="margin: 19px;" href="{{ route('newTask') }}" class="btn btn-primary">New
                                Task</a>
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
                                            <a href="{{ route('editTask', $task->id) }}"
                                                class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ env('APP_URL') . '/api/delete/' . $task->id }}"
                                                method="post">
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
                    </div>
                </div>
                {{ $tasks->links('vendor.pagination.bootstrap-4') }}

            </div>

</x-app-layout>
