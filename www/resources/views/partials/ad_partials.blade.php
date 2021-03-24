@if ($loop->first)
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Author name</th>
                <th scope="col">Creation date</th>
                <th class="col-2 text-center" scope="col"></th>
            </tr>
        </thead>
@endif
    <tbody>
        <tr>
            <td><a class="text-danger" href="{{ route('show_an_ad_by_id', $ad->id) }}">{{ $ad->title }}</a></td>
            <td>{{ $ad->description }}</td>
            <td>{{ $ad->user->name }}</td>
            <td>{{ date("F jS, Y", strtotime($ad->created_at)) }}<br><br>{{ $ad->created_at->diffforhumans() }}</td>
            <td class="col-2 text-center">
                <button wire:click="like" class="btn btn-info btn-sm">Like Ad</button>
                @canany(['update', 'delete'], $ad)
                    <button onclick="location.href='{{ route('delete', $ad->id) }}'" type="submit" class="btn btn-danger btn-sm" name="button">Delete</button><br><br>
                    <button onclick="location.href='{{ route('update_an_ad', $ad->id) }}'" type="submit" class="btn btn-danger btn-sm" name="button">Edit</button><br><br>
                @endcanany
            </td>
        </tr>
    </tbody>
@if ($loop->last)
    </table>
@endif
