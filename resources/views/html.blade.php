
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
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
