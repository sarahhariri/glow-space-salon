<x-layout title="Book Appointment" :settings="$settings">

    <div class="container py-5">

        <div class="main-heading text-center mb-5">
            <h3>Book Your Appointment</h3>

            <p class="main-subtitle">
                Choose your preferred service, beauty expert, date, and time.
            </p>
        </div>

        <form action="{{ route('appointments.store') }}" method="POST" class="mt-4 gs-booking-form">

            <div class="row g-4">

                {{-- Service --}}
                <div class="col-md-6">
                    <label class="form-label">Service</label>
                     <div class="gs-select-wrapper">
                    <select name="service_id" class="form-select gs-custom-select" id="service_id" required>
                        <option value="">Choose a service</option>

                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @selected(old('service_id', $selectedService) == $service->id)>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                     </div>
                </div>


                {{-- Team Member --}}
                <div class="col-md-6">
                    <label class="form-label">Beauty Expert</label>

                   <div class="gs-select-wrapper">
    <select name="team_member_id"
            id="team_member_id"
            class="form-select gs-custom-select"
            required>
        <option value="">Choose a beauty expert</option>

        @foreach ($team as $member)
            <option value="{{ $member->id }}">
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>
                </div>


                {{-- Date --}}
                <div class="col-md-6">
                    <label class="form-label">Appointment Date</label>

                    <input type="date" name="appointment_date" id="appointment_date" class="form-control"
                        min="{{ date('Y-m-d') }}" required>
                </div>


                {{-- Time --}}
                <div class="col-md-6">
                    <label class="form-label">Appointment Time</label>

                  <div class="gs-select-wrapper">
    <select name="appointment_time"
            id="appointment_time"
            class="form-select gs-custom-select"
            required>
        <option value="">Choose expert and date first</option>
    </select>
