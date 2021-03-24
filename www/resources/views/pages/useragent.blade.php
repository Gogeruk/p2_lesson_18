@extends('layout')

@section('useragent')
<div class="mb-12 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3">
            <div class="m-3">
                <p class="mb-12">Your browser is: {{ $useragent['browser'] ?? '???' }}</p>
                <p class="mb-12">Your OS is: {{ $useragent['os'] ?? '???' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
