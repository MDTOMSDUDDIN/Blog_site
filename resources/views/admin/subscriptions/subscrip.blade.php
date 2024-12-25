@extends('layouts.admin')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card Structure -->
            <div class="card">
                <!-- Card Header -->
                <div class="card-header bg-primary">
                    <h3 class="text-white">Subscribers</h3>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($subscriptions->isEmpty())
                        <p>No subscribers found.</p>
                    @else
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Subscribed On</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->id }}</td>
                                        <td>{{ $subscription->email }}</td>
                                        <td>{{ $subscription->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('subscriptions.delete', $subscription->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
