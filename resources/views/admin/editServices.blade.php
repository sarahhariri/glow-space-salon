<x-admin.admin-layout>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Edit Service</h3>

            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.updateServices', $service->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Service Name --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Service Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $service->name) }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>

                        <select
                            name="category"
                            class="form-select @error('category') is-invalid @enderror">

                            <option value="Beauty"
                                @selected(old('category', $service->category) == 'Beauty')>
                               Signature Beauty
                            </option>

                            <option value="Hair"
                                @selected(old('category', $service->category) == 'Hair')>
                                Hair Studio
                            </option>

                            <option value="Wedding"
                                @selected(old('category', $service->category) == 'Wedding')>
                                Bridal Collection
                            </option>

                            <option value="Spa & Massage"
                                @selected(old('category', $service->category) == 'Spa & Massage')>
                                Wellness & Spa
                            </option>

                        </select>

                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price ($)</label>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $service->price) }}">

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Duration --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Duration (minutes)</label>

                        <input
                            type="number"
                            name="duration"
                            class="form-control @error('duration') is-invalid @enderror"
                            value="{{ old('duration', $service->duration) }}">

                        @error('duration')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>

                        <textarea
                            rows="5"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Current Image --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">
                            Current Image
                        </label>

                        @if($service->image)

                            <img
                                src="{{ asset('assets/images/services/'.$service->image) }}"
                                class="img-thumbnail"
                                width="150">

                        @else

                            <p class="text-muted">No image available.</p>

                        @endif
                    </div>

                    {{-- Upload New Image --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Upload New Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Active --}}
                    <div class="col-12 mb-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked($service->is_active)>

                            <label class="form-check-label">
                                Active Service
                            </label>

                        </div>

                    </div>

                </div>

                <div class="text-end">

                    <button class="btn dashboard-btn px-4">
                        <i class="bi bi-check-circle"></i>
                        Update Service
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
        </main>
</x-admin.admin-layout>
