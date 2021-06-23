@extends('app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-0 col-sm-16">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Blog Entry
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('errors')

                <!-- Edit Note Form -->
                    <form action="{{ url('note/'.$note->id .'/edit')}}" method="GET" class="form-horizontal">
                    @csrf()

                    <!-- Blog Note -->
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" id="title" value={{ $note->title }} class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="author" class="col-sm-2 control-label">Author</label>

                            <div class="col-sm-9">
                                <input type="text" name="author" id="author" value={{ $note->author }} class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="col-sm-2 control-label">Blog Text</label>

                            <div class="col-sm-9">
                                <textarea name="text" id="text" class="form-control" style="height:200px; resize: none">{{ $note->text }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="published" class="col-sm-2 control-label">Publish? (Y/N)</label>

                            <div class="col-sm-1">
                                <input type="checkbox" name="published" id="published" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <!-- Save Note Button -->
                                <button type="submit" class="btn btn-primary" formmethod="POST">
                                    <i class="fa fa-btn fa-save"></i>Save
                                </button>
                                <!-- Cancel Button -->
                                <button type="submit" class="btn btn-danger" formaction="{{ url('/')}}">
                                    <i class="fa fa-btn fa-remove"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
