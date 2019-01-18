@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('thread.create')}}" class="btn btn-success">New Thread</a>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$thread->title}}</div>
                    <div class="card-body">
                        {{$thread->content}}
                        <hr>
                        <div>
                            @foreach($thread->replies as $reply)
                                <p>{{$reply->text}}<br> - {{$reply->user->name}}</p>
                            @endforeach
                        </div>

                            <hr>
                            <form action="{{route('thread.reply')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$thread->id}}">
                                <div class="form-group">
                                    <label for="text">Add reply</label>
                                    <textarea class="form-control" id="text" name="text"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Reply</button>
                            </form>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
