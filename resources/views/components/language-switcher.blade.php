<div class="language-switcher">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" 
                data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-globe"></i>
            @if(app()->getLocale() == 'ar')
                العربية
            @else
                English
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            <li>
                <form action="{{ route('language.switch') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="lang" value="ar">
                    <button type="submit" class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}">
                        <i class="fas fa-check me-2" style="{{ app()->getLocale() == 'ar' ? '' : 'visibility: hidden;' }}"></i>
                        العربية
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route('language.switch') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="lang" value="en">
                    <button type="submit" class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        <i class="fas fa-check me-2" style="{{ app()->getLocale() == 'en' ? '' : 'visibility: hidden;' }}"></i>
                        English
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
.language-switcher .dropdown-item {
    background: none;
    border: none;
    width: 100%;
    text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
    padding: 0.375rem 1rem;
}

.language-switcher .dropdown-item:hover {
    background-color: #f8f9fa;
}

.language-switcher .dropdown-item.active {
    background-color: #e9ecef;
    font-weight: bold;
}

.language-switcher .btn {
    direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};
}
</style>
