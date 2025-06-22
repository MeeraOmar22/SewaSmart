<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SewaSmart</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Icons and Fonts -->
        <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

        <!-- Your Main CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

  <body>    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      @include('layouts.nav-guest')
      <div style="height:100px"></div>  
      <div class="p-3 align-items-center" style="background-color: #f5f4f4;">
        <div class="mx-3 mt-1">
            <a href="{{ url()->previous() }}" class="d-inline-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mx-3" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            <strong>Back to Book A Car</strong>
        </a></div>
        <div class="row mx-3 mt-1">
            <div class="col-6 bg-white shadow-sm m-3 border" style="border-radius: 12px; height:75vh; ">
                <div class="pt-3">
                    <img src="{{ $car->pic ?? asset('images/car_placeholder.png') }}" 
                        class="img-fluid rounded-start w-100 p-3" 
                        alt="{{ $car->model }}" 
                        style="object-fit: cover;">
                </div>
                <div class="row px-3 pt-2">
                    <div class="col-6"><p class="mb-2">
                    {{ \Carbon\Carbon::parse($start)->format('d M Y') }} - 
                    {{ \Carbon\Carbon::parse($end)->format('d M Y') }}
                    </p>
                    <h3 class="mb-2">{{ $car->brand }} {{ $car->model }}</h3>
                    <p class="mb-2">Transmission Type: {{ $car->transmission_type }}</p>
                    <p>Fuel Type: {{ $car->fuel_type }}</p>
                    </div>
                    <div class="col text-right">
                        <h3><strong>RM {{ number_format($price, 2) }}</strong></h3>
                    </div>
                </div>
            </div>
            <div class="col-5 m-3 bg-dark text-white p-4 rounded">
                <h3 class="text-center text-white p-3"><b>PAYMENT:</b></h3>

                <!-- Payment Method (Radio Buttons Side-by-Side) -->
                <div class="mb-3">
                    <label class="form-label d-block mb-2">Select Payment Method:</label>
                    <div class="form-check form-check-inline mr-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="creditCard" value="credit_card" required>
                        <label class="form-check-label" for="creditCard"><img src="{{ asset('images/master_card.png')  }}" style="width:50px"></label>
                    </div>
                    <div class="form-check form-check-inline ml-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="debitCard" value="debit_card">
                        <label class="form-check-label" for="debitCard"><img src="{{ asset('images/visa_card.png')  }}" style="width:50px"></label>
                    </div>
                </div>

                <!-- Card Number -->
                <div class="mb-3">
                    <label for="cardno" class="form-label">Enter Card No:</label>
                    <input type="text" name="cardno" id="cardno" class="form-control" required>
                </div>

                <!-- Expiry & CSC -->
                <div class="mb-3 d-flex gap-2">
                    <div class="flex-fill mr-2">
                        <label for="expiry" class="form-label">Expiry Date:</label>
                        <input type="date" name="expiry" id="expiry" class="form-control" placeholder="MM/YY" required>
                    </div>
                    <div class="flex-fill ml-2">
                        <label for="csc" class="form-label">CSC:</label>
                        <input type="text" name="csc" id="csc" class="form-control" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <form action="{{ route('booking.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <input type="hidden" name="start_date" value="{{ $start }}">
                    <input type="hidden" name="end_date" value="{{ $end }}">
                    <input type="hidden" name="price" value="{{ $price }}">
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100 mt-5 px-4">PAY</button>
                    </div>
                </form>
            </div>

        </div>
      </div>
      </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
      