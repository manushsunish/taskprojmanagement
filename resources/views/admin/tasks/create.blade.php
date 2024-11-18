@extends('layouts.master')
@section('title', 'Add Task')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Add Task</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.tasks.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Task Name</label>
                                <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Task Description</label>
                                <textarea id="inputDescription" class="form-control" rows="4" name="description" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select
                                    id="inputStatus"
                                    class="form-control custom-select"
                                    name="status"
                                >
                                    <option selected="" disabled="">Select one</option>
                                    <option value="pending">Pending</option>
                                    <option value="in-progress">in-progress</option>
                                    <option name="completed">done</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assignTo">Assign To (Managers Only)</label>
                                <select name="staff" id="assignTo" class="form-control custom-select" required>
                                    <option selected disabled>Select one</option>
                                    @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('admin.tasks.index') }}" class="btn btn-danger btn-sm btn-flat">Cancel</a>
                                    <button type="submit" class="btn btn-info btn-sm btn-flat float-right">Add Task</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
