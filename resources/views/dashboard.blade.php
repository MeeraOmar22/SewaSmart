
<x-app-layout>

    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container p-3">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Current Bookings</strong></h2>  
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if ($currentBookings->count() === 0)
                    <p class="text-center bg-white p-5">NO CURRENT BOOKINGS FOUND.</p>
                @else
                    {{-- Loop current bookings --}}
                    @foreach ($currentBookings as $booking)
                            @php
                                $isEndDate = \Carbon\Carbon::parse($booking->end_date)->isToday();
                            @endphp
                    <div>
                        <div class="row g-0 ard mb-3 bg-white shadow-sm" style="border-radius: 12px;">
                            <!-- Car Image -->
                            <div class="col-md-3">
                                <img src="{{ $booking->car->pic ?? asset('images/car_placeholder.png') }}" 
                                    class="img-fluid rounded-start h-100 p-2" 
                                    alt="{{ $booking->car->model }}" 
                                    style="object-fit: cover;">
                            </div>

                            <!-- Main Info -->
                            <div class="col-md-6">
                                <div class="card-body m-1">
                                    <!-- Status + Date Range -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge {{ $booking->status === 'in use' ? 'bg-success' : 'bg-danger' }} text-uppercase text-white">
                                            {{ $booking->status }}
                                        </span>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <!-- Car Info -->
                                    <h5 class="card-title"><b>{{ $booking->car_plate }} {{ $booking->car->brand }} {{ $booking->car->model }}</b></h5>
                                    <p class="card-text mb-1">Transmission: {{ $booking->car->transmission_type }}</p>
                                    <p class="card-text">Fuel: {{ $booking->car->fuel_type }}</p>
                                    <h5 class="text-end ">Paid: RM&nbsp;{{ number_format($booking->price, 2) }}</h5>

                                    <!-- Person in Charge -->
                                    <div class="bg-light p-2 rounded">
                                        <strong>Person In Charge:</strong><br>

                                        <!-- Person Name Row -->
                                        <div class="d-flex align-items-center mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-person-fill me-2" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->pic_name }}</span>
                                        </div>

                                        <!-- Contact Number Row -->
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->contact_no }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price & Return Button -->
                            <div class="col-md-3 d-flex flex-column justify-content-between align-items-end p-3">
                                <div>
                                    @php
                                        $endDate = \Carbon\Carbon::parse($booking->end_date)->startOfDay();
                                        $today = now()->startOfDay();
                                        $daysLeft = $today->diffInDays($endDate, false);
                                    @endphp
                                    <span class="badge bg-info text-white">
                                        {{ $daysLeft >= 0 ? abs($daysLeft)  . ' more days left to return' : 'Overdue by ' . abs($daysLeft)  . ' days' }}
                                    </span>
                                </div>
                                @if ($booking->status=='not returned')
                                <p class="badge bg-danger text-white text-end">Penalty: RM&nbsp;{{ number_format($booking->penalty,2) }}</p>
                                @endif
                                <div class="mt-auto">
                                    @if ($isEndDate || $booking->status=='not returned')
                                            <!-- Button triggers modal -->
                                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $booking->id }}">
                                               RETURN 
                                            </button>
                                    @elseif($booking->status == 'not collected')
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Cancel this booking?')">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mt-2">CANCEL</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal -->
                    <div class="modal fade" id="verifyModal{{ $booking->id }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('booking.return', $booking->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalLabel{{ $booking->id }}"><b>Verification Required</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                            <label for="verification_{{ $booking->id }}" class="form-label">Enter verification code or keyword:</label>
                            <input type="text" 
                            name="verification_code" 
                            id="verification_{{ $booking->id }}" 
                            class="form-control @error('verification_code_' . $booking->id) is-invalid @enderror" 
                            required>
                            @error('verification_code_' . $booking->id)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary p-2">Confirm Return</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Upcoming Bookings</strong></h2>  
            <form method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="date" name="upcoming_start_date" class="form-control" value="{{ request('upcoming_start_date') }}">
                </div>
                <div class="col">
                    <input type="date" name="upcoming_end_date" class="form-control" value="{{ request('upcoming_end_date') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
          </div>
        </div>
        

        <div class="row">
            <div class="col-lg-12">
                @if ($upcomingBookings->count() === 0)
                    <p class="text-center bg-white p-5">NO UPCOMING BOOKING FOUND.</p>
                @else
                    {{-- Loop current bookings --}}
                    @foreach ($upcomingBookings as $booking)
                            @php
                                $isStartDate = \Carbon\Carbon::parse($booking->start_date)->isToday();
                            @endphp
                    <div>
                        <div class="row g-0 ard mb-3 bg-white shadow-sm" style="border-radius: 12px;">
                            <!-- Car Image -->
                            <div class="col-md-3">
                                <img src="{{ $booking->car->pic ?? asset('images/car_placeholder.png') }}" 
                                    class="img-fluid rounded-start h-100 p-2" 
                                    alt="{{ $booking->car->model }}" 
                                    style="object-fit: cover;">
                            </div>

                            <!-- Main Info -->
                            <div class="col-md-6">
                                <div class="card-body m-1">
                                    <!-- Status + Date Range -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-warning text-uppercase text-white">
                                            {{ $booking->status }}
                                        </span>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <!-- Car Info -->
                                    <h5 class="card-title"><b>{{ $booking->car_plate }} {{ $booking->car->brand }} {{ $booking->car->model }}</b></h5>
                                    <p class="card-text mb-1">Transmission: {{ $booking->car->transmission_type }}</p>
                                    <p class="card-text">Fuel: {{ $booking->car->fuel_type }}</p>
                                    <h5 class="text-end ">Paid: RM&nbsp;{{ number_format($booking->price, 2) }}</h5>

                                    <!-- Person in Charge -->
                                    <div class="bg-light p-2 rounded">
                                        <strong>Person In Charge:</strong><br>

                                        <!-- Person Name Row -->
                                        <div class="d-flex align-items-center mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-person-fill me-2" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->pic_name }}</span>
                                        </div>

                                        <!-- Contact Number Row -->
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->contact_no }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price & Return Button -->
                            <div class="col-md-3 d-flex flex-column justify-content-between align-items-end p-3">
                                <div>
                                    @php
                                        $startDate = \Carbon\Carbon::parse($booking->start_date)->startOfDay();
                                        $today = now()->startOfDay();
                                        $daysLeft = $today->diffInDays($startDate, false);
                                    @endphp
                                    <span class="badge bg-info text-white">
                                        {{ $daysLeft >= 0 ? abs($daysLeft)  . ' more days left to collect' : 'Overdue by ' . abs($daysLeft)  . ' days' }}
                                    </span>
                                </div>
                                <div class="d-flex gap-3 align-items-center">
                                    <!-- Edit Icon (opens modal) -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $booking->id }}">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill text-black" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                        </svg>
                                    </a>

                                    <!-- Delete Icon (form submit) -->
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        <button type="submit" style="border: none; background: none; padding: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="mt-auto">
                                    @if ($isStartDate)
                                            <!-- Button triggers modal -->
                                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#verifyModal{{ $booking->id }}">
                                               COLLECT
                                            </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Modal -->
                    <div class="modal fade" id="verifyModal{{ $booking->id }}" tabindex="-1" aria-labelledby="verifyModalLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('booking.return', $booking->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="verifyModalLabel{{ $booking->id }}"><b>Verification Required</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                            <label for="verification_{{ $booking->id }}" class="form-label">Enter verification code or keyword:</label>
                            <input type="text" 
                            name="verification_code" 
                            id="verification_{{ $booking->id }}" 
                            class="form-control @error('verification_code_' . $booking->id) is-invalid @enderror" 
                            required>
                            @error('verification_code_' . $booking->id)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary p-2">Confirm Return</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                  
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $booking->id }}" tabindex="-1" aria-labelledby="editLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('booking.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabel{{ $booking->id }}">Edit Booking</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your editable fields here -->
                                    <div class="mb-3">
                                        <label for="start_date_{{ $booking->id }}">Start Date</label>
                                        <input type="date" id="start_date_{{ $booking->id }}" name="start_date" class="form-control @error('date_conflict') is-invalid @enderror" value="{{ $booking->start_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date_{{ $booking->id }}">End Date</label>
                                        <input type="date" id="end_date_{{ $booking->id }}" name="end_date" class="form-control @error('date_conflict') is-invalid @enderror" value="{{ $booking->end_date }}">
                                        @error('date_conflict')
                                            <div class="invalid-feedback">
                                                  {!! $message !!}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary p-2">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-3">
                        {{ $upcomingBookings->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Past Bookings</strong></h2>  
            <form method="GET" class="mb-3">
            <div class="row">
                <div class="col">
                    <input type="date" name="past_start_date" class="form-control" value="{{ request('past_start_date') }}">
                </div>
                <div class="col">
                    <input type="date" name="past_end_date" class="form-control" value="{{ request('past_end_date') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if ($pastBookings->count() === 0)
                    <p class="text-center bg-white p-5">NO PAST BOOKING FOUND.</p>
                @else
                    {{-- Loop current bookings --}}
                    @foreach ($pastBookings as $booking)
                            @php
                                $isStartDate = \Carbon\Carbon::parse($booking->start_date)->isToday();
                            @endphp
                    <div>
                        <div class="row g-0 ard mb-3 bg-white shadow-sm" style="border-radius: 12px;">
                            <!-- Car Image -->
                            <div class="col-md-3">
                                <img src="{{ $booking->car->pic ?? asset('images/car_placeholder.png') }}" 
                                    class="img-fluid rounded-start h-100 p-2" 
                                    alt="{{ $booking->car->model }}" 
                                    style="object-fit: cover;">
                            </div>

                            <!-- Main Info -->
                            <div class="col-md-6">
                                <div class="card-body m-1">
                                    <!-- Status + Date Range -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-warning text-uppercase text-white">
                                            {{ $booking->status }}
                                        </span>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                        </small>
                                    </div>

                                    <!-- Car Info -->
                                    <h5 class="card-title"><b>{{ $booking->car_plate }} {{ $booking->car->brand }} {{ $booking->car->model }}</b></h5>
                                    <p class="card-text mb-1">Transmission: {{ $booking->car->transmission_type }}</p>
                                    <p class="card-text">Fuel: {{ $booking->car->fuel_type }}</p>
                                    <h5 class="text-end ">Paid: RM&nbsp;{{ number_format($booking->price, 2) }}</h5>

                                    <!-- Person in Charge -->
                                    <div class="bg-light p-2 rounded">
                                        <strong>Person In Charge:</strong><br>

                                        <!-- Person Name Row -->
                                        <div class="d-flex align-items-center mb-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-person-fill me-2" viewBox="0 0 16 16">
                                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->pic_name }}</span>
                                        </div>

                                        <!-- Contact Number Row -->
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                                class="bi bi-telephone-fill me-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                            </svg>
                                            <span>&nbsp{{ $booking->contact_no }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($booking->status=="returned")
                            <!-- Price & Return Button -->
                            <div class="col-md-3 d-flex flex-column justify-content-between align-items-end p-3">
                                <div>
                                    <span class="badge bg-info text-white">
                                        {{ !isset($booking->rating)? 'Feedback Required' : 'Feedback Done' }}
                                    </span>
                                </div>

                                <!-- Feedback Section -->
                                <div class="feedback-section align-items-end w-100 h-100 py-2">
                                    @php
                                        $hasFeedback = $booking->feedback || $booking->rating;
                                    @endphp

                                    <form method="POST" action="{{ route('booking.feedback', $booking->id) }}" id="feedbackForm{{ $booking->id }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="ratingSelect{{ $booking->id }}" class="form-label">Rating:</label><br>
                                            <select name="rating" id="ratingSelect{{ $booking->id }}" class="form-select" {{ $hasFeedback ? 'disabled' : '' }} required>
                                                <option value="">-- Select Rating --</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $booking->rating == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="justify-content-between align-items-start w-100">
                                              <div class="mb-1">
                                                <label for="feedbackText{{ $booking->id }}" class="form-label">Feedback:</label>
                                                <textarea name="feedback" class="form-control " id="feedbackText{{ $booking->id }}" rows="3" {{ $hasFeedback ? 'readonly' : '' }} required>{{ $hasFeedback ? $booking->feedback : '' }}</textarea>
                                            </div>
                                            <br>
                                            <!-- Edit/Delete or Save -->
                                            <div >
                                                @if ($hasFeedback)
                                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="enableFeedbackEdit({{ $booking->id }})" id="editBtn{{ $booking->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill text-black" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                        </svg>
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-success d-none" id="saveBtn{{ $booking->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary d-none p-1 px-2" id="cancelBtn{{ $booking->id }}" onclick="cancelFeedbackEdit({{ $booking->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                                        </svg>
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_feedback" value="1" onclick="return confirm('Delete feedback?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                        </svg>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-success" onclick="return validateFeedback({{ $booking->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                            <script>
                                                function validateFeedback(id) {
                                                    const text = document.getElementById('feedbackText' + id).value.trim();
                                                    const rating = document.getElementById('ratingSelect' + id).value;

                                                    if (!text || !rating) {
                                                        alert('Please fill in both rating and feedback before submitting.');
                                                        return false;
                                                    }
                                                    return true;
                                                }

                                                function enableFeedbackEdit(id) {
                                                    document.getElementById('feedbackText' + id).removeAttribute('readonly');
                                                    document.getElementById('ratingSelect' + id).removeAttribute('disabled');
                                                    document.getElementById('editBtn' + id).classList.add('d-none');
                                                    document.getElementById('saveBtn' + id).classList.remove('d-none');
                                                    document.getElementById('cancelBtn' + id).classList.remove('d-none');
                                                }

                                                function cancelFeedbackEdit(id) {
                                                    // Reset textarea and dropdown to original values
                                                    const originalText = @json($booking->feedback);
                                                    const originalRating = @json($booking->rating);
                                                    
                                                    document.getElementById('feedbackText' + id).value = originalText;
                                                    document.getElementById('ratingSelect' + id).value = originalRating;

                                                    document.getElementById('feedbackText' + id).setAttribute('readonly', true);
                                                    document.getElementById('ratingSelect' + id).setAttribute('disabled', true);

                                                    document.getElementById('editBtn' + id).classList.remove('d-none');
                                                    document.getElementById('saveBtn' + id).classList.add('d-none');
                                                    document.getElementById('cancelBtn' + id).classList.add('d-none');
                                                }
                                            </script>  
                                        </div>

                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-3">
                        {{ $pastBookings->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    @if (session('open_modal'))
        <script>
            window.ddEventListener('load', function () {
                var modalId = '#verifyModal{{ session('open_modal') }}';
                var myModal = new bootstrap.Modal(document.querySelector(modalId));
                myModal.show();
            });
        </script>
        @endif

    @if (session('open_edit_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalId = '#editModal{{ session('open_edit_modal') }}';
                var myModal = new bootstrap.Modal(document.querySelector(modalId));
                myModal.show();
            });
        </script>
    @endif
</x-app-layout>
