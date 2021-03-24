@extends('layout')

@section('form-login')
<div class="mb-12 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3">
            <p class="mb-3 text-center">Login</p>
            <form class="m-3" action="" method="post">
                @csrf
                @include('partials.login_particls')
                <div class="mb-3 text-left">
                    <button type="submit" class="btn btn-danger" id="button1" name="submit1">submit</button>
                    <button onclick="location.href='{{ route('oauthCallback') }}'" type="button" class="btn m-2 btn-danger" id="button2" name="submit2"><img src="{{asset('/css/png/002-github.png')}}"></button>
                    <button onclick="location.href='{{ route('oauthRedditCallback') }}'" type="button" class="btn m-2 btn-danger" id="button2" name="submit2"><img src="{{asset('/css/png/001-reddit.png')}}"></button>
                    @if($errors->has('fail'))
                        <div class="alert alert-danger mb-3" role="alert">
                            {{ $errors->get('fail')[0] }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
