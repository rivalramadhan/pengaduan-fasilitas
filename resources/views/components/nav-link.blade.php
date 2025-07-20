{{-- resources/views/components/admin/nav-link.blade.php --}}
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 bg-gray-900 text-white rounded-md'
            : 'flex items-center p-2 text-gray-400 hover:bg-gray-700 hover:text-white rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>