</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Your Name</label>

                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>

                    <input type="tel" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}"
                        required>
                </div>

                <div class="col-12">
                    <label class="form-label">Email</label>

                    <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}"
                        required>
                </div>

                <div class="col-12">
                    <label class="form-label">Notes <span class="text-muted">(Optional)</span></label>

                    <textarea name="notes" class="form-control" rows="3" placeholder="Anything you'd like us to know?">{{ old('notes') }}</textarea>
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

    // =====================================
    // ELEMENTS
    // =====================================

    const serviceSelect = document.getElementById('service_id');
    const memberSelect = document.getElementById('team_member_id');
    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');

    const bookingForm = serviceSelect.closest('form');

    const selectedTeamMember = @json($selectedTeamMember ?? null);
    const selectedMemberName = @json($selectedMember?->name);
    const selectedService = @json($selectedService ?? null);

    let expertsRequest = 0;
    let timesRequest = 0;

    // =====================================
    // REUSABLE CUSTOM DROPDOWN
    // =====================================

    function createCustomDropdown(select) {

        const wrapper = select.closest('.gs-select-wrapper');

        if (!wrapper) return null;

        const control = document.createElement('button');
        control.type = 'button';
        control.className = 'gs-dropdown-control';
        control.setAttribute('aria-haspopup', 'listbox');
        control.setAttribute('aria-expanded', 'false');

        const menu = document.createElement('div');
        menu.className = 'gs-dropdown-menu';
        menu.id = `gs-options-${select.id}`;
        menu.setAttribute('role', 'listbox');
        menu.hidden = true;

        control.setAttribute('aria-controls', menu.id);

        const error = document.createElement('small');
        error.className = 'gs-service-error';
        error.textContent = 'Please select an option.';
        error.hidden = true;

        wrapper.append(control, menu, error);
        error.style.display = 'none';

        // Keep original select for form submission
        select.tabIndex = -1;

        function close() {
            menu.hidden = true;
            control.setAttribute('aria-expanded', 'false');
        }

        function open() {
            if (select.disabled) return;

            menu.hidden = false;
            control.setAttribute('aria-expanded', 'true');
        }

  function validate(showError = false) {
    const valid = !select.required || select.value !== '';

    if (showError) {
        error.hidden = valid;
    } else if (valid) {
        error.hidden = true;
    }

    error.style.display = error.hidden ? 'none' : 'block';

    control.classList.toggle(
        'is-invalid',
        !valid && !error.hidden
    );

    control.setAttribute(
        'aria-invalid',
        String(!valid && !error.hidden)
    );

    return valid;
}
        function sync() {

            const selected = select.selectedOptions[0];

            control.textContent =
                selected?.textContent.trim() || 'Choose an option';

            control.disabled = select.disabled;

            menu.innerHTML = '';

            Array.from(select.options).forEach(option => {

                if (!option.value || option.disabled) return;

                const item = document.createElement('button');
                item.type = 'button';
                item.className = 'gs-dropdown-option';
                item.textContent = option.textContent.trim();
                item.setAttribute('role', 'option');

                const isSelected = option.value === select.value;

                item.setAttribute(
                    'aria-selected',
                    String(isSelected)
                );

                if (isSelected) {
                    item.classList.add('is-selected');
                }

                item.addEventListener('click', () => {

                    select.value = option.value;

                    select.dispatchEvent(
                        new Event('change', { bubbles: true })
                    );

                    close();
                    control.focus();
                });

                menu.appendChild(item);
            });

            validate();
        }

        // Mouse
        control.addEventListener('click', () => {

            if (menu.hidden) {
                open();
            } else {
                close();
            }
        });

        document.addEventListener('click', event => {

            if (!wrapper.contains(event.target)) {
                close();
            }
        });

        // Keyboard
        control.addEventListener('keydown', event => {

            if (event.key === 'Escape') {
                close();
                return;
            }

            if (!['ArrowDown', 'ArrowUp', 'Enter', ' ']
                .includes(event.key)) return;

            event.preventDefault();

            open();

            const options = [
                ...menu.querySelectorAll('.gs-dropdown-option')
            ];

            if (!options.length) return;

            const target = event.key === 'ArrowUp'
                ? options[options.length - 1]
                : options[0];

            target.focus();
        });

        menu.addEventListener('keydown', event => {

            const options = [
                ...menu.querySelectorAll('.gs-dropdown-option')
            ];

            const index = options.indexOf(document.activeElement);

            if (event.key === 'ArrowDown' ||
                event.key === 'ArrowUp') {

                event.preventDefault();

                const next = event.key === 'ArrowDown'
                    ? Math.min(index + 1, options.length - 1)
                    : Math.max(index - 1, 0);

                options[next]?.focus();
            }

            if (event.key === 'Escape' ||
                event.key === 'Tab') {

                close();

                if (event.key === 'Escape') {
                    event.preventDefault();
                    control.focus();
                }
            }
        });

        select.addEventListener('change', sync);

        // Show validation beside the visible control
        select.addEventListener('invalid', event => {

            event.preventDefault();

            validate(true);
            control.focus();
        });

        sync();

        return { sync, validate, control, close };
    }

    // =====================================
    // INITIALIZE DROPDOWNS
    // =====================================

    const serviceDropdown = createCustomDropdown(serviceSelect);
    const memberDropdown = createCustomDropdown(memberSelect);
    const timeDropdown = createCustomDropdown(timeSelect);

    function setOptions(select, placeholder, items = []) {

        select.innerHTML = '';

        select.add(new Option(placeholder, ''));

        items.forEach(item => {
            select.add(new Option(item.label, item.value));
        });

        select.dispatchEvent(new Event('change', {
            bubbles: false
        }));

        refreshDropdown(select);
    }

    function refreshDropdown(select) {

        if (select === serviceSelect) {
            serviceDropdown?.sync();
        }

        if (select === memberSelect) {
            memberDropdown?.sync();
        }

        if (select === timeSelect) {
            timeDropdown?.sync();
        }
    }

    // =====================================
    // SERVICE -> BEAUTY EXPERT
    // =====================================

    serviceSelect.addEventListener('change', async function () {

        const serviceId = this.value;
        const requestId = ++expertsRequest;

        ++timesRequest;

        setOptions(
            timeSelect,
            'Choose expert and date first'
        );

        if (selectedTeamMember) {

            if (!serviceId) {
                setOptions(memberSelect, 'Choose a beauty expert');
                return;
            }

            setOptions(memberSelect, 'Choose a beauty expert', [
                {
                    value: selectedTeamMember,
                    label: selectedMemberName
                }
            ]);

            memberSelect.value = String(selectedTeamMember);
            memberDropdown?.sync();

            loadAvailableTimes();
            return;
        }

        if (!serviceId) {

            setOptions(memberSelect, 'Choose a beauty expert');
            return;
        }

        memberSelect.disabled = true;
        setOptions(memberSelect, 'Loading experts...');

        try {

            const response = await fetch(
                `/services/${encodeURIComponent(serviceId)}/team-members`
            );

            if (!response.ok) {
                throw new Error('Unable to load experts');
            }

            const members = await response.json();

            if (requestId !== expertsRequest) return;

            const items = members.map(member => ({
                value: member.id,
                label: member.name
            }));

            setOptions(
                memberSelect,
                items.length
                    ? 'Choose a beauty expert'
                    : 'No experts available',
                items
            );

            memberSelect.disabled = items.length === 0;
            memberDropdown?.sync();

        } catch (error) {

            if (requestId !== expertsRequest) return;

            console.error(error);

            setOptions(memberSelect, 'Unable to load experts');
            memberSelect.disabled = true;
            memberDropdown?.sync();
        }
    });

    // =====================================
    // EXPERT + DATE -> AVAILABLE TIMES
    // =====================================

    async function loadAvailableTimes() {

        const memberId = memberSelect.value;
        const date = dateInput.value;

        const requestId = ++timesRequest;

        if (!memberId || !date) {

            setOptions(
                timeSelect,
                'Choose expert and date first'
            );

            return;
        }

        timeSelect.disabled = true;
        setOptions(timeSelect, 'Loading times...');

        try {

            const params = new URLSearchParams({
                team_member_id: memberId,
                date: date
            });

            const response = await fetch(
                `/available-times?${params.toString()}`
            );

            if (!response.ok) {
                throw new Error('Unable to load times');
            }

            const times = await response.json();

            if (requestId !== timesRequest) return;

            const items = times.map(time => ({
                value: time.value,
                label: time.label
            }));

            setOptions(
                timeSelect,
                items.length
                    ? 'Choose a time'
                    : 'No available times',
                items
            );

            timeSelect.disabled = items.length === 0;
            timeDropdown?.sync();

        } catch (error) {

            if (requestId !== timesRequest) return;

            console.error(error);

            setOptions(timeSelect, 'Unable to load times');
            timeSelect.disabled = true;
            timeDropdown?.sync();
        }
    }

    memberSelect.addEventListener(
        'change',
        loadAvailableTimes
    );

    dateInput.addEventListener(
        'change',
        loadAvailableTimes
    );

    // =====================================
    // OPENED FROM TEAM MEMBER CARD
    // =====================================

    if (selectedTeamMember) {

        memberSelect.innerHTML = '';

        memberSelect.add(
            new Option(
                selectedMemberName,
                selectedTeamMember,
                true,
                true
            )
        );

        memberDropdown?.sync();

        fetch(
            `/team-members/${encodeURIComponent(selectedTeamMember)}/services`
        )
            .then(response => {

                if (!response.ok) {
                    throw new Error('Unable to load services');
                }

                return response.json();
            })
            .then(services => {

                setOptions(
                    serviceSelect,
                    'Choose a service',
                    services.map(service => ({
                        value: service.id,
                        label: service.name
                    }))
                );
            })
            .catch(error => {
                console.error(error);
            });

    }

    // =====================================
    // OPENED FROM SERVICE CARD
    // =====================================

    else if (selectedService) {

        serviceSelect.value = String(selectedService);

        serviceSelect.dispatchEvent(
            new Event('change', { bubbles: true })
        );
    }

    // =====================================
    // FORM VALIDATION
    // =====================================

    bookingForm.addEventListener('submit', function (event) {

        const dropdowns = [
            serviceDropdown,
            memberDropdown,
            timeDropdown
        ];

        const selects = [
            serviceSelect,
            memberSelect,
            timeSelect
        ];

        const firstInvalidIndex = selects.findIndex(
            select => !select.checkValidity()
        );

        if (firstInvalidIndex !== -1) {

            event.preventDefault();

            dropdowns[firstInvalidIndex]?.validate(true);
            dropdowns[firstInvalidIndex]?.control.focus();
        }
    });

});

        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Booking Confirmed!',
        text: @json(session('success')),
        confirmButtonText: 'Done',
        confirmButtonColor: '#660033'
    });
</script>
@endif
   
</x-layout>
