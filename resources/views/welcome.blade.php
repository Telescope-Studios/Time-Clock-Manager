<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @if (Route::has('login'))
                @auth
                <meta http-equiv="refresh" content="0; url={{ url('/home') }}">
                <script type="text/javascript">
                    window.location.href = "{{ url('/home') }}"
                </script>
                @else
                <meta http-equiv="refresh" content="0; url={{ route('login') }}">
                <script type="text/javascript">
                    window.location.href = "{{ route('login') }}"
                </script>
                    <a href="{{ route('login') }}">Login</a>
                @endauth
        @endif
    </head>
</html>
