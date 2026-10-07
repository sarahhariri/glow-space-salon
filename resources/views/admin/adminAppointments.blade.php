<x-admin.admin-layout>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="appointments-card mt-4">
            <div class="appointments-header d-flex align-items-center gap-2  card-body">

                <h3 class="mb-0">
                    Appointments
                </h3>

                <span class="appointment-count">
                    Total appointments:
                    {{ $appointments->count() }}
                </span>

            </div>
            <div class="table-responsive ">
                <table class="table appointments-table align-middle">

                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Expert</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr>
                                <td>
                                    {{ $appointment->customer_name }}
                                    <div class="small text-muted">
                                        {{ $appointment->customer_email }}
                                    </div>
                                </td>

                                <td>
                                    {{ $appointment->service->name }}
                                </td>

                                <td>
                                    {{ $appointment->teamMember->name }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_date->format('d M Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </td>

                                <td>
                                    {{ $appointment->customer_phone }}
                                </td>

                                <td>
                                    <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST"
                                        class="status-form">


                                        <div class="dropdown">
                                            <button
                                                class="btn status-dropdown dropdown-toggle status-{{ $appointment->status }}"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ ucfirst($appointment->status) }}
                                            </button>

                                            <ul class="dropdown-menu luxury-status-menu">
                                                @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                                    <li>
                                                        <button type="submit" name="status"
                                                            value="{{ $status }}" class="dropdown-item">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center">
                                    No appointments yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </main>

    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>

</x-admin.admin-layout>
