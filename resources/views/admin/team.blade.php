<x-admin.admin-layout>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="card shadow-sm mt-4">
            <div class="card-body">

                <h4 class="mb-4">Add Team Member</h4>

                <form action="{{ route('admin.saveTeam') }}" method="POST" enctype="multipart/form-data">


                    <div class="row">

                        <div class="col-12 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name"
                                value="{{ old('name') }}">
                        </div>



                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Services</label>

                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" name="services[]"
                                                value="{{ $service->id }}" id="service{{ $service->id }}">

                                            <label class="form-check-label" for="service{{ $service->id }}">
                                                {{ $service->name }}
                                            </label>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Biography</label>
                            <textarea name="bio" rows="4" class="form-control" placeholder="Write a short biography...">{{ old('bio') }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Instagram Username</label>
                            <input type="text" name="instagram" class="form-control" placeholder="@glowspace_sarah"
                                value="{{ old('instagram') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked style="background-color: #660033; border:#660033;">

                                <label class="form-check-label" >
                                    Active Team Member
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="text-end">
                        <button class="btn" style="background-color: #660033; color:white;">
                            <i class="bi bi-person-plus-fill"></i>
                            Save Team Member
                        </button>
                    </div>

                </form>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">

                        <h4 class="mb-4">All Team Members</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Services</th>
                                        <th>Instagram</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($team as $teamMember)
                                        <tr>
                                            <td>
                                                @if ($teamMember->image)
                                                    <img src="{{ asset('assets/images/team/' . $teamMember->image) }}"
                                                        alt="{{ $teamMember->name }}" width="70" height="70"
                                                        class="rounded" style="object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>

                                            <td>{{ $teamMember->name }}</td>

                                                    <td>
                                                @forelse ($teamMember->services as $service)
                                                    <span class="badge bg-light text-dark border me-1 mb-1">
                                                        {{ $service->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-muted">No services</span>
                                                @endforelse
                                            </td>

                                            <td>
                                                <a href="https://instagram.com/{{ ltrim($teamMember->instagram, '@') }}"
                                                    target="_blank" class="text-decoration-none">
                                                    {{ $teamMember->instagram }}
                                                </a>
                                            </td>
                                          <td>
                                            @if ($teamMember->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <form action="{{ route('admin.editTeam', $teamMember->id) }}"
                                                        method="GET">
                                                      
                                                        <button type="submit" class="btn btn-outline-warning btn-sm">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.deleteTeam', $teamMember->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this team member?');">

                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.team.schedule', $teamMember->id) }}"
                                                        class="btn btn-sm btn-outline-secondary action-btn schedule-btn">
                                                        <i class="bi bi-calendar-week"></i>
                                                        Schedule
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No team members added yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
</x-admin.admin-layout>
