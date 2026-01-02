@extends('front.layouts.app')

@section('title', __('lang.Complete_your_profile') . ' | ' . config('app.name'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card modern-card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">
                            {{ isset($onboarding) && $onboarding->exists ? __('lang.Complete_your_profile') : __('lang.Complete_your_profile') }}
                        </h3>
                        <p class="text-muted mb-0">
                            {{ __('lang.Tell_us_about_yourself_to_get_personalized_recommendations') }}</p>
                    </div>

                    <div class="card-body">
                        <div class="progress mb-4" style="height: 8px;" id="progressContainer">
                            <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 50%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <form method="POST" action="{{ route('onboarding.store') }}" id="onboardingForm">
                            @csrf

                            <div class="wizard">
                                <!-- Step 1: Question 7 -->
                                <div class="step" data-step="1">
                                    <div class="step-header text-center mb-4">
                                        <span class="step-number">1</span>
                                        <h4 class="step-title">{{ __('lang.What_best_describes_you_at_the_moment') }}</h4>
                                        <p class="step-subtitle">
                                            {{ __('lang.Select_all_that_apply_to_your_current_situation') }}</p>
                                    </div>

                                    <div class="question-grid mb-4">
                                        @php
                                            $descriptions =
                                                isset($onboarding->descriptions) && is_array($onboarding->descriptions)
                                                    ? $onboarding->descriptions
                                                    : [];
                                        @endphp

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I'm trying to conceive]"
                                            data-value="I'm trying to conceive"
                                            @if (in_array("I'm trying to conceive", $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M12 21a9 9 0 0 0 9-9 9 9 0 0 0-9-9 9 9 0 0 0-9 9 9 9 0 0 0 9 9z" />
                                                    <path d="M11 8h2v6h-2z" />
                                                    <path d="M8 11h6" />
                                                </svg>
                                                <span>{{ __('lang.trying_to_conceive') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have indigestion problem]"
                                            data-value="I have indigestion problem"
                                            @if (in_array('I have indigestion problem', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                                                </svg>
                                                <span>{{ __('lang.indigestion_problem') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[My children has indigestion problem]"
                                            data-value="My children has indigestion problem"
                                            @if (in_array('My children has indigestion problem', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="7" r="4" />
                                                    <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                                                </svg>
                                                <span>{{ __('lang.children_indigestion_problem') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have oily facial skin]"
                                            data-value="I have oily facial skin"
                                            @if (in_array('I have oily facial skin', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 2a10 10 0 0 0-10 10c0 2.76 1.12 5.26 2.93 7.07" />
                                                    <path d="M12 22a10 10 0 0 0 10-10c0-2.76-1.12-5.26-2.93-7.07" />
                                                    <path d="M12 6v12" />
                                                </svg>
                                                <span>{{ __('lang.oily_facial_skin') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have mixed facial skin]"
                                            data-value="I have mixed facial skin"
                                            @if (in_array('I have mixed facial skin', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2a10 10 0 0 0-10 10c0 2.76 1.12 5.26 2.93 7.07" />
                                                    <path d="M12 22a10 10 0 0 0 10-10c0-2.76-1.12-5.26-2.93-7.07" />
                                                    <path d="M6 12h12" />
                                                </svg>
                                                <span>{{ __('lang.mixed_facial_skin') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[i have sensitive facial skin]"
                                            data-value="i have sensitive facial skin"
                                            @if (in_array('i have sensitive facial skin', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2a10 10 0 0 0-10 10c0 2.76 1.12 5.26 2.93 7.07" />
                                                    <path d="M12 22a10 10 0 0 0 10-10c0-2.76-1.12-5.26-2.93-7.07" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.sensitive_facial_skin') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have stretch mark]" data-value="I have stretch mark"
                                            @if (in_array('I have stretch mark', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v20" />
                                                    <path d="M8 5h8" />
                                                    <path d="M8 19h8" />
                                                </svg>
                                                <span>{{ __('lang.stretch_marks') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have caesarean scar]"
                                            data-value="I have caesarean scar"
                                            @if (in_array('I have caesarean scar', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M3 12h18" />
                                                    <path d="M6 15l3-3-3-3" />
                                                    <path d="M18 15l-3-3 3-3" />
                                                </svg>
                                                <span>{{ __('lang.caesarean_scar') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[My child has food allergy]"
                                            data-value="My child has food allergy"
                                            @if (in_array('My child has food allergy', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <path d="M12 2v20" />
                                                    <path d="M2 12h20" />
                                                </svg>
                                                <span>{{ __('lang.child_food_allergy') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I'm looking for more educational toys]"
                                            data-value="I'm looking for more educational toys"
                                            @if (in_array("I'm looking for more educational toys", $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M4 4h16v16H4z" />
                                                    <path d="M9 9h6v6H9z" />
                                                </svg>
                                                <span>{{ __('lang.educational_toys') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[My child has eczema]" data-value="My child has eczema"
                                            @if (in_array('My child has eczema', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2a10 10 0 0 0-10 10c0 2.76 1.12 5.26 2.93 7.07" />
                                                    <path d="M12 22a10 10 0 0 0 10-10c0-2.76-1.12-5.26-2.93-7.07" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.child_eczema') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I'm losing hair]" data-value="I'm losing hair"
                                            @if (in_array("I'm losing hair", $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.losing_hair') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="descriptions[I have dry hair]" data-value="I have dry hair"
                                            @if (in_array('I have dry hair', $descriptions)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M6 12h12" />
                                                </svg>
                                                <span>{{ __('lang.dry_hair') }}</span>
                                            </div>
                                        </button>
                                    </div>

                                    @error('descriptions')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                    @enderror

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-next" data-step="2">
                                            {{ __('lang.Next') }} <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 2: Question 8 -->
                                <div class="step" data-step="2" style="display: none;">
                                    <div class="step-header text-center mb-4">
                                        <span class="step-number">2</span>
                                        <h4 class="step-title">{{ __('lang.what_would_you_prefer') }}</h4>
                                        <p class="step-subtitle">{{ __('lang.choose_preferred_categories') }}</p>
                                    </div>

                                    <div class="question-grid mb-4">
                                        @php
                                            $preferences =
                                                isset($onboarding->preferences) && is_array($onboarding->preferences)
                                                    ? $onboarding->preferences
                                                    : [];
                                        @endphp

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[lotion]" data-value="lotion"
                                            @if (in_array('lotion', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.lotion') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[shower]" data-value="shower"
                                            @if (in_array('shower', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M6 12h12" />
                                                </svg>
                                                <span>{{ __('lang.shower_products') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern" data-name="preferences[toys]"
                                            data-value="toys"
                                            @if (in_array('toys', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M4 4h16v16H4z" />
                                                    <path d="M9 9h6v6H9z" />
                                                </svg>
                                                <span>{{ __('lang.toys') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[baby food]" data-value="baby food"
                                            @if (in_array('baby food', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.baby_food') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[story book]" data-value="story book"
                                            @if (in_array('story book', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M4 4h16v16H4z" />
                                                    <path d="M8 8h8v8H8z" />
                                                </svg>
                                                <span>{{ __('lang.story_books') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[diapers]" data-value="diapers"
                                            @if (in_array('diapers', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M6 12h12" />
                                                </svg>
                                                <span>{{ __('lang.diapers') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[stretchmark products]"
                                            data-value="stretchmark products"
                                            @if (in_array('stretchmark products', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.stretchmark_products') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[facial skincare]" data-value="facial skincare"
                                            @if (in_array('facial skincare', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2a10 10 0 0 0-10 10c0 2.76 1.12 5.26 2.93 7.07" />
                                                    <path d="M12 22a10 10 0 0 0 10-10c0-2.76-1.12-5.26-2.93-7.07" />
                                                    <path d="M8 12h8" />
                                                </svg>
                                                <span>{{ __('lang.facial_skincare') }}</span>
                                            </div>
                                        </button>

                                        <button type="button" class="question-btn-modern"
                                            data-name="preferences[antihairloss shampoo]"
                                            data-value="antihairloss shampoo"
                                            @if (in_array('antihairloss shampoo', $preferences)) data-selected='true' @endif>
                                            <div class="btn-content">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 2v6" />
                                                    <path d="M12 16v6" />
                                                    <path d="M6 12h12" />
                                                </svg>
                                                <span>{{ __('lang.anti_hairloss_shampoo') }}</span>
                                            </div>
                                        </button>
                                    </div>

                                    @error('preferences')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                    @enderror

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-secondary btn-prev" data-step="1">
                                            <i class="fas fa-arrow-left me-2"></i> {{ __('lang.Previous') }}
                                        </button>
                                        <button type="submit" class="btn btn-submit">
                                            {{ isset($onboarding) && $onboarding->exists ? __('lang.Update_Profile') : __('lang.complete_profile') }}
                                            <i class="fas fa-check ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.step');
            const progressBar = document.querySelector('.progress-bar');
            let currentStep = 1;

            function showStep(step) {
                steps.forEach(s => s.style.display = 'none');
                document.querySelector(`.step[data-step="${step}"]`).style.display = 'block';

                // Update progress bar with smooth transition
                if (step === 1) {
                    progressBar.style.width = '50%';
                    progressBar.setAttribute('aria-valuenow', '50');
                } else {
                    progressBar.style.width = '100%';
                    progressBar.setAttribute('aria-valuenow', '100');
                }
            }

            // Enhanced button selection with modern effects
            document.querySelectorAll('.question-btn-modern').forEach(button => {
                // Initialize pre-selected buttons
                if (button.getAttribute('data-selected') === 'true') {
                    button.classList.add('selected');
                    // Ensure hidden input exists for pre-selected buttons
                    if (!document.querySelector(`input[name="${button.getAttribute('data-name')}"]`)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = button.getAttribute('data-name');
                        input.value = button.getAttribute('data-value');
                        button.parentElement.appendChild(input);
                    }
                    // Subtle scale for pre-selected visual confirmation
                    button.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        button.style.transform = '';
                    }, 300);
                }

                button.addEventListener('click', function() {
                    const isSelected = this.getAttribute('data-selected') === 'true';

                    if (isSelected) {
                        // Deselect button
                        this.setAttribute('data-selected', 'false');
                        this.classList.remove('selected');
                        // Remove hidden input if exists
                        const input = document.querySelector(
                            `input[name="${this.getAttribute('data-name')}"]`);
                        if (input) input.remove();
                    } else {
                        // Select button
                        this.setAttribute('data-selected', 'true');
                        this.classList.add('selected');

                        // Add ripple effect
                        const ripple = document.createElement('div');
                        ripple.className = 'ripple-effect';
                        this.appendChild(ripple);

                        setTimeout(() => {
                            if (ripple.parentNode) {
                                ripple.parentNode.removeChild(ripple);
                            }
                        }, 600);

                        // Add hidden input for form submission
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = this.getAttribute('data-name');
                        input.value = this.getAttribute('data-value');
                        this.parentElement.appendChild(input);
                    }
                });
            });

            // Navigation handlers
            document.querySelectorAll('[data-step]').forEach(button => {
                if (button.classList.contains('btn-next') || button.classList.contains('btn-prev')) {
                    button.addEventListener('click', function() {
                        const targetStep = parseInt(this.getAttribute('data-step'));
                        if (targetStep && targetStep !== currentStep) {
                            currentStep = targetStep;
                            showStep(currentStep);
                        }
                    });
                }
            });

            // Initialize first step
            showStep(currentStep);
        });
    </script>

    <style>
        :root {
            --primary-color: #e490a1;
            --primary-dark: #d47a8f;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --border-color: #e6e7e8;
            --success-color: #28a745;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 6px 25px rgba(0, 0, 0, 0.15);
            --border-radius: 0px;
        }

        .modern-card {
            background: #fff;
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 30px 20px;
            border: none;
        }

        .card-header h3 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .progress-bar-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .step-header {
            margin-bottom: 30px;
        }

        .step-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .step-title {
            color: var(--text-color);
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .step-subtitle {
            color: #666;
            font-size: 0.95em;
            margin: 0;
        }

        .question-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            max-width: 100%;
        }

        .question-btn-modern {
            position: relative;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: left;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            overflow: hidden;
            min-height: 80px;
            display: flex;
            align-items: center;
        }

        .question-btn-modern:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow);
            transform: translateY(-2px);
        }

        .question-btn-modern.selected {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-color: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .question-btn-modern.selected .icon {
            stroke: white;
        }

        .btn-content {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .btn-content .icon {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            min-width: 30px;
            stroke: var(--text-color);
        }

        .btn-content span {
            font-weight: 500;
            line-height: 1.3;
        }

        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn-next,
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 2px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(228, 144, 161, 0.4);
        }

        .btn-next:hover,
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(228, 144, 161, 0.5);
        }

        .btn-prev {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-color);
            padding: 12px 30px;
            border-radius: 2px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-prev:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 0px;
            padding: 15px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .question-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .card-header {
                padding: 20px 15px;
            }

            .question-btn-modern {
                padding: 16px;
                min-height: 70px;
            }

            .btn-content .icon {
                width: 20px;
                height: 20px;
                margin-right: 10px;
            }

            .step-title {
                font-size: 1.3em;
            }
        }

        @media (max-width: 480px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 15px;
            }

            .btn-next,
            .btn-submit,
            .btn-prev {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endsection
