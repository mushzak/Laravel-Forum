@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('thread.create')}}" class="btn btn-success">New Thread</a>
        <a href="{{route('thread')}}" class="btn btn-info">All Threads</a>
        <br><br><div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Threads</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->threads as $thread)
                                <tr>
                                    <td><a href="{{route('thread.single',$thread->id)}}">{{$thread->title}}</a></td>
                                    <td>{{strlen($thread->content) > 75 ? substr($thread->content,0,75)."..." : $thread->content}}</td>
                                    <td>{{$thread->created_at}}</td>
                                    <th><a href="{{route('thread.edit',$thread->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('thread.destroy',$thread->id)}}" class="btn btn-danger">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

@endsection
