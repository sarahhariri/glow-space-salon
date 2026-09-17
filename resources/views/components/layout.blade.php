@props([
    'settings' => null,
    'hideFooter' =>false,
])
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> {{$title}} | Glow Space</title>
    <link href="{{ asset('assets/css/index.css') }}" rel="stylesheet" /> 
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"  rel="stylesheet"  />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link rel="stylesheet" href="{{asset('/assets/css/index.css')}}" />
   
</head>

<body
data-bs-spy="scroll" data-bs-target="#mainNavbar" data-bs-offset="100" tabindex="0"
>

<x-navbar/>



    {{$slot}}

@if(!$hideFooter)
<x-footer :settings="$settings"/>

@endif
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>