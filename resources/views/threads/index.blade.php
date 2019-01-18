@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('thread.create')}}" class="btn btn-success">New Thread</a>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Threads</div>

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
                                <th>Owner</th>
                                <th>Date</th>
                                @if(Auth::user()->role == 'admin')
                                    <th>Delete</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($threads as $thread)
                                <tr>
                                    <td><a href="{{route('thread.single',$thread->id)}}">{{$thread->title}}</a></td>
                                    <td>{{strlen($thread->content) > 75 ? substr($thread->content,0,75)."..." : $thread->content}}</td>
                                    <td>{{$thread->user->name}}</td>
                                    <td>{{$thread->created_at}}</td>
                                    @if(Auth::user()->role == 'admin')
                                        <th>
                                            <a href="{{route('thread.adminDestroy',$thread->id)}}"
                                               class="btn btn-danger">Delete</a>
                                        </th>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Owner</th>
                                <th>Date</th>
                                @if(Auth::user()->role == 'admin')
                                    <th>Delete</th>
                                @endif
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
