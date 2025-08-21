@extends('layouts.app')

@section('title', __('general.contact') . ' - ' . getCompanyInfo('name'))

@section('content')
<!-- Page Header -->
<div class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <h1 class="display-4 mb-3">{{ __('general.contact') }}</h1>
                <p class="lead mb-0">{{ __('general.contact_page_subtitle') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Company Information -->
@include('components.company-info-leaflet')

<!-- Social Media Links Section -->
<section class="social-media py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">{{ __('general.follow_us') }}</h3>
                <p class="text-muted mb-4">{{ __('general.social_media_subtitle') }}</p>
                <div class="social-links d-flex justify-content-center flex-wrap gap-3">
                    <a href="{{ \App\Models\SiteSetting::get('social_twitter', '#') }}" class="social-link twitter" target="_blank">
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_facebook', '#') }}" class="social-link facebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_youtube', '#') }}" class="social-link youtube" target="_blank">
                        <i class="fab fa-youtube"></i>
                        <span>YouTube</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_instagram', '#') }}" class="social-link instagram" target="_blank">
                        <i class="fab fa-instagram"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_linkedin', '#') }}" class="social-link linkedin" target="_blank">
                        <i class="fab fa-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_pinterest', '#') }}" class="social-link pinterest" target="_blank">
                        <i class="fab fa-pinterest"></i>
                        <span>Pinterest</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_timber', '#') }}" class="social-link timber" target="_blank">
                        <i class="fas fa-tree"></i>
                        <span>Timber</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('social_github', '#') }}" class="social-link github" target="_blank">
                        <i class="fab fa-github"></i>
                        <span>GitHub</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
@if(getCompanyInfo('email'))
<section class="contact-form py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            {{ __('general.send_us_message') }}
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('general.name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('general.email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('general.phone_number') }}</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">{{ __('general.subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">{{ __('general.message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" required placeholder="{{ __('general.message_placeholder') }}"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    <span class="btn-text">{{ __('general.send_message') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('styles')
<style>
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.1);
    z-index: 1;
}

.page-header .container {
    position: relative;
    z-index: 2;
}

.contact-form {
    background-color: #f8f9fa;
}

.contact-form .card {
    border-radius: 15px;
    overflow: hidden;
}

.contact-form .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border: none;
    padding: 1.5rem;
}

.contact-form .form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.contact-form .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.contact-form .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.contact-form .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

/* Social Media Links Styles */
.social-media {
    background-color: #f8f9fa;
}

.social-links {
    max-width: 600px;
    margin: 0 auto;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 50px;
    text-decoration: none;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 140px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    color: white;
    text-decoration: none;
}

.social-link i {
    font-size: 18px;
    margin-right: 8px;
}

.social-link.twitter {
    background: linear-gradient(135deg, #1da1f2 0%, #0d8bd9 100%);
}

.social-link.facebook {
    background: linear-gradient(135deg, #3b5998 0%, #2d4373 100%);
}

.social-link.youtube {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
}

.social-link.instagram {
    background: linear-gradient(135deg, #e4405f 0%, #c13584 50%, #833ab4 100%);
}

.social-link.linkedin {
    background: linear-gradient(135deg, #0077b5 0%, #005885 100%);
}

.social-link.pinterest {
    background: linear-gradient(135deg, #bd081c 0%, #8c0613 100%);
}

.social-link.timber {
    background: linear-gradient(135deg, #228b22 0%, #006400 100%);
}

.social-link.github {
    background: linear-gradient(135deg, #333 0%, #24292e 100%);
}

@media (max-width: 768px) {
    .page-header {
        padding: 3rem 0;
    }
    
    .page-header h1 {
        font-size: 2.5rem;
    }
}
</style>
@endsection

@section('scripts')
<!-- Add SweetAlert2 FIRST -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
console.log('Contact form script loading...');

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, looking for contact form...');
    
    // Contact form handling with AJAX
    const contactForm = document.getElementById('contactForm');
    console.log('Contact form found:', contactForm);
    
    if (contactForm) {
        console.log('Adding event listener to contact form...');
        
        contactForm.addEventListener('submit', function(e) {
            console.log('Form submission intercepted!');
            e.preventDefault();
            e.stopPropagation();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const formData = new FormData(form);
            
            console.log('Form data:', Object.fromEntries(formData));
            
            // Disable button and show loading
            submitBtn.disabled = true;
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>{{ __("general.sending") }}';
            
            // Clear previous errors
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            console.log('CSRF token found:', csrfToken ? csrfToken.getAttribute('content') : 'NOT FOUND');
            
            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('{{ __("general.system_error") }}');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
                return;
            }
            
            console.log('Sending AJAX request...');
            
            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Response received:', response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        title: '{{ __("general.message_sent_successfully") }}',
                        text: '{{ __("general.message_sent_success_text") }}',
                        icon: 'success',
                        confirmButtonText: '{{ __("general.ok") }}',
                        confirmButtonColor: '#28a745',
                        timer: 5000,
                        timerProgressBar: true
                    });
                    
                    // Reset form
                    form.reset();
                } else {
                    // Show error message
                    Swal.fire({
                        title: '{{ __("general.error_occurred") }}',
                        text: data.message || '{{ __("general.message_send_error") }}',
                        icon: 'error',
                        confirmButtonText: '{{ __("general.ok") }}',
                        confirmButtonColor: '#dc3545'
                    });
                    
                    // Show field errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const errorDiv = document.createElement('div');
                                errorDiv.classList.add('invalid-feedback');
                                errorDiv.textContent = data.errors[field][0];
                                input.parentNode.appendChild(errorDiv);
                            }
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: '{{ __("general.error_occurred") }}',
                    text: '{{ __("general.unexpected_error") }}',
                    icon: 'error',
                    confirmButtonText: '{{ __("general.ok") }}',
                    confirmButtonColor: '#dc3545'
                });
            })
            .finally(() => {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            });
        });
    } else {
        console.error('Contact form not found!');
        alert('{{ __("general.contact_form_not_found") }}');
    }
});

console.log('Contact form script loaded successfully');
</script>
@endsection
