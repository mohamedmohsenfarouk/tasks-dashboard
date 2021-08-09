@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a task</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ env('APP_URL') . '/api/create' }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" />
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add task</button>
                </form>
            </div>
        </div>
    </div>
@endsection
