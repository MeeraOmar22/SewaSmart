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
      
      <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">
        
        <div class="container">
          <div class="row align-items-end ">
            <div class="col-lg-5">

              <div class="intro">
                <h1><strong>Listings</strong></h1>
                <div class="custom-breadcrumbs"><a href={{ url('/') }}>Home</a> <span class="mx-2">/</span> <strong>Listings</strong></div>
              </div>

            </div>
          </div>
        </div>
      </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Car Listings</strong></h2>
            <p class="mb-5">Browse our wide range of available rental cars. Use the filters below to find a vehicle that suits your needs, budget, and travel plans.</p>    
          </div>
        </div>

        
<form action="{{ route('cars.listings') }}" method="GET" class="mb-5">
  <div class="row">

    {{-- Brand --}}
    <div class="form-group col-md-4">
      <label for="car_brand">Brand</label>
      <select name="car_brand" id="car_brand" class="form-control">
        <option value="">Any Brand</option>
        @foreach($brands as $brand)
          <option value="{{ $brand }}" {{ request('car_brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
        @endforeach
      </select>
    </div>

    {{-- Model --}}
    <div class="form-group col-md-4">
      <label for="model">Model</label>
      <select name="model" id="model" class="form-control">
        <option value="">Any Model</option>
        @foreach($models as $model)
          <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
        @endforeach
      </select>
    </div>

    {{-- Car Type --}}
    <div class="form-group col-md-4">
      <label for="car_type">Type</label>
      <select name="car_type" id="car_type" class="form-control">
        <option value="">Any Type</option>
        @foreach($types as $type)
          <option value="{{ $type }}" {{ request('car_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    {{-- Transmission --}}
    <div class="form-group col-md-4">
      <label for="transmission_type">Transmission</label>
      <select name="transmission_type" id="transmission_type" class="form-control">
        <option value="">Any Transmission</option>
        @foreach($transmissions as $trans)
          <option value="{{ $trans }}" {{ request('transmission_type') == $trans ? 'selected' : '' }}>{{ $trans }}</option>
        @endforeach
      </select>
    </div>

    {{-- Fuel --}}
    <div class="form-group col-md-4">
      <label for="fuel_type">Fuel Type</label>
      <select name="fuel_type" id="fuel_type" class="form-control">
        <option value="">Any Fuel</option>
        @foreach($fuelTypes as $fuel)
          <option value="{{ $fuel }}" {{ request('fuel_type') == $fuel ? 'selected' : '' }}>{{ $fuel }}</option>
        @endforeach
      </select>
    </div>

    {{-- Capacity --}}
    <div class="form-group col-md-4">
      <label for="passenger_capacity">Capacity</label>
      <select name="passenger_capacity" id="passenger_capacity" class="form-control">
        <option value="">Any Capacity</option>
        @foreach($capacities as $capacity)
          <option value="{{ $capacity }}" {{ request('passenger_capacity') == $capacity ? 'selected' : '' }}>{{ $capacity }} Seats</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    {{-- Price Range --}}
    <div class="form-group col-md-4">
      <label for="price_range">Price Range</label>
      <select name="price_range" id="price_range" class="form-control">
        <option value="">Any Price</option>
        <option value="0-99" {{ request('price_range') == '0-99' ? 'selected' : '' }}>Below RM100</option>
        <option value="100-199" {{ request('price_range') == '100-199' ? 'selected' : '' }}>RM100 - RM199</option>
        <option value="200-299" {{ request('price_range') == '200-299' ? 'selected' : '' }}>RM200 - RM299</option>
        <option value="300-399" {{ request('price_range') == '300-399' ? 'selected' : '' }}>RM300 - RM399</option>
        <option value="400-99999" {{ request('price_range') == '400-99999' ? 'selected' : '' }}>RM400 and above</option>
      </select>
    </div>

    {{-- Pickup Date --}}
    <div class="form-group col-md-4">
      <label for="pickup_date">Pickup Date</label>
      <input type="text" name="pickup_date" class="form-control datepicker" placeholder="Pickup Date" value="{{ request('pickup_date') }}">
    </div>

    {{-- Dropoff Date --}}
    <div class="form-group col-md-4">
      <label for="dropoff_date">Dropoff Date</label>
      <input type="text" name="dropoff_date" class="form-control datepicker" placeholder="Dropoff Date" value="{{ request('dropoff_date') }}">
    </div>
  </div>

  <div class="row">
    {{-- Sort Option --}}
    <div class="form-group col-md-4">
      <label for="sort_by">Sort By</label>
      <select name="sort_by" class="form-control">
        <option value="">Sort By</option>
        <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Newest Cars</option>
      </select>
    </div>

    {{-- Submit Button --}}
    <div class="form-group col-md-4 align-self-end">
      <button type="submit" class="btn btn-primary btn-block mt-2">Filter</button>
    </div>
  </div>
</form>

<script>
document.getElementById('car_brand').addEventListener('change', function () {
    const brand = this.value;
    if (!brand) return;

    fetch(`/get-car-options?brand=${brand}`)
        .then(response => response.json())
        .then(data => {
            // Update Model
            const model = document.getElementById('model');
            model.innerHTML = '<option value="">Any Model</option>';
            data.models.forEach(item => {
                model.innerHTML += `<option value="${item}">${item}</option>`;
            });

            // Update Type
            const type = document.getElementById('car_type');
            type.innerHTML = '<option value="">Any Type</option>';
            data.types.forEach(item => {
                type.innerHTML += `<option value="${item}">${item}</option>`;
            });

            // Update Transmission
            const trans = document.getElementById('transmission_type');
            trans.innerHTML = '<option value="">Any Transmission</option>';
            data.transmissions.forEach(item => {
                trans.innerHTML += `<option value="${item}">${item}</option>`;
            });

            // Update Fuel
            const fuel = document.getElementById('fuel_type');
            fuel.innerHTML = '<option value="">Any Fuel</option>';
            data.fuelTypes.forEach(item => {
                fuel.innerHTML += `<option value="${item}">${item}</option>`;
            });
        });
});
</script>



        <div class="row">
          @forelse ($cars as $car)
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="listing d-block align-items-stretch">
                <div class="listing-img h-100 mr-4">
                  <img src="{{ asset('images/car_1.jpg') }}" alt="{{ $car->model }}" class="img-fluid">
                </div>
                <div class="listing-contents h-100">
                  
                  <!-- Title -->
                  <h3>{{ $car->brand }} {{ $car->model }}</h3>
                  <p class="text-muted">Car ID: {{ $car->id }}</p>

                  
                  <!-- Price -->
                  <div class="rent-price mb-3">
                    <strong>RM {{ number_format($car->price, 2) }}</strong><span class="mx-1">/</span>day
                    <li><strong>Half-Day:</strong> RM {{ number_format($car->half_day_price,2) }}</li>
                    <li><strong>Per Hour:</strong> RM {{ number_format($car->hourly_rate,2) }}</li>
                  </div>

                  <!-- Features Grid -->
                  <ul class="list-unstyled mb-3">
                    <li><strong>Type:</strong> {{ ucfirst($car->car_type) }}</li>
                    <li><strong>Transmission:</strong> {{ $car->transmission_type }}</li>
                    <li><strong>Fuel:</strong> {{ $car->fuel_type }}</li>
                    <li><strong>Passengers:</strong> {{ $car->passenger_capacity }}</li>
                    <li><strong>Location:</strong> {{ $car->pickup_location }}</li>
                    <!-- <li><strong>Available:</strong>
                      {{ \Carbon\Carbon::parse($car->available_from)->format('M d, Y') }}
                       – 
                      {{ \Carbon\Carbon::parse($car->available_until)->format('M d, Y') }}
                    </li> -->
                    <li><strong>Status:</strong> 
                      @if($car->availability)
                        <span class="text-success">Available</span>
                      @else
                        <span class="text-danger">Not Available</span>
                      @endif
                    </li>
                  </ul>

                  <!-- Action -->
                  <p>
                    @if($car->availability)
                      <a href="{{ route('booking', ['id' => $car->id]) }}" class="btn btn-primary btn-sm">Rent Now</a>
                    @else
                      <button class="btn btn-secondary btn-sm" disabled>Currently Booked</button>
                    @endif
                  </p>

                </div>
              </div>
            </div>
          @empty
            <p class="text-center">No cars found matching your filters.</p>
          @endforelse
        </div>
<
        <div class="d-flex justify-content-center mt-4">
            {{ $cars->links('pagination::bootstrap-4') }}
        </div>
      
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