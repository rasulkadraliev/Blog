@extends('app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-16">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Blog Entry
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('errors')

                <!-- New Note Form -->
                    <form action="{{ url('index')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Blog Note -->
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Title</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="author" class="col-sm-3 control-label">Author</label>

                            <div class="col-sm-6">
                                <input type="text" name="author" id="author" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="col-sm-3 control-label">Blog Text</label>

                            <div class="col-sm-6">
                                <textarea name="text" id="text" class="form-control" style="height:200px; resize: none"></textarea>
                            </div>
                        </div>

                        <!-- Add Note Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Note
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Notes -->
            @if (count($notes) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Blog Notes
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="200px">Title</th>
                                <th width="230px">Author</th>
                                <th width="100px">Date</th>
                                <th>Blog post</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($notes as $note)
                                <tr>
                                    <td width="150px" class="table-text"><div>{{ $note->title }}</div></td>
                                    <td width="170px" class="table-text"><div>{{ $note->author }}</div></td>
                                    <td width="100px" class="table-text"><div>{{ $note->date_published }}</div></td>
                                    <td class="table-text"><div>{{ $note->text }}</div></td>

                                    <!-- Note Delete Button -->
                                    <td>
                                        <form action="{{ url('note/'.$note->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
