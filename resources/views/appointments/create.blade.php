<x-layout title="Book Appointment" :settings="$settings">

    <div class="container py-5">

        <div class="main-heading text-center mb-5">
            <h3>Book Your Appointment</h3>

            <p class="main-subtitle">
                Choose your preferred service, beauty expert, date, and time.
            </p>
        </div>

        <form action="{{ route('appointments.store') }}" method="POST" class="mt-4">

    <div class="row g-4">

        {{-- Service --}}
        <div class="col-md-6">
            <label class="form-label">Service</label>

            <select name="service_id" class="form-select" id="service_id" required>
                <option value="">Choose a service</option>

                @foreach($services as $service)
                    <option value="{{ $service->id }}" @selected(old('service_id', $selectedService ) == $service->id)>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Team Member --}}
        <div class="col-md-6">
            <label class="form-label">Beauty Expert</label>

            <select name="team_member_id" id="team_member_id" class="form-select" required>

                <option value="">Choose a beauty expert</option>

                @foreach($team as $member)
                    <option value="{{ $member->id }}">
                        {{ $member->name }}
                    </option>
                @endforeach

            </select>
        </div>


        {{-- Date --}}
        <div class="col-md-6">
            <label class="form-label">Appointment Date</label>

            <input type="date" name="appointment_date"  id="appointment_date" class="form-control"  min="{{ date('Y-m-d') }}" required>
        </div>


        {{-- Time --}}
        <div class="col-md-6">
            <label class="form-label">Appointment Time</label>

            <select name="appointment_time" id="appointment_time" class="form-select" required>

                <option value="">
                    Choose expert and date first
                </option>

            </select>
        </div>

        <div class="col-md-6">
    <label class="form-label">Your Name</label>

    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
</div>

<div class="col-md-6">
    <label class="form-label">Phone Number</label>

    <input  type="tel"  name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required >
</div>

<div class="col-12">
    <label class="form-label">Email</label>

    <input type="email"  name="customer_email"  class="form-control"  value="{{ old('customer_email') }}" required >
</div>

<div class="col-12">
    <label class="form-label">Notes <span class="text-muted">(Optional)</span></label>

    <textarea name="notes" class="form-control" rows="3" placeholder="Anything you'd like us to know?" >{{ old('notes') }}</textarea>
</div>

    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn main-btn px-5">
            Book Appointment
        </button>
    </div>

</form>

    </div>
   <script>
document.addEventListener('DOMContentLoaded', function () {

    const serviceSelect = document.getElementById('service_id');
    const memberSelect = document.getElementById('team_member_id');
    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');

    const selectedTeamMember = @json($selectedTeamMember ?? null);
    const selectedMemberName = @json($selectedMember?->name);
    const selectedService = @json($selectedService ?? null);


    // -----------------------------------
    // SERVICE -> EXPERT
    // -----------------------------------
    serviceSelect.addEventListener('change', function () {

        const serviceId = this.value;

        timeSelect.innerHTML =
            '<option value="">Choose expert and date first</option>';

        if (!serviceId) {
            return;
        }


        // If customer came from TEAM section,
        // expert is already selected.
        if (selectedTeamMember) {

            memberSelect.innerHTML = `
                <option value="${selectedTeamMember}" selected>
                    ${selectedMemberName}
                </option>
            `;

            memberSelect.disabled = false;

            return;
        }


        // Normal flow: service -> matching experts
        memberSelect.innerHTML =
            '<option value="">Loading experts...</option>';

        memberSelect.disabled = true;

        fetch(`/services/${serviceId}/team-members`)
            .then(response => {

                if (!response.ok) {
                    throw new Error('Unable to load experts');
                }

                return response.json();
            })
            .then(members => {

                memberSelect.innerHTML =
                    '<option value="">Choose a beauty expert</option>';

                if (members.length === 0) {
                    memberSelect.innerHTML =
                        '<option value="">No experts available</option>';
                    return;
                }

                members.forEach(member => {

                    const option = document.createElement('option');

                    option.value = member.id;
                    option.textContent = member.name;

                    memberSelect.appendChild(option);
                });

                memberSelect.disabled = false;
            })
            .catch(error => {

                console.error(error);

                memberSelect.innerHTML =
                    '<option value="">Unable to load experts</option>';
            });
    });



    // -----------------------------------
    // EXPERT + DATE -> AVAILABLE TIMES
    // -----------------------------------
    function loadAvailableTimes() {

        const memberId = memberSelect.value;
        const date = dateInput.value;

        if (!memberId || !date) {

            timeSelect.innerHTML =
                '<option value="">Choose expert and date first</option>';

            return;
        }

        timeSelect.innerHTML =
            '<option value="">Loading times...</option>';

        fetch(`/available-times?team_member_id=${memberId}&date=${date}`)
            .then(response => {

                if (!response.ok) {
                    throw new Error('Unable to load times');
                }

                return response.json();
            })
            .then(times => {

                if (times.length === 0) {

                    timeSelect.innerHTML =
                        '<option value="">No available times</option>';

                    return;
                }

                timeSelect.innerHTML =
                    '<option value="">Choose a time</option>';

                times.forEach(time => {

                    const option = document.createElement('option');

                    option.value = time.value;
                    option.textContent = time.label;

                    timeSelect.appendChild(option);
                });
            })
            .catch(error => {

                console.error(error);

                timeSelect.innerHTML =
                    '<option value="">Unable to load times</option>';
            });
    }



    // -----------------------------------
    // OPENED FROM TEAM MEMBER CARD
    // -----------------------------------
    if (selectedTeamMember) {

        // Show chosen expert immediately
        memberSelect.innerHTML = `
            <option value="${selectedTeamMember}" selected>
                ${selectedMemberName}
            </option>
        `;

        memberSelect.disabled = false;


        // Load ONLY this expert's services
        fetch(`/team-members/${selectedTeamMember}/services`)
            .then(response => {

                if (!response.ok) {
                    throw new Error('Unable to load services');
                }

                return response.json();
            })
            .then(services => {

                serviceSelect.innerHTML =
                    '<option value="">Choose a service</option>';

                services.forEach(service => {

                    const option = document.createElement('option');

                    option.value = service.id;
                    option.textContent = service.name;

                    serviceSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
            });
    }


    // -----------------------------------
    // OPENED FROM SERVICE BUTTON
    // -----------------------------------
    else if (selectedService) {

        serviceSelect.value = selectedService;

        serviceSelect.dispatchEvent(
            new Event('change')
        );
    }


    memberSelect.addEventListener(
        'change',
        loadAvailableTimes
    );

    dateInput.addEventListener(
        'change',
        loadAvailableTimes
    );

});
</script>
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Appointment Booked!',
                text: @json(session('success')),
                confirmButtonText: 'Done',
                confirmButtonColor: '#660033'
            });
          
        });
    </script>
@endif
</x-layout>
