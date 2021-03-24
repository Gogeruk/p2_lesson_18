@extends('layout')

@section('profile')
<div class="mb-12 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3">
            <p>{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
            <button onclick="location.href='{{ route('home') }}'" type="submit" class="btn btn-sm btn-danger mb-12" name="button">CHANGE PASSWORD P̶R̶O̶O̶F̶ ̶O̶F̶ ̶C̶O̶N̶C̶E̶P̶T̶</button>
        </div>
    </div>
</div>
@endsection
