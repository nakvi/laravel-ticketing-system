{{-- <script>
    // Disable right-click
    document.addEventListener('contextmenu', event => event.preventDefault());

    // Disable F12, Ctrl+Shift+I/J, Ctrl+U
    document.onkeydown = function(e) {
        if (e.keyCode == 123) { // F12
            return false;
        }
        if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'J'.charCodeAt(0))) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    };
</script> --}}
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}" ></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}" ></script>
<script src="{{ URL::asset('build/js/plugins.js') }}" ></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

@yield('script')
@yield('script-bottom')