@extends('layouts.app')

@section('content')
    @include('partials.breadcrumb', [
        'breadcrumbs' => [
            'Services' => null
        ]
    ])

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">Services</h2>
        </div>
        <div class="card-body">
            <table id="servicesTable" class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>${{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection


