@php $title = 'Usuarios'; @endphp

<x-layouts::admin :title="$title">

    {{-- Page Title --}}
    <div class="mb-8">
        <h1 class="text-3xl font-semibold tracking-wide text-base-content">Usuarios</h1>
    </div>

    {{-- Flash alerts --}}
    @if (session('success'))
    <div role="alert" class="alert alert-success mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if (session('error'))
    <div role="alert" class="alert alert-error mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @livewire('admin.users-table')

</x-layouts::admin>
