@php
    $kicker = $kicker ?? '';
    $title = $title ?? '';
    $description = $description ?? null;
@endphp

<div class="home-section-heading">
    <span class="home-section-kicker">{{ $kicker }}</span>
    <h2>{{ $title }}</h2>
    @if ($description)
        <p>{{ $description }}</p>
    @endif
</div>
