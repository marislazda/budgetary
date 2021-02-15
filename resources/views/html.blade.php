
<!DOCTYPE html>
<html lang="lv">
<head>
    <title>Rēķini</title>
    <meta charset="utf-8">
    <link href="{{ asset('css/public.css') }}?ver={{ filemtime(public_path('css/public.css')) }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    @if($errors->any())
        <div style="background: red; padding: 20px; color: white; margin: 0 auto;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @yield('content')
</body>
</html>
