@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert']) }} role="alert">
        {{ $status }}
    </div>
@endif
