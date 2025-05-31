@extends('layouts.app')

@section('content')
    @include('partials.breadcrumb', [
        'breadcrumbs' => [
            'Users' => null
        ]
    ])

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">Users</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
