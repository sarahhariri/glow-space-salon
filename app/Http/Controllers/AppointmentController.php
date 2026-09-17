<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\TeamSechdule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $settings = Setting::firstOrFail();
        $services = Service::class::where('is_active', true)->oldest()->get();
        $team = TeamMember::class::where('is_active', true)->oldest()->get();
        $selectedService = $request->query('service');
        $selectedTeamMember = $request->query('team_member');
        $selectedMember = $selectedTeamMember ? TeamMember::find($selectedTeamMember) : null;
        return view('appointments.create', compact('services', 'team', 'settings', 'selectedService', 'selectedTeamMember', 'selectedMember'));
    }
    public function servicesByTeamMember(TeamMember $member)
{
    return response()->json(
        $member->services()
            ->where('is_active', true)
            ->get(['services.id', 'services.name'])
    );
}

    public function availableTime(Request $request)
    {
        $request->validate([
            'team_member_id' => ['required', 'exists:team_members,id'],
            'date' => ['required', 'date'],
        ]);

        $date = Carbon::parse($request->date);

        $day = strtolower($date->format('l'));

        $schedule = TeamSechdule::where('team_member_id', $request->team_member_id)
            ->where('day_of_week', $day)
            ->first();

        if (!$schedule || !$schedule->is_working) {
            return response()->json([]);
        }

        $start = Carbon::parse($schedule->start_time);
        $end = Carbon::parse($schedule->end_time);

        $bookedTimes = Appointment::where('team_member_id', $request->team_member_id)
            ->whereDate('appointment_date', $request->date)
            ->whereNotIn('status', ['cancelled'])
            ->pluck('appointment_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        $availableTimes = [];

        while ($start < $end) {

            $time = $start->format('H:i');

            if (!in_array($time, $bookedTimes)) {
                $availableTimes[] = [
                    'value' => $time,
                    'label' => $start->format('h:i A'),
                ];
            }

            $start->addHour();
        }

        return response()->json($availableTimes);
    }

    public function teamMembersByService(Service $service)
    {
        $members = $service->teamMembers()
            ->where('is_active', true)
            ->get([
                'team_members.id',
                'team_members.name'
            ]);

        return response()->json($members);
    }


    public function store(Request $request)
    {
        $fields = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'team_member_id' => ['required', 'exists:team_members,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required', 'date_format:H:i'],


            'customer_name' => ['required', 'string', 'max:100'],
            'customer_email' => ['required', 'email', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        // Check that this expert actually provides this service
        $member = TeamMember::findOrFail($fields['team_member_id']);

        if (!$member->services()
            ->where('services.id', $fields['service_id'])
            ->exists()) {

            return back()
                ->withInput()
                ->withErrors([
                    'team_member_id' => 'This expert does not provide the selected service.'
                ]);
        }

        // Check expert's working schedule
        $day = strtolower(
            Carbon::parse($fields['appointment_date'])->format('l')
        );

        $schedule = TeamSechdule::where(
            'team_member_id',
            $fields['team_member_id']
        )
            ->where('day_of_week', $day)
            ->where('is_working', true)
            ->first();

        if (!$schedule) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_date' => 'This expert is not working on this day.'
                ]);
        }

        // Check selected time is inside working hours
        $selectedTime = Carbon::createFromFormat(
            'H:i',
            $fields['appointment_time']
        );

        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);

        if ($selectedTime->lt($startTime) || $selectedTime->gte($endTime)) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_time' => 'This time is outside the expert working hours.'
                ]);
        }

        // Prevent double booking
        $alreadyBooked = Appointment::where(
            'team_member_id',
            $fields['team_member_id']
        )
            ->whereDate(
                'appointment_date',
                $fields['appointment_date']
            )
            ->whereTime(
                'appointment_time',
                $fields['appointment_time']
            )
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($alreadyBooked) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_time' =>
                    'This appointment time has already been booked. Please choose another time.'
                ]);
        }

        $fields['status'] = 'pending';
        $fields['user_id'] = Auth::check() ? Auth::id() : null;
        Appointment::create($fields);

        return redirect()
            ->route('appointments.create')
            ->with('success', 'Your appointment has been booked successfully.');
    }

 public function appointments()
    {
        $appointments = Appointment::with(['service', 'teamMember', 'user'])
            ->latest()
            ->get();

        return view('admin.adminAppointments', compact('appointments'));
    }   

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
        ]);

        $appointment->update(['status' => $request->status]);

        return redirect()
            ->route('admin.appointments')
            ->with('success', 'Appointment status updated successfully.');
    }
}
