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
      
      <div class="hero inner-page" style="background-image: url('images/car_1.jpg');">
        
        <div class="container">
          <div class="row align-items-end ">
            <div class="col-lg-5">

              <div class="intro">
                <h1><strong>Rent Form</strong></h1>
                <div class="custom-breadcrumbs"><a href={{ url('/cars') }}>Listing</a> <span class="mx-2">/</span> <strong>Rent Form</strong></div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Booking Form Starts Here-->
        
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Rent {{ $car->brand }} {{ $car->model }}</h4>
          <!-- <small>Pickup between {{ \Carbon\Carbon::parse($car->available_from)->format('M d') }}
            &ndash; {{ \Carbon\Carbon::parse($car->available_until)->format('M d') }}</small> -->
        </div>
        <div class="card-body">

          <form action="{{ route('payment') }}" method="GET">
             @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">

            {{-- 1) Customer Info --}}
            <h5 class="mb-3">1. Customer Details</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="full_name">Full Name</label>
                <input id="full_name" type="text" name="full_name" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="contact_no">Contact Number</label>
                <input id="contact_no" type="text" name="contact_no" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="address">Home Address</label>
                <input id="address" type="text" name="address" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="license_no">Driver’s License No.</label>
                <input id="license_no" type="text" name="license_no" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="license_expiry">License Expiry Date</label>
                <input id="license_expiry" type="date" name="license_expiry" class="form-control" required>
              </div>
            </div>

            <hr>

            {{-- 2) Rental Details --}}
            <h5 class="mb-3">2. Rental Details</h5>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="start_date">Pickup Date &amp; Time</label>
                <input id="start_date" type="datetime-local" name="start_date" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="end_date">Drop-off Date &amp; Time</label>
                <input id="end_date" type="datetime-local" name="end_date" class="form-control" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="pickup_location">Pickup Location</label>
                <input id="pickup_location" type="text" name="pickup_location" class="form-control" 
                  value="{{ $car->pickup_location }}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="additional_drivers">Additional Drivers</label>
                <input id="additional_drivers" type="number" name="additional_drivers" class="form-control" min="0" value="0">
              </div>
            </div>

            <hr>

            {{-- Rental Option --}}
            <div class="form-group mb-3">
            <label>Rental Option</label>
            <div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rental_option" id="opt_full" value="full_day" checked>
                <label class="form-check-label" for="opt_full">Full Day</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rental_option" id="opt_half" value="half_day">
                <label class="form-check-label" for="opt_half">Half Day</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rental_option" id="opt_hourly" value="hourly">
                <label class="form-check-label" for="opt_hourly">Hourly</label>
                </div>
            </div>
            </div>

            {{-- Hours (only if hourly) --}}
            <div class="form-group mb-4" id="hours_group" style="display:none;">
            <label for="hours">Number of Hours</label>
            <input type="number" name="hours" id="hours" class="form-control" min="1" max="23" value="1">
            </div>

            <!-- 3) Extras & Insurance -->
            <h5 class="mb-3">3. Extras &amp; Insurance</h5>
            <div class="form-row">
            <div class="form-group col-md-4">
                <div class="form-check">
                <input id="gps" name="extras[]" value="GPS" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="gps">GPS Navigation (RM 20/day)</label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-check">
                <input id="child_seat" name="extras[]" value="Child Seat" class="form-check-input" type="checkbox">
                <label class="form-check-label" for="child_seat">Child Seat (RM 15/day)</label>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label>Insurance</label>
                <div class="form-check">
                <input id="insurance_full" name="insurance" value="full" class="form-check-input" type="radio" checked>
                <label class="form-check-label" for="insurance_full">Full Insurance (RM 50/day)</label>
                </div>
                <div class="form-check">
                <input id="insurance_none" name="insurance" value="none" class="form-check-input" type="radio">
                <label class="form-check-label" for="insurance_none">No Insurance</label>
                </div>
            </div>
            </div>

            <hr>

            {{-- 4) Payment & Confirmation --}}
            <h5 class="mb-3">4. Payment</h5>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label id="rate_label">Rate (per day)</label>
                <input id="rate_input" type="text" class="form-control"
                    value="RM {{ number_format($car->price,2) }}" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Estimated Total</label>
                <input id="estimated_total" type="text" class="form-control" readonly>
                <input type="hidden" name="price" id="hidden_price">
            </div>
            </div>


            <div class="form-group form-check">
              <input id="terms" type="checkbox" name="terms" class="form-check-input" required>
              <label class="form-check-label" for="terms">
                I agree to the <a href="#">Terms &amp; Conditions</a>
              </label>
            </div>

            <button type="submit" class="btn btn-success btn-block">
              Confirm &amp; Proceed to Payment
            </button>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

