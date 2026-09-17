<x-admin.admin-layout title="Reviews">
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class=" appointments-card mt-4  ">
        <div class="appointments-header card-body  ">
            <h3 class="mb-1" >Manage Reviews</h3>
            <p class="mb-0">
                Approve or delete customer reviews.
            </p>
        </div>
   

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body pt-0">

            <div class="table-responsive">
                <table class="table appointments-table align-middle">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($reviews as $review)
                            <tr>
                                <td>{{ $review->name }}</td>

                                <td>
                                    <div class="review-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <span class="text-warning">★</span>
                                        @else
                                            <span class="text-secondary">☆</span>
                                        @endif
                                    @endfor
                                    </div>
                                </td>

                                <td>
                                    {{ Str::limit($review->comment, 70) }}
                                </td>

                                <td>
                                    @if ($review->is_approved)
                                        <span class="review-status review-approved">
                                            Approved
                                        </span>
                                    @else
                                        <span class="review-status review-pending">
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $review->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">

                                        @if (!$review->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" >
                                             
                                                <button type="submit" class="review-action-btn approve-review-btn" >
                                                    <i class="bi bi-check-lg"></i>
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.reviews.delete', $review->id) }}"  method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this review?')" >
                                          
                                       

                                            <button type="submit"  class="review-action-btn delete-review-btn" >
                                                <i class="bi bi-trash"></i>
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No reviews found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    </div>
 </main>
</x-admin.admin-layout>