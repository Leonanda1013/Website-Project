<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Livewire Playground</title>
    @livewireStyles
</head>
<body>
    {{ $slot ?? '' }}
    @livewireScripts
</body>
</html>

