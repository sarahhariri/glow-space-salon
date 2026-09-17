<x-admin.admin-layout>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container py-4">

        <h3>{{ $member->name }}'s Schedule</h3>

        <p class="text-muted">
            Manage working days and hours.
        </p>

    </div>
    <form action="{{ route('admin.team.schedule.update', $member) }}" method="POST">
    

    @php
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
      
    @endphp

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @foreach ($days as $day)
            @php
                $saved = $schedules->get( $day);
            @endphp

                <div class="row align-items-center py-3 border-bottom">

                    {{-- Day --}}
                    <div class="col-md-3">
                        <strong>{{ ucfirst($day) }}</strong>
                    </div>

                    {{-- Working --}}
                    <div class="col-md-2">
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="schedule[{{ $day }}][is_working]"
                                value="1"
                                @checked($saved ? $saved->is_working : true)
                            >

                            <label class="form-check-label">
                                Working
                            </label>
                        </div>
                    </div>

                    {{-- Start --}}
                    <div class="col-md-3">
                        <label class="small text-muted">From</label>

                        <input
                            type="time"
                            name="schedule[{{ $day }}][start_time]"
                            class="form-control"
                            value="{{ $saved ? $saved->start_time : '09:00' }}"
                        >
                    </div>

                    {{-- End --}}
                    <div class="col-md-3">
                        <label class="small text-muted">To</label>

                        <input
                            type="time"
                            name="schedule[{{ $day }}][end_time]"
                            class="form-control"
                            value="{{ $saved ? $saved->end_time : '17:00' }}"
                        >
                    </div>

                </div>

            @endforeach

        </div>
    </div>

    <div class="mt-4 text-end">
        <button type="submit" class="btn dashboard-btn px-4">
            Save Schedule
        </button>
    </div>

</form>
  </main>

</x-admin.admin-layout>