{{-- Optional JS to calculate estimated total --}}
<script>
  // 1) rate constants (from backend & your extras)
  const pricePerDay  = {{ $car->price }};
  const halfDayPrice = +(pricePerDay / 2).toFixed(2);
  const hourlyRate   = +(pricePerDay / 24).toFixed(2);

  // extras per day
  const gpsRate    = 20;
  const childRate  = 15;
  const insRate    = 50;

  // grab rate label & input
  const rateLabel = document.getElementById('rate_label');
  const rateInput = document.getElementById('rate_input');

  // show/hide hours if “Hourly” selected
  document.querySelectorAll('input[name="rental_option"]').forEach(el => {
    el.addEventListener('change', () => {
      const isHourly = document.getElementById('opt_hourly').checked;
      document.getElementById('hours_group').style.display = isHourly ? 'block' : 'none';
      calculateTotal();
    });
  });

  function calculateTotal(){
    const start = new Date(document.getElementById('start_date').value);
    const end   = new Date(document.getElementById('end_date').value);
    const opt   = document.querySelector('input[name="rental_option"]:checked').value;

    let baseCost, labelText;

    if(opt === 'full_day'){
      let days = Math.ceil((end - start)/(1000*60*60*24));
      if(days < 1) days = 1;
      baseCost  = pricePerDay * days;
      labelText = `Rate: RM ${pricePerDay.toFixed(2)} / day`;
    }
    else if(opt === 'half_day'){
      baseCost  = halfDayPrice;
      labelText = `Rate: RM ${halfDayPrice.toFixed(2)} / half-day`;
    }
    else { // hourly
      const hrs = parseInt(document.getElementById('hours').value,10) || 1;
      baseCost  = hourlyRate * hrs;
      labelText = `Rate: RM ${hourlyRate.toFixed(2)} / hour`;
    }

    // **update rate display immediately**  
    rateLabel.textContent = labelText;
    rateInput.value       = labelText;

    // now extras & insurance
    let extras = 0;
    if (document.getElementById('gps').checked)        extras += gpsRate;
    if (document.getElementById('child_seat').checked) extras += childRate;
    // only if “full” insurance is chosen:
    if ( document.querySelector('input[name="insurance"]:checked').value === 'full' ) {
    extras += insRate;
    }

    // pro-rate extras
    if(opt==='half_day') extras /= 2;
    if(opt==='hourly')   extras = extras/24 * (parseInt(document.getElementById('hours').value,10)||1);

    // final total
    const total = baseCost + extras;
    document.getElementById('estimated_total').value = `RM ${total.toFixed(2)}`;
    document.getElementById('hidden_price').value = total.toFixed(2);

  }

  // re-wire all change events
['start_date','end_date','gps','child_seat','hours','insurance_full','insurance_none']
  .forEach(id => document.getElementById(id)?.addEventListener('change', calculateTotal));


  // initial calculate on load
  window.addEventListener('DOMContentLoaded', calculateTotal);
</script>
      
      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="footer-heading mb-4">About Us</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
              <ul class="list-unstyled social">
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                <li><a href="#"><span class="icon-instagram"></span></a></li>
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-linkedin"></span></a></li>
              </ul>
            </div>
            <div class="col-lg-8 ml-auto">
              <div class="row">
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Resources</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Support</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <h2 class="footer-heading mb-4">Company</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">
                <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> SewaSmart All rights reserved
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
              </div>
            </div>

          </div>
        </div>
      </footer>

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