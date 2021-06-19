@extends('app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-0 col-sm-16">

            <!-- Current Notes -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Blog Notes
                    </div>

                    <div class="panel-body">
{{--                        Note is not published message--}}

                    @if ($note->published == 'No')
                        <!-- Form Error List -->
                            <div class="alert alert-danger">
                                <strong>Caution! This note is not published</strong>
                            </div>
                        @endif

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
                                    <tr>
                                        <td width="150px" class="table-text"><div>{{ $note->title }}</div></td>
                                        <td width="170px" class="table-text"><div>{{ $note->author }}</div></td>
                                        <td width="100px" class="table-text"><div>{{ $note->date_published }}</div></td>
                                        <td class="table-text"><div>{{ $note->text }}</div></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
