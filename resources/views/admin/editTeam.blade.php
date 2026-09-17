<x-admin.admin-layout>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="card shadow-sm mt-4">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Edit Team Member</h3>

                <a href="{{ route('admin.team') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.updateTeam', $team->id) }}" method="POST" enctype="multipart/form-data">

                    <div class="row">

                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>

                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $team->name) }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Services</label>

                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]"
                                                value="{{ $service->id }}" id="service{{ $service->id }}" @checked($team->services->contains($service->id))>

                                            <label class="form-check-label" for="service{{ $service->id }}">
                                                {{ $service->name }}
                                            </label>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Bio --}}
                        <div class="col-12 mb-3">
                            <label class="form-label">Biography</label>

                            <textarea rows="4" name="bio" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $team->bio) }}</textarea>

                            @error('bio')
                                <div class="invalid-feedback"> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Instagram --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Instagram</label>

                            <input type="text" name="instagram"
                                class="form-control @error('instagram') is-invalid @enderror"
                                value="{{ old('instagram', $team->instagram) }}">
                            @error('instagram')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Upload New Image --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Upload New Image</label>

                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Current Image --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Current Image</label>
                            @if ($team->image)
                                <img src="{{ asset('assets/images/team/' . $team->image) }}" class="rounded-circle"
                                    width="120" height="120" style="object-fit:cover;">
                            @else
                                <p class="text-muted">No image available.</p>
                            @endif
                        </div>

                        {{-- Active --}}
                        <div class="col-md-6 mb-3 d-flex align-items-center">

                            <div class="form-check">

                                <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                    @checked($team->is_active)>

                                <label class="form-check-label"> Active Team Member </label>

                            </div>
                        </div>

                    </div>

                    <div class="text-end">

                        <button class="btn dashboard-btn px-4"> <i class="bi bi-check-circle"></i>Update Team Member</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</x-admin.admin-layout>
