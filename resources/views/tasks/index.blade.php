<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo List Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    {{--bootstrap css--}}
    </head>
<body>
<div class="container">
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <h1>ToDo list</h1>
        </div>
{{--display success message--}}
        @if(Session('success'))
            <div class="alert alert-success">
                <strong>Success:</strong>{{ Session::get('success') }}
            </div>
        @endif

{{--print error message--}}
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error:</strong>

            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
            </div>
        @endif

            <form action="{{ route('task.store') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                <div class="col-md-9">
                    <input type="text" name="new_task_name" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary btn-block" value="Add Task">
                </div>
                </div>
            </form>



        {{--display Stored Data--}}

        @if(count($DisplayTask) > 0)

           <table class="table" style="margin-top: 20px">
               <thead>
               <th>Task No.</th>
               <th>Task Name</th>
               <th>Edit</th>
               <th>Delete</th>
               </thead>
               <tbody>
               @foreach($DisplayTask as $data)
                   <tr>
                       <th>{{ $data->id }}</th>
                       <td>{{ $data->name }}</td>
                       <td><a href="{{ route('task.edit',['tasks'=>$data->id]) }}" class="btn btn-primary"  >Edit</a></td>
                       <td>
                           <form action="{{route('task.destroy',['tasks'=>$data->id]) }}" method="POST">
                               {{ csrf_field() }}
                               <input type="hidden" name="_method" value="delete">
                               <input type="submit" class="btn btn-danger" value="delete">
                           </form>
                       </td>
                   </tr>
               @endforeach
               </tbody>
           </table>

        @endif
        <div class="row page.link">
           {{ $Displaytask }}
        </div>
    </div>
</div>
{{--bootstrap js--}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>