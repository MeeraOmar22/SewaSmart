<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        Booking::where('user_id', $user->id)
            ->where('status', 'booked')
            ->whereDate('end_date', '<', now())
            ->update(['status' => 'not collected']);

        Booking::where('user_id', $user->id)
            ->where('status', 'in use')
            ->whereDate('end_date', '<', now())
            ->update(['status' => 'not returned']);

        Booking::where('user_id', $user->id)
            ->where('status', 'not returned')
            ->update([
                'penalty' => DB::raw("CASE
                    WHEN end_date < CURDATE()
                    THEN DATEDIFF(CURDATE(), end_date) * 1.5
                    ELSE 0
                END")
            ]);



        $currentBookings = Booking::with('car') 
            ->where('user_id', $user->id)
            ->where('status', 'in use')
            ->orWhere('status', 'not returned')
            ->orWhere('status', 'not collected')
            ->get();

         $upcomingQuery = Booking::with('car')
            ->where('user_id', $user->id)
            ->where('status', 'booked');

                if ($request->upcoming_start_date && $request->upcoming_end_date) {
                    $upcomingQuery ->whereBetween('start_date', [$request->upcoming_start_date, $request->upcoming_end_date]);
                }


        $upcomingBookings = $upcomingQuery 
            ->orderBy('start_date', 'asc')
            ->paginate(5);

        $pastQuery = Booking::with('car')
            ->where('user_id', $user->id)
            ->whereIn('status', ['returned', 'cancelled']);

            if ($request->past_start_date && $request->past_end_date) {
                    $pastQuery ->whereBetween('start_date', [$request->past_start_date, $request->past_end_date]);
                }

        $pastBookings = $pastQuery
            ->orderByRaw("CASE WHEN feedback IS NULL OR feedback = '' THEN 0 ELSE 1 END")
            ->orderByDesc('end_date')
            ->paginate(5);

        return view('dashboard', compact('currentBookings', 'upcomingBookings', 'pastBookings'));
    }

    public function returnCar(Request $request, $id)
    {
        $request->validate([
            'verification_code' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);

        if ((int) $request->verification_code !== (int) $booking->verification_code) {
            return back()
                ->withErrors(["verification_code_$id" => 'Incorrect verification code.'])
                ->withInput()
                ->with('open_modal', $id);
        }

        $booking->status = 'returned';
        $booking->save();

        return redirect()->back()->with('success', 'Car returned successfully!');
    }

    public function cancelBooking(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->status = 'canceled';
        $booking->save();

        return redirect()->back()->with('success', 'Book cancellation successfully!');
    }

        public function updateBooking(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    // Check for overlapping bookings (same car, different booking ID)
    $conflict = Booking::where('car_id', $booking->car_id)
        ->where('id', '!=', $booking->id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                  });
        })
        ->whereIn('status', ['booked', 'in use']) // only block active bookings
        ->get();

    if ($conflict->isNotEmpty()) {
        $dates = [];
        foreach ($conflict as $con) {
            $range = Carbon::parse($con->start_date)->toFormattedDateString() . ' - ' .
                     Carbon::parse($con->end_date)->toFormattedDateString();
            $dates[] = $range;
        }
        return redirect()->back()
            ->withErrors(['date_conflict' =>'The selected dates overlap with these existing bookings:<ul><li>' .
                    implode('</li><li>', $dates) . '</li></ul>',])
            ->withInput()
            ->with('open_edit_modal', $id); // to reopen the modal
    }
    // No conflict → update booking
    $booking->start_date = $request->start_date;
    $booking->end_date = $request->end_date;
    $booking->save();

    return redirect()->back()->with('success', 'Booking updated successfully!');
}

public function submitFeedback(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    if ($request->has('delete_feedback')) {
        $booking->feedback = null;
        $booking->rating = null;
        $booking->save();

        return back()->with('success', 'Feedback deleted successfully.');
    }

    $request->validate([
        'feedback' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $booking->feedback = $request->feedback;
    $booking->rating = $request->rating;
    $booking->save();

    return back()->with('success', 'Feedback updated.');
}


}

