@extends('layouts.master')
@section('title', 'Users')
@section('content')
<section class="content">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
        </div>
        <div class="card-body p-1 table-responsive text-nowrap">
            <table class="table table-striped projects" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form style="display: inline;" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

