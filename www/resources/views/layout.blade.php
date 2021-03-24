<!doctype html>
@include('partials.layout-statt')
                @yield('home-display')
                @yield('id-display')
                @yield('form-ad')
                @yield('form-login')
                @yield('profile')
                @yield('ip-lookup')
                @yield('useragent')
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        @include('scripts.js.iconDisplay')
        @stack('scripts')
        @livewireScripts
    </body>
</html>
