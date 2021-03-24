@include('partials.layout-statt')
            <div class="m-12 border border-danger">
                <div class="form-group row mb-4">
                    <div class="m-3">
                            @forelse ($ads as $ad)
                                @include('partials.ad_partials', ['ad' => $ad])
                                @empty
                                    <p class="m-3 text-center">There are currently bo ads.</p>
                            @endforelse
                        <div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mb-2" role="group" aria-label="First group">
                                @include('pagination.pagination', ['pagination_of' => Session::get('pagination_of')])
                                @auth
                                    <div class="m-12">
                                        <button onclick="location.href='{{ route('create_a_new_ad') }}'" type="submit" class="btn-lr btn btn-danger" name="button">Create a new ad</button>
                                    </div>
                                @endauth
                            </div>
                        </div>
                        @if ($message = Session::get('status'))
                            <p class="text-center mb-12"><strong>{{ $message }}</strong></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    @include('scripts.js.iconDisplay')
    @stack('scripts')
    @livewireScripts
</body>
</html>
