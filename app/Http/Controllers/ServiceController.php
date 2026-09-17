<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function services()
    {
        $services = Service::oldest()->get();

        return view('admin.services', compact('services'));
    }

public function editServices(Service $service)
{
    return view('admin.editServices', compact('service'));
}

public function updateServices(Request $request, Service $service)
{
    $fields = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'category' => ['required', 'string', 'max:100'],
        'description' => ['nullable', 'string', 'max:1000'],
        'price' => ['required', 'numeric', 'min:0'],
        'duration' => ['required', 'integer', 'min:1'],
        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,avif',
            'max:2048',
        ],
    ]);

    if ($request->hasFile('image')) {

        // Delete the old image
        $oldImagePath = public_path(
            'assets/images/services/' . $service->image
        );

        if ($service->image && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Save the new image
        $imageName = time() . '_' .
            $request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            public_path('assets/images/services'),
            $imageName
        );

        $fields['image'] = $imageName;
    }

    $fields['is_active'] = $request->boolean('is_active');

    $service->update($fields);

    return redirect()
        ->route('admin.services')
        ->with('success', 'Service updated successfully.');
}
    public function saveServices(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('assets/images/services'),
                $imageName
            );

            $fields['image'] = $imageName;
        }

        $fields['is_active'] = $request->boolean('is_active');

        Service::create($fields);

        return redirect()
            ->route('admin.services')
            ->with('success', 'Service added successfully.');
    }
    public function deleteServices(Service $service)
{
    if ($service->image && file_exists(public_path('assets/images/services/' . $service->image))) {
        unlink(public_path('assets/images/services/' . $service->image));
    }

    $service->delete();

    return redirect()
        ->route('admin.services')
        ->with('success', 'Service deleted successfully.');
}
}
