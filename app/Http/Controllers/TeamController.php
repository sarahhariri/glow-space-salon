<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function team()
    {
        $team = TeamMember::latest()->get();
        $services = Service::where('is_active', true)->get();
        return view('admin.team', compact('team', 'services'));
    }


    public function saveTeam(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'services' => ['required', 'array'],
            'services.*' => ['exists:services,id'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:2048',
            ],
        ]);
        $services = $fields['services'];
        unset($fields['services']);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('assets/images/team'),
                $imageName
            );

            $fields['image'] = $imageName;
        }

        $fields['is_active'] = $request->boolean('is_active');

       $teamMember = TeamMember::create($fields);
        $teamMember->services()->sync($services);

        return redirect()
            ->route('admin.team')
            ->with('success', 'Team member added successfully.');
    }


    public function editTeam(TeamMember $team)
    {
        $services = Service::where('is_active', true)->get();
        return view('admin.editTeam', compact('team', 'services'));
    }

    public function updateTeam(Request $request, TeamMember $team)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'services' => ['required', 'array'],
            'services.*' => ['exists:services,id'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:2048',
            ],
        ]);
          $services = $fields['services'];
        unset($fields['services']);
        
        if ($request->hasFile('image')) {

            // Delete the old image
            $oldImagePath = public_path(
                'assets/images/team/' . $team->image
            );

            if ($team->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Save the new image
            $imageName = time() . '_' .
                $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('assets/images/team'),
                $imageName
            );

            $fields['image'] = $imageName;
        }

        $fields['is_active'] = $request->boolean('is_active');

        $team->update($fields);
        $team->services()->sync($services);

        return redirect()
            ->route('admin.team')
            ->with('success', 'Team member updated successfully.');
    }

    public function deleteTeam(TeamMember $team)
    {
        if ($team->image && file_exists(public_path('assets/images/team/' . $team->image))) {
            unlink(public_path('assets/images/team/' . $team->image));
        }

        $team->delete();

        return redirect()
            ->route('admin.team')
            ->with('success', 'Team member deleted successfully.');
    }

    public function schedule(TeamMember $member)
    {
        $schedules = $member->schedules->keyBy('day_of_week');
        return view('admin.team.schedule', compact('member', 'schedules'));
    }
        public function updateSchedule(Request $request, TeamMember $member)
{
    $schedule = $request->input('schedule', []);

    foreach ($schedule as $day => $data) {
        $isWorking = isset($data['is_working']);

        $member->schedules()->updateOrCreate(
            [
                'day_of_week' => $day,
            ],
            [
                'is_working' => $isWorking,
                'start_time' => $isWorking ? $data['start_time'] : null,
                'end_time' => $isWorking ? $data['end_time'] : null,
            ]
        );
    }

    return redirect()
        ->route('admin.team.schedule', $member)
        ->with('success', 'Schedule updated successfully.');
}
}
