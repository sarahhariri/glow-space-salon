<x-admin.admin-layout>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="card shadow-sm mt-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Gift Card Purchases</h4>

                    <span class="badge bg-dark">
                        {{ $giftCards->count() }} Requests
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">

                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Sender</th>
                                <th>Recipient</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($giftCards as $giftCard)
                                <tr>
                                    <td>
                                        <strong>{{ $giftCard->code }}</strong>
                                    </td>

                                    <td>{{ $giftCard->type }}</td>

                                    <td>
                                        ${{ number_format($giftCard->amount, 2) }}
                                    </td>

                                    <td>{{ $giftCard->sender_name }}</td>

                                    <td>{{ $giftCard->recipient_name }}</td>

                                    <td>{{ $giftCard->recipient_email }}</td>

                                    <td>
                                        <form action="{{ route('admin.giftCards.status', $giftCard->id) }}" method="POST"
                                            class=" d-flex gap-2">
                                            @csrf

                                            <select name="status" class="form-select form-select-sm  status-select">

                                                <option value="pending" @selected($giftCard->status === 'pending')>
                                                    Pending
                                                </option>

                                                <option value="paid" @selected($giftCard->status === 'paid')>
                                                    Paid
                                                </option>

                                                <option value="sent" @selected($giftCard->status === 'sent')>
                                                    Sent
                                                </option>

                                            </select>


                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.giftCards.delete', $giftCard) }}" method="POST"
                                            class="delete-gift-card-form">
                                            

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Delete gift card">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        {{ $giftCard->created_at->format('d M Y') }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        No gift card purchases found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </main>
    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        }); 
        
    document.querySelectorAll('.delete-gift-card-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'This gift card request will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#660033',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

</script>
        </x-admin.admin-layout>
