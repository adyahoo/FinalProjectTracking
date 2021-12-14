@props(['status'])

@if (Session::has('error'))
    <div {{ $attributes->merge(['class' => 'font-medium text-center text-sm text-red-600']) }}>
        {!! Session::get('error') !!}
    </div>
@elseif (Session::has('success'))
    <div {{ $attributes->merge(['class' => 'font-medium text-center text-sm text-green-600']) }}>
        {!! Session::get('success') !!}
    </div>
@endif
