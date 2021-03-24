@extends('layout')

@section('ip-lookup')
<div class="mb-12 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3">
            <form class="m-3" action="" method="post">
                @csrf
                <label class="mb-12" for="ipAdress">IP</label>
                <input type="text" name="ipAdress" class="form-control mb-3" id="ipAdress" placeholder="ipAdress" value="{{ old('ipAdress', $ipAdress ?? null) }}">
                <button type="submit" class="btn btn-sm btn-danger mb-12" id="submit" name="submit">LOOK UP THIS IP</button>
                @if($errors->has('ipAdress'))
                    <div class="alert alert-danger mb-3" role="alert">
                        {{ $errors->get('ipAdress')[0] }}
                    </div>
                @endif
            </form>
            <div class="m-3">
                <a href="https://whatismyipaddress.com/" class="mb-12 border border-danger">My IP</a>
                @if($ipInfo ?? '' != null)
                    <p class="mb-12">The Isocode and continent code of {{ $ipAdress }} are {{ $ipInfo['isoCode'] }} and {{ $ipInfo['continentCode'] }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
