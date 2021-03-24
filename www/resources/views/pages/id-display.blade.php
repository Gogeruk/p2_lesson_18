@extends('layout')

@section('id-display')
<div class="m-12 border border-danger">
    <div class="form-group row mb-4">
        <div class="m-3">
            @guest
                <p class="mb-3 text-left">You are not loged in.</p>
                <p class="mb-3 text-left">Please login to view the ads.</p>
            @endguest
            @auth
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Author name</th>
                        <th scope="col">Date of creation</th>
                        <th class="col-2 text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $ad->title }}</td>
                        <td>{{ $ad->description }}</td>
                        <td>{{ $ad->user->name }}</td>
                        <td>{{ date("F jS, Y", strtotime($ad->created_at)) }}<br><br>{{ $ad->created_at->diffforhumans() }}</td>
                        <td class="col-2 text-center">
                        @canany(['update', 'delete'], $ad)
                            <button onclick="location.href='{{ route('delete', $ad->id) }}'" type="submit" class="btn btn-danger btn-sm" name="button">Delete</button><br><br>
                            <button onclick="location.href='{{ route('update_an_ad', $ad->id) }}'" type="submit" class="btn btn-danger btn-sm" name="button">Edit</button><br><br>
                        @endcanany
                    </td>
                </tr>
            </tbody>
            @if ($message = Session::get('status'))
                <p class="text-center mb-12"><strong>{{ $message }}</strong></p>
            @endif
            @endauth
        </div>
    </div>
</div>
@endsection
