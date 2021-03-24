<!-- title  -->
<label for="title" class="col-sm-12 col-form-label">Title</label>
<div class="col-sm-10">
    <input type="text" name="title" class="form-control mb-3" id="title" placeholder="your title" value="{{ old('title', $ad->title ?? null) }}">
</div>
@if($errors->has('title'))
    <div class="alert alert-danger mb-3" role="alert">
        {{ $errors->get('title')[0] }}
    </div>
@endif

<!-- description  -->
<label for="description" class="col-sm-12 col-form-label">Description</label>
<div class="col-sm-10">
    <input type="text" name="description" class="form-control mb-3" id="description" placeholder="your description" value="{{ old('description', $ad->description ?? null) }}">
</div>
@if($errors->has('description'))
    <div class="alert alert-danger mb-3" role="alert">
        {{ $errors->get('description')[0] }}
    </div>
@endif

<!-- user_id  -->
<input type="hidden" name="user_id" id="description" value="{{ Auth::user()->id ?? null }}">
