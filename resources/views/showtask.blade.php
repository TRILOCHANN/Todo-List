<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            {{-- Auth::user()->name --}}
            <!-- Right Side -->
            <div class="ms-auto">
                <a class="btn btn-primary" href="{{ route('logout')}}">Logout</a>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('storetask') }}" id="todo-form">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="AddNewTask" class="form-control" id="todo-input"
                                    placeholder="Add new task" required>
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                            <span class="text-danger small">
                                @error('AddNewTask')
                                    {{$message}}
                                @enderror
                            </span>
                        </form>

                        <ul class="list-group" id="todo-list">
                            @foreach($data as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$task->description}}
                                    <div>
                                        <a href="{{route('user.edit',$task->id)}}" class="btn btn-sm btn-outline-primary me-1">&#9998;</a>
                                        <a href="{{route('user.delete',$task->id)}}" class="btn btn-sm btn-outline-danger">&#x2715;</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
