{{-- resources/views/components/card.blade.php --}}
@props(['title', 'value', 'linkUrl', 'backgroundColor' => 'bg-primary'])

<div class="card {{ $backgroundColor }} p-3">
    <a href="{{ $linkUrl }}">
        <h6 class="text-white mb-2 p-0 m-0 fw-normal">{{ $title }}</h6>
        <h1 class="text-white display-6 fw-bold p-0 m-0">{{ $value }}</h1>
    </a>
</div>
