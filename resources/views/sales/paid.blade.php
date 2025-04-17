@extends('layouts.app')

@section('content')
    @push('page_css')
        <link rel="stylesheet" href="{{asset('css/repair-add.css')}}">
    @endpush
    <div class="content p-3">
        @include('sales.paid_button')
    </div>
@endsection
