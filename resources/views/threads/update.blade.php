@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Thread</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('thread.update')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$thread->id}}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{$thread->title}}" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" placeholder="Content" maxlength="255" name="content">{{$thread->content}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
