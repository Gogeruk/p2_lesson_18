@extends('layout')

@section('form-ad')
<div class="m-3 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3">
            <p class="m-3 text-center">Ad form</p>
            <form class="m-3" action="" method="post">
                @csrf
                @include('partials.form_partials')
                <div class="m-3 text-center">
                    @if($editing == 'not_editing')
                        <button type="submit" class="btn btn-danger" id="button" name="submit">create</button>
                    @else
                        <button type="submit" class="btn btn-danger" id="button" name="submit">save</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
