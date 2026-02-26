@extends('admin.app')

@section('title', 'Patients List - Admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Patients List</h1>
        <a href="{{ route('admin.patients.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Patient
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Petcare Patients</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Species (Breed)</th>
                            <th>Owner</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->species }} {{ $patient->breed ? '('.$patient->breed.')' : '' }}</td>
                                <td>{{ $patient->owner_name }}</td>
                                <td>{{ $patient->phone ?? '-' }}</td>
                                <td>
                                    @if($patient->status == 'Rawat Inap')
                                        <span class="badge badge-warning">{{ $patient->status }}</span>
                                    @elseif($patient->status == 'Rawat Jalan')
                                        <span class="badge badge-info">{{ $patient->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $patient->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No patients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
