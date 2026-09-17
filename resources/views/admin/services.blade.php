<x-admin.admin-layout>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<form action="{{ route('admin.saveServices') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h4 class="mb-0">Add New Service</h4>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Service Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Enter service name">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>

                    <select
                        name="category"
                        class="form-select @error('category') is-invalid @enderror">

                        <option value="">Select Category</option>
                        <option value="Beauty" {{ old('category')=='Beauty' ? 'selected' : '' }}>Signature Beauty</option>
                        <option value="Hair" {{ old('category')=='Hair' ? 'selected' : '' }}>Hair Studio</option>
                        <option value="Wedding" {{ old('category')=='Wedding' ? 'selected' : '' }}>Bridal Collection</option>
                        <option value="Spa & Massage" {{ old('category')=='Spa & Massage' ? 'selected' : '' }}>Wellness & Spa</option>
                    </select>

                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Price ($)</label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}"
                        placeholder="0.00">

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Duration (minutes)</label>

                    <input
                        type="number"
                        name="duration"
                        class="form-control @error('duration') is-invalid @enderror"
                        value="{{ old('duration') }}"
                        placeholder="60">

                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Write a short description...">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Service Image</label>

                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="is_active"
                            value="1"
                            checked>

                        <label class="form-check-label">
                            Active Service
                        </label>
                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer text-end">
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Save Service
            </button>
        </div>
    </div>
</form>
<div class="card shadow-sm mt-4">
    <div class="card-header">
        <h4 class="mb-0">All Services</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>
                                @if ($service->image)
                                    <img
                                        src="{{ asset('assets/images/services/' . $service->image) }}"
                                        alt="{{ $service->name }}"
                                        width="70"
                                        height="70"
                                        style="object-fit: cover; border-radius: 8px;">
                                @else
                                    No Image
                                @endif
                            </td>

                            <td>{{ $service->name }}</td>

                            <td>{{ $service->category }}</td>

                            <td>${{ number_format($service->price, 2) }}</td>

                            <td>{{ $service->duration }} minutes</td>

                            <td>
                                 <div class="d-flex justify-content-center align-items-center gap-2">
                                @if ($service->is_active)
                                    <span class="badge bg-success p-2 ">Active</span>
                                @else
                                    <span class="badge bg-secondary p-2">Inactive</span>
                                @endif
                               
                                  <form method="GET" action="{{ route('admin.editServices', $service->id) }}">
                                        <button type="submit" class="btn btn-outline-danger" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>
                                  <form method="POST" action="{{ route('admin.deleteServices', $service->id) }}">
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No services added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
        </main>
</x-admin.admin-layout>
