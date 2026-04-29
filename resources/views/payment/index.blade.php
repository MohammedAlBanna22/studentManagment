@extends('app.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Payments</h3>
    </div>

    <!-- Search -->
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search payment name..."
                value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>
                </thead>

                <tbody>
                    @forelse($payment as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>${{ $item->amount ?? 0 }}</td>

                        <td>
                            @if($item->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                            @else
                            <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>

                        <td>{{ $item->created_at->format('Y-m-d') }}</td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No payments found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $payment->withQueryString()->links() }}
    </div>

</div>
@endsection
