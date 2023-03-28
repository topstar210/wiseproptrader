<div class="dropdown">
<button class="btn btn-secondary dropdown-toggle" style="width: 120px;" type="button" data-toggle="dropdown" aria-expanded="false">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
            {{ $locale_name }}
        @endif
    @endforeach
</button>
<div class="dropdown-menu">
    @foreach($available_locales as $locale_name => $available_locale)
    <a class="dropdown-item" style="color: #000;" href="language/{{ $available_locale }}">
        <span>{{ $locale_name }}</span>
    </a>
    @endforeach
</div>
</div>