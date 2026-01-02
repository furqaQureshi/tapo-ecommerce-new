@extends('front.layouts.app')

@section('title')
    {{ __('lang.subcription_form') }}
@endsection

@section('content')

    <section class="subscribe-info-section section-bg section-padding fix">
        <div class="container-fluid">
            <div class="cf-form-container">
                <div class="cf-card">
                    <div class="cf-card-header">
                        <h3><i class="fas fa-heart me-2"></i>Tell us more about you</h3>
                    </div>

                    <div class="cf-progress-container">
                        <div class="cf-progress">
                            <div class="cf-progress-bar" id="progressBar" style="width: 12.5%"></div>
                        </div>
                    </div>

                    <div class="cf-card-body">
                        <form id="maternityForm">
                            <!-- Step 1: Date of Birth -->
                            <div class="cf-form-step active" id="step1">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/6.png') }}">
                                <div class="cf-form-group form-group">
                                    <label for="dob" class="cf-form-label form-label">Date of Birth</label>
                                    <input type="date" class="cf-form-control form-control" id="dob" name="dob"
                                        required>
                                </div>
                                <div class="cf-form-group form-group">
                                    <label for="race" class="cf-form-label form-label">Race</label>
                                    <select class="cf-form-select" id="race" name="race" required>
                                        <option value=""></option>
                                        <option value="Malay">Malay</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Iban">Iban</option>
                                        <option value="Kadazan">Kadazan</option>
                                        <option value="Bidayuh">Bidayuh</option>
                                        <option value="Orang Asli">Orang Asli</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Step 2: First-time mother -->
                            <div class="cf-form-step" id="step2">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/1.png') }}">
                                <h4 class="cf-form-title">Are you a first-time mother?</h4>
                                <div class="cf-form-group form-group">
                                    <div class="cf-radio-group">
                                        <div class="cf-radio-option">
                                            <input type="radio" id="firstTime_yes" name="firstTime" value="yes">
                                            <label for="firstTime_yes">
                                                <i class="fas fa-baby me-2"></i>Yes
                                            </label>
                                        </div>
                                        <div class="cf-radio-option">
                                            <input type="radio" id="firstTime_no" name="firstTime" value="no">
                                            <label for="firstTime_no">
                                                <i class="fas fa-users me-2"></i>No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Pregnant (for first-time mother) -->
                            <div class="cf-form-step" id="step3a">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/2.png') }}">
                                <h4 class="cf-form-title">Are you currently pregnant?</h4>
                                <div class="cf-form-group form-group">
                                    <div class="cf-radio-group">
                                        <div class="cf-radio-option">
                                            <input type="radio" id="pregnant_first_yes" name="pregnant_first"
                                                value="yes">
                                            <label for="pregnant_first_yes">
                                                <i class="fas fa-heart me-2"></i>Yes
                                            </label>
                                        </div>
                                        <div class="cf-radio-option">
                                            <input type="radio" id="pregnant_first_no" name="pregnant_first"
                                                value="no">
                                            <label for="pregnant_first_no">
                                                <i class="fas fa-times me-2"></i>No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3b: Pregnant (for non-first-time mother) -->
                            <div class="cf-form-step" id="step3b">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/2.png') }}">
                                <h4 class="cf-form-title">Are you currently pregnant?</h4>
                                <div class="cf-form-group form-group">
                                    <div class="cf-radio-group">
                                        <div class="cf-radio-option">
                                            <input type="radio" id="pregnant_not_first_yes" name="pregnant_not_first"
                                                value="yes">
                                            <label for="pregnant_not_first_yes">
                                                <i class="fas fa-heart me-2"></i>Yes
                                            </label>
                                        </div>
                                        <div class="cf-radio-option">
                                            <input type="radio" id="pregnant_not_first_no" name="pregnant_not_first"
                                                value="no">
                                            <label for="pregnant_not_first_no">
                                                <i class="fas fa-times me-2"></i>No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4a: Due Date (first-time, pregnant) -->
                            <div class="cf-form-step" id="step4a">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/4.png') }}">
                                <h4 class="cf-form-title">When is your expected due date?</h4>
                                <div class="cf-form-group form-group">
                                    <label for="dueDate_first" class="cf-form-label form-label">Expected Due Date</label>
                                    <input type="date" class="cf-form-control form-control" id="dueDate_first"
                                        name="dueDate_first">
                                </div>
                            </div>

                            <!-- Step 4b: Due Date (non-first-time, pregnant) -->
                            <div class="cf-form-step" id="step4b">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/4.png') }}">
                                <h4 class="cf-form-title">When is your expected due date?</h4>
                                <div class="cf-form-group form-group">
                                    <label for="dueDate_not_first" class="cf-form-label form-label">Expected Due
                                        Date</label>
                                    <input type="date" class="cf-form-control form-control" id="dueDate_not_first"
                                        name="dueDate_not_first">
                                </div>
                            </div>

                            <!-- Step 5: Number of children -->
                            <div class="cf-form-step" id="step5">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/3.png') }}">
                                <h4 class="cf-form-title">How many children do you have?</h4>
                                <div class="cf-form-group form-group">
                                    <label for="numChildren" class="cf-form-label form-label">Number of Children</label>
                                    <select class="cf-form-select" id="numChildren" name="numChildren">
                                        <option value="">Select number of children</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Step 6: Children's dates of birth -->
                            <div class="cf-form-step" id="step6">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/5.png') }}">
                                <h4 class="cf-form-title">Please provide your children's dates of birth</h4>
                                <div class="cf-form-group form-group">
                                    <div id="childrenDates" class="cf-children-dates">
                                        <!-- Dynamic content will be inserted here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Final Step: Completion -->
                            <div class="cf-form-step" id="stepFinal">
                                <img class="step-fimg" src="{{ asset('front/assets/img/subscription/7.png') }}">
                                <h4 class="cf-form-title">One Last Step!</h4>
                                <!-- Address -->
                                <div class="cf-form-group form-group">
                                  <label for="locationinput" class="cf-form-label form-label">Street Address</label>                                  
                                  <input type="text" class="cf-form-control form-control spt-address" id="locationinput" name="address" placeholder="Street, building, area" required/>
                                </div>
                                <div class="row">
                                    <!-- State -->
                                    <div class="col-sm-4">
                                        <div class="cf-form-group form-group">
                                          <label for="customerState" class="cf-form-label form-label">State</label>
                                          <select id="customerState" name="customer_state" placeholder="State" class="cf-form-control form-control spt-state" required>
                                            <option value="">Select option</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Malacca">Malacca</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Putrajaya">Putrajaya</option>
                                          </select>
                                        </div>
                                    </div>
                                    <!-- City -->
                                    <div class="col-sm-4">
                                        <div class="cf-form-group form-group">
                                          <label for="customerCity" class="cf-form-label form-label">City</label>
                                          <select id="customerCity" name="customer_city" placeholder="City" class="cf-form-control form-control spt-city" required>
                                            <option value="">Select option</option>
                                          </select>
                                        </div>
                                    </div>
                                    <!-- Postal Code -->
                                    <div class="col-sm-4">
                                        <div class="cf-form-group form-group">
                                          <label for="customerPostal" class="cf-form-label form-label">Postal Code</label>
                                          <input type="text" id="customerPostal" name="postal_code" class="cf-form-control form-control spt-postal" placeholder="e.g., 50450" maxlength="5" required >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="cf-btn-container">
                        <button type="button" class="cf-btn cf-btn-secondary" id="prevBtn" onclick="previousStep()"
                            disabled>
                            <i class="fas fa-chevron-left me-2"></i>Back
                            <span></span>
                        </button>
                        <button type="button" class="cf-btn cf-btn-primary" id="nextBtn" onclick="nextStep()">
                            <span></span>Next<i class="fas fa-chevron-right ms-2"></i>
                        </button>
                        <button type="button" class="cf-btn cf-btn-primary final-submit-btn" onclick="submitForm()" id="submtBtn">
                            <span></span>Submit Form<i class="fas fa-paper-plane me-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal (Quick View for Products) -->
    @if ($product_lists)
        @foreach ($product_lists as $key => $product)
            <div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            @php
                                                $photo = explode(',', $product->photo);
                                            @endphp
                                            @foreach ($photo as $data)
                                                <div class="single-slider">
                                                    <img src="{{ asset($data) }}" alt="{{ $product->title }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{ $product->title }}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    @php
                                                        $rate = DB::table('reviews')
                                                            ->where('product_id', $product->id)
                                                            ->avg('rating');
                                                        $rate_count = DB::table('reviews')
                                                            ->where('product_id', $product->id)
                                                            ->count();
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($rate >= $i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{ $rate_count }} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if ($product->stock > 0)
                                                    <span><i class="fa fa-check-circle-o"></i> {{ $product->stock }} in
                                                        stock</span>
                                                @else
                                                    <span><i class="fa fa-times-circle-o text-danger"></i>
                                                        {{ $product->stock }} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount =
                                                $product->price - ($product->price * $product->discount) / 100;
                                        @endphp
                                        <h3><small><del
                                                    class="text-muted">${{ number_format($product->price, 2) }}</del></small>
                                            ${{ number_format($after_discount, 2) }}</h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if ($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            @php
                                                                $sizes = explode(',', $product->size);
                                                            @endphp
                                                            @foreach ($sizes as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                                                    <input type="text" name="quant[1]" class="input-number"
                                                        data-min="1" data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                            data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Add to cart</button>
                                                <a href="javascript:void(0)" class="btn min"><i class="ti-heart"></i></a>
                                            </div>
                                        </form>
                                        <div class="default-social">
                                            <div class="sharethis-inline-share-buttons"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- End Modal -->
@endsection


@push('styles')
<script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
        async='async'></script>
    <style>
        /* Hero Slider Styling */
        .hero-section-2 .swiper-slide {
            /* background: #000000; */
            color: black;
        }

        .hero-section-2 .hero-bg {
            /* height: 550px; */
            opacity: 0.8;
            width: 100% !important;
        }

        .hero-section-2 .hero-content {
            /* bottom: 60%; */
        }

        .hero-section-2 .hero-content h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        .hero-section-2 .hero-content p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        .hero-section-2 .swiper-pagination {
            bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTyYALiaFS1ZE0-rL8xgFtOhNK4zhTn9c&libraries=places&v=weekly" defer async></script>

    <script>
        let currentStep = 1;
        let totalSteps = 8;
        let formData = {};


        $(document).ready(function() {
            console.clear();
        
        function initAutocomplete() {
    const input = document.getElementById('locationinput');
    
    // Check if input element exists
    if (!input) {
        console.error("Element with id 'locationinput' not found");
        return;
    }
    
    // Fixed syntax - added closing parenthesis
    const autocomplete = new google.maps.places.Autocomplete(input, {
        types: ['geocode'], // Restrict to addresses
        componentRestrictions: { country: 'my' } // Restrict to Malaysia
    });

    // Optional: Add listeners for selection or other events
    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }
        // Do something with the selected place, e.g., display its details
        console.log("Selected place:", place.name, place.formatted_address);
    });
}

// Initialize when window loads
window.initAutocomplete = initAutocomplete;

            updateProgressBar();
            updateButtons();
            $('#submtBtn').hide();
            
            var malaysiaCities = {
            "Johor": ["Johor Bahru", "Batu Pahat", "Muar", "Kluang", "Segamat"],
            "Kedah": ["Alor Setar", "Sungai Petani", "Kulim", "Langkawi"],
            "Kelantan": ["Kota Bharu", "Pasir Mas", "Tumpat", "Tanah Merah"],
            "Malacca": ["Malacca City", "Ayer Keroh", "Alor Gajah", "Jasin"],
            "Negeri Sembilan": ["Seremban", "Port Dickson", "Nilai", "Bahau"],
            "Pahang": ["Kuantan", "Temerloh", "Bentong", "Raub"],
            "Penang": ["George Town", "Bukit Mertajam", "Butterworth", "Balik Pulau"],
            "Perak": ["Ipoh", "Taiping", "Teluk Intan", "Sitiawan"],
            "Perlis": ["Kangar", "Arau", "Padang Besar"],
            "Sabah": ["Kota Kinabalu", "Sandakan", "Tawau", "Lahad Datu"],
            "Sarawak": ["Kuching", "Miri", "Sibu", "Bintulu"],
            "Selangor": ["Shah Alam", "Petaling Jaya", "Klang", "Subang Jaya", "Kajang"],
            "Terengganu": ["Kuala Terengganu", "Kemaman", "Dungun", "Besut"],
            "Kuala Lumpur": ["Kuala Lumpur"],
            "Labuan": ["Labuan"],
            "Putrajaya": ["Putrajaya"]
          };
            
        
            // On state change -> load cities
            $("#customerState").on("change", function () {
              var state = $(this).val();
              var $city = $("#customerCity");
              $city.empty().append('<option value="">Select option</option>');
        
              if (malaysiaCities[state]) {
                $.each(malaysiaCities[state], function (index, city) {
                  $city.append(new Option(city, city));
                });
              }
        
              $city.trigger("change.select2"); // refresh Select2
            });
        });

        function nextStep() {
            if (!validateCurrentStep()) {
                return;
            }

            saveCurrentStepData();

            const nextStepNum = determineNextStep();
            if (nextStepNum) {
                showStep(nextStepNum);
            }
        }

        function previousStep() {
            const prevStepNum = determinePreviousStep();
            if (prevStepNum) {
                showStep(prevStepNum);
            }
        }

        function showStep(stepNum) {
            const currentStepId = getCurrentStepId();
            $(`#${currentStepId}`).removeClass('active').addClass('fade-out');

            setTimeout(() => {
                $('.cf-form-step').removeClass('fade-out active').hide();

                currentStep = stepNum;

                const stepId = getStepId(stepNum);
                $(`#${stepId}`).show().addClass('active animate-in');

                updateProgressBar();
                updateButtons();

                setTimeout(() => {
                    $(`#${stepId}`).removeClass('animate-in');
                }, 400);
            }, 200);
        }

        function getCurrentStepId() {
            switch (currentStep) {
                case 1:
                    return 'step1';
                case 2:
                    return 'step2';
                case 3:
                    return formData.firstTime === 'yes' ? 'step3a' : 'step3b';
                case 4:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        return 'step4a';
                    } else if (formData.firstTime === 'no' && formData.pregnant_not_first === 'yes') {
                        return 'step4b';
                    } else {
                        return 'step5';
                    }
                case 5:
                    return 'step5';
                case 6:
                    return 'step6';
                case 7:
                    return 'stepFinal';
                default:
                    return 'step1';
            }
        }

        function getStepId(stepNum) {
            switch (stepNum) {
                case 1:
                    return 'step1';
                case 2:
                    return 'step2';
                case 3:
                    return formData.firstTime === 'yes' ? 'step3a' : 'step3b';
                case 4:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        return 'step4a';
                    } else if (formData.firstTime === 'no' && formData.pregnant_not_first === 'yes') {
                        return 'step4b';
                    } else {
                        return 'step5';
                    }
                case 5:
                    return 'step5';
                case 6:
                    return 'step6';
                case 7:
                    return 'stepFinal';
                default:
                    return 'step1';
            }
        }

        function determineNextStep() {
            switch (currentStep) {
                case 1:
                    return 2;
                case 2:
                    return 3;
                case 3:
                    if (formData.firstTime === 'yes') {
                        return formData.pregnant_first === 'yes' ? 4 : 5;
                    } else {
                        return formData.pregnant_not_first === 'yes' ? 4 : 5;
                    }
                case 4:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        return 7;
                    } else {
                        return 5;
                    }
                case 5:
                    return 6;
                case 6:
                    return 7;
                default:
                    return null;
            }
        }

        function determinePreviousStep() {
            switch (currentStep) {
                case 2:
                    return 1;
                case 3:
                    return 2;
                case 4:
                    return 3;
                case 5:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'no') {
                        return 3;
                    } else if (formData.firstTime === 'no' && formData.pregnant_not_first === 'no') {
                        return 3;
                    } else {
                        return 4;
                    }
                case 6:
                    return 5;
                case 7:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        return 4;
                    } else if (formData.numChildren) {
                        return 6;
                    } else {
                        return 5;
                    }
                default:
                    return null;
            }
        }

        function validateCurrentStep() {
            switch (currentStep) {
                case 1:
                    return $('#dob').val() !== '' && $('#race').val() !== '';
                case 2:
                    return $('input[name="firstTime"]:checked').length > 0;
                case 3:
                    if (formData.firstTime === 'yes') {
                        return $('input[name="pregnant_first"]:checked').length > 0;
                    } else {
                        return $('input[name="pregnant_not_first"]:checked').length > 0;
                    }
                case 4:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        return $('#dueDate_first').val() !== '';
                    } else if (formData.firstTime === 'no' && formData.pregnant_not_first === 'yes') {
                        return $('#dueDate_not_first').val() !== '';
                    }
                    return true;
                case 5:
                    return $('#numChildren').val() !== '';
                case 6:
                    const numChildren = parseInt(formData.numChildren || 0);
                    for (let i = 1; i <= numChildren; i++) {
                        if ($(`#childDob${i}`).val() === '') {
                            return false;
                        }
                    }
                    return true;
                default:
                    return true;
            }
        }

        function validateAddressInput()
        {
            var address = $('#locationinput').val().trim();
            var state = $('#customerState').val();
            var city = $('#customerCity').val();
            var postal_code = $('#customerPostal').val().trim();
            if(address=="")
            {
                Swal.fire({ icon: 'error', title: 'Required', text: 'Street Address is required', timer: 1500, showConfirmButton: false });
                return false;                
            }
            else if(state=="")
            {
                Swal.fire({ icon: 'error', title: 'Required', text: 'State is required', timer: 1500, showConfirmButton: false });
                return false;                
            }
            else if(city=="")
            {
                Swal.fire({ icon: 'error', title: 'Required', text: 'City is required', timer: 1500, showConfirmButton: false });
                return false;                
            }
            else if(postal_code=="")
            {
                Swal.fire({ icon: 'error', title: 'Required', text: 'Postal Code is required', timer: 1500, showConfirmButton: false });
                return false;                
            }                
            else
            {
                 const mappedAnswers = Object.fromEntries(
                Object.entries(formData).map(([key, value]) => {
                    if (value === "yes") return [key, 1];
                    if (value === "no") return [key, 0];
                    return [key, value];
                })
            );
                fetch("{{ route('subscriber-form-submit') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(mappedAnswers)
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully!',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href = "{{ route('choose-products') }}";
                    }, 1500);
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while submitting the form.'
                    });
                });
            }
        }

        function saveCurrentStepData() {
            switch (currentStep) {
                case 1:
                    formData.dob = $('#dob').val();
                    formData.race = $('#race').val();
                    break;
                case 2:
                    formData.firstTime = $('input[name="firstTime"]:checked').val();
                    break;
                case 3:
                    if (formData.firstTime === 'yes') {
                        formData.pregnant_first = $('input[name="pregnant_first"]:checked').val();
                    } else {
                        formData.pregnant_not_first = $('input[name="pregnant_not_first"]:checked').val();
                    }
                    break;
                case 4:
                    if (formData.firstTime === 'yes' && formData.pregnant_first === 'yes') {
                        formData.dueDate_first = $('#dueDate_first').val();
                    } else if (formData.firstTime === 'no' && formData.pregnant_not_first === 'yes') {
                        formData.dueDate_not_first = $('#dueDate_not_first').val();
                    }
                    break;
                case 5:
                    formData.numChildren = $('#numChildren').val();
                    generateChildrenDateInputs();
                    break;
                case 6:
                    formData.childrenDates = [];
                    const numChildren = parseInt(formData.numChildren || 0);
                    for (let i = 1; i <= numChildren; i++) {
                        formData.childrenDates.push($(`#childDob${i}`).val());
                    }
                    break;
                case 7: // Save data for stepFinal                    
                    formData.address = $('#locationinput').val().trim();
                    formData.customer_state = $('#customerState').val();
                    formData.customer_city = $('#customerCity').val();
                    formData.postal_code = $('#customerPostal').val().trim();
                    break;
            }
        }

        // function generateChildrenDateInputs() {
        //     const numChildren = parseInt(formData.numChildren || 0);
        //     const container = $('#childrenDates');
        //     container.empty();

        //     for (let i = 1; i <= numChildren; i++) {
        //         const childGroup = $(`
        //             <div class="cf-child-date-group">
        //                 <label for="childDob${i}" class="cf-form-label">
        //                     <i class="fas fa-child me-2"></i>Child ${i} - Date of Birth
        //                 </label>
        //                 <input type="date" class="cf-form-control form-control" id="childDob${i}" name="childDob${i}" required>
        //             </div>
        //         `);
        //         container.append(childGroup);
        //     }
        // }
        function generateChildrenDateInputs() {
            const numChildren = parseInt(formData.numChildren || 0);
            const container = $('#childrenDates');
            container.empty();

            for (let i = 1; i <= numChildren; i++) {
                const childGroup = $(`
                    <div class="cf-child-date-group">
                        <label for="childDob${i}" class="cf-form-label">
                            <i class="fas fa-child me-2"></i>Child ${i} - Date of Birth
                        </label>
                        <input type="date" class="cf-form-control form-control" id="childDob${i}" name="childDob${i}" required>
                    </div>
                `);
                container.append(childGroup);
            }

            // 🔁 Re-apply focus handler to new inputs
            document.querySelectorAll('#childrenDates input[type="date"]').forEach(input => {
                input.addEventListener('focus', function () {
                    if (this.showPicker) {
                        this.showPicker();
                    }
                });
            });
        }


        function updateProgressBar() {
            console.clear();
            const progress = (currentStep / totalSteps) * 100;
            $('#progressBar').css('width', progress + '%');
            $('#stepInfo').text(`Step ${currentStep} of ${totalSteps}`);
        }

        function updateButtons() {
            $('#prevBtn').prop('disabled', currentStep === 1);

            if (currentStep === 7) {
                $('#nextBtn').hide();
                $('#submtBtn').show();
            } else {
                $('#nextBtn').show();
                $('#submtBtn').hide();
            }
            
            if (currentStep === 1) {
                $('#prevBtn').hide();
            }else {
                $('#prevBtn').show();
            }
        }

        function submitForm() {            
            saveCurrentStepData();
            
            if(currentStep==7)
            {
                validateAddressInput();
            } 
        }

        $(document).ready(function() {
            const today = new Date().toISOString().split('T')[0];
            $('#dueDate_first, #dueDate_not_first').attr('min', today);
        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-cart-item', function() {
                var $item = $(this).closest('li');
                var product_id = $item.data('product-id');
                var is_model = $item.data('is-model') === 1;

                var data = {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    is_model: is_model
                };
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to remove this item from the cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cart.remove') }}",
                            method: 'POST',
                            data: data,
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    updateCartSidebar(response.cartItems, response
                                        .totalPrice);
                                    updateCartCount(response.cartCount);
                                } else {
                                    toastr.error('Failed to remove item.');
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Failed to remove item.');
                            }
                        });
                    }
                });
            });

            // Function to update cart sidebar content
            // function updateCartSidebar(cartItems, totalPrice) {
            //     var $cartList = $('.menu-cart.style-2 .cart-box ul');
            //     var $cartTotal = $('.totalPrice');
            //     $cartList.empty(); // Clear current cart items

            //     if (cartItems.length > 0) {
            //         // Group items by product_id to prevent duplicates
            //         var groupedItems = {};
            //         var localTotalPrice = 0;

            //         $.each(cartItems, function(index, item) {
            //             var productId = item.product_id || item.id; // Handle different response formats
            //             if (!groupedItems[productId]) {
            //                 groupedItems[productId] = {
            //                     ...item,
            //                     quantity: 0
            //                 };
            //             }
            //             groupedItems[productId].quantity += parseInt(item.quantity, 10);
            //             localTotalPrice += parseFloat(item.price) * parseInt(item.quantity, 10);
            //         });

            //         // Render grouped items
            //         $.each(groupedItems, function(productId, item) {
            //             var photo = item.image ?
            //                 (item.image.includes(',') ?
            //                     window.baseURL + '/' + item.image.split(',')[0].trim() :
            //                     window.baseURL + '/' + item.image) :
            //                 window.baseURL + '/front/assets/img/product/01.jpg';

            //             var cartItemHtml = `
            //     <li data-product-id="${item.id}" data-is-model="0">
            //         <a href="javascript:void(0);" class="remove remove-cart-item" title="Remove this item">
            //             <i class="fa fa-remove"></i>
            //         </a>
            //         <img src="${photo}" alt="${item.name}" />
            //         <div class="cart-product">
            //             <a href="{{ route('product.detail', '') }}/${item.slug}" target="_blank">
            //                 ${item.name}
            //             </a>
            //             <span>RM ${parseFloat(item.price).toFixed(2)}</span>
            //             <p class="quantity">${item.quantity} x</p>
            //         </div>
            //     </li>`;
            //             $cartList.append(cartItemHtml);
            //         });

            //         // Update total price
            //         $cartTotal.text(`RM ${parseFloat(totalPrice).toFixed(2)}`);

            //         // Show cart buttons
            //         $('.menu-cart.style-2 .cart-box .cart-button').show();
            //     } else {
            //         $cartList.append('<li>No items in cart.</li>');
            //         $cartTotal.text(`RM 0.00`);
            //         $('.menu-cart.style-2 .cart-box .cart-button').hide();
            //     }
            // }

            // Function to update cart icon count
            function updateCartCount(count) {
                var $cartIconCount = $('.menu-cart.style-2 .cart-icon .total-count');
                if (count > 0) {
                    $cartIconCount.text(count).show();
                } else {
                    $cartIconCount.hide();
                }
            }

            // Handle remove item from cart


            // Existing cart sidebar toggle logic
            var $menuCart = $(".menu-cart.style-2");
            var $cartBox = $menuCart.find(".cart-box");
            var $cartIcon = $menuCart.find(".cart-icon");

            $cartBox.hide();

            // Toggle on cart icon click
            $cartIcon.on("click", function(e) {
                e.preventDefault();
                $cartBox.toggle();
            });

            // Hide cart when clicking outside
            $(document).on("click", function(e) {
                if (!$menuCart.is(e.target) && $menuCart.has(e.target).length === 0) {
                    $cartBox.hide();
                }
            });

            // Close button inside header
            var $closeHeader = $("#cartCloseHeader");
            if ($closeHeader.length) {
                $closeHeader.on("click", function() {
                    $closeHeader.closest(".cart-box").hide();
                });
            }

            // Also close on outside mousedown
            $(document).on("mousedown", function(e) {
                if ($cartBox.is(":visible") && !$cartBox.is(e.target) && $cartBox.has(e.target).length ===
                    0) {
                    $cartBox.hide();
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get all date inputs on page
            const dateInputs = document.querySelectorAll('input[type="date"]');

            dateInputs.forEach(input => {
                // Optional: force calendar open on focus (for Chrome, Edge)
                input.addEventListener('focus', function () {
                    if (this.showPicker) {
                        this.showPicker(); // Triggers the calendar popup
                    }
                });
            });
        });
    </script>
@endpush
