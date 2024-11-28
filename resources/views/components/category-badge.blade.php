@props(['category'])

@php
$color = match($category) {
    'trabajo' => 'primary',
    'personal' => 'success',
    'ideas' => 'secondary',
    default => 'warning',
};
@endphp

<span class="badge bg-{{ $color }} rounded-pill">
    <i class="bi bi-folder"></i>
    {{ ucfirst($category) }}
</span>
