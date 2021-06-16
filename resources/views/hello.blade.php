<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>

        <!-- Styles -->
        <style>
            * {
                box-sizing: border-box;
            }

            input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: none;
            }

            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }

            button[type=submit] {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }

            button[type=submit]:hover {
                background-color: #45a049;
            }

            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 40px;
            }

            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
            }

            .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                .col-25, .col-75, button[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form action="{{ url('/hello')}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-25">
                        <label for="title">Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="title" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="text">Entry text</label>
                    </div>
                    <div class="col-75">
                        <textarea id="text" name="text" placeholder="" style="height:200px"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="author">Author</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="author" name="author" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i>Add Blog Note
                        </button>
                    </div>
                </div>
            </form>

            <div class="panel-body">
                <!-- Display Validation Errors -->
            @include('errors')
            </div>

            <!-- Current Tasks -->
            @if (count($notes) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Blog Entries
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <tr>
                                    <th>Blog entry</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($notes as $blog)
                                <tr>
                                    <td class="table-text"><div>{{ $blog->header }}</div></td>

                                    <!-- Task Delete Button -->
                                    <td>
                                        <form action="{{ url('/'.$blog->id) }}" method="POST">
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
    </body>
</html>
