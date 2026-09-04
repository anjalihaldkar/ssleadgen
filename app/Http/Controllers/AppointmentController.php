<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->integer('year', now()->year);
        $month = $request->integer('month', now()->month);

        // All appointments for the requested month
        $appointments = Appointment::whereYear('appointment_date', $year)
            ->whereMonth('appointment_date', $month)
            ->orderBy('appointment_time')
            ->get();

        // Group by day number
        $appointmentsByDay = $appointments->groupBy(fn ($a) => $a->appointment_date->day);

        // Today's appointments for sidebar
        $todayAppointments = Appointment::whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        return view('pages.utilities.calendar', compact('appointmentsByDay', 'todayAppointments', 'year', 'month'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        Appointment::create([
            'title' => $request->title,
            'client_name' => $request->client_name,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'location' => $request->location ?? 'Zoom Video Call',
            'notes' => $request->notes,
            'status' => 'Scheduled',
            'color' => $request->color ?? 'event-blue',
        ]);

        // Redirect back to the month of the new appointment
        $date = Carbon::parse($request->appointment_date);

        return redirect()->route('calendar.index', ['year' => $date->year, 'month' => $date->month])
            ->with('success', 'Appointment scheduled successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return back()->with('success', 'Appointment deleted.');
    }
}
