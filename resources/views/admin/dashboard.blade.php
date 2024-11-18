@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <section class="content">
        <!-- Summary Cards -->
        <div class="row mb-4">
            <!-- Total Projects Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalProjectsCount }}</h3>
                        <p>Total Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>
            <!-- Pending Projects Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $projectsPendingCount }}</h3>
                        <p>Projects Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
            <!-- Pending Tasks Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $tasksPendingCount }}</h3>
                        <p>Tasks Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
            </div>
            <!-- Managers and Staff Counts Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $managersCount }} / {{ $staffCount }}</h3>
                        <p>Managers / Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Table -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>
            </div>
            <div class="card-body p-1 table-responsive text-nowrap">
                <table class="table table-striped projects" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Team Members</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="text-center">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a>{{ $row->name }}</a><br>
                                    <small>Created {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        @if($row->team->count() > 0)
                                            @foreach($row->team as $team)
                                                <li class="list-inline-item text-center">
                                                    <img alt="Avatar" class="table-avatar" src="{{ asset('asset/dist/img/avatar.png') }}"><br>
                                                    <small>{{ $team->name }}</small>
                                                </li>
                                            @endforeach
                                        @else
                                            <small>No team members assigned</small>
                                        @endif
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($row->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->end_date)->format('d M Y') }}</td>
                                <td class="project-state">
                                    @php
                                        $statusClass = match($row->status) {
                                            'pending' => 'warning',
                                            'in-progress' => 'info',
                                            'completed' => 'success',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $statusClass }}">{{ $row->status }}</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.show', $row->id) }}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.projects.edit', $row->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal{{ $row->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
