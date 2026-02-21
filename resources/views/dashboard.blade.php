<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#121212] text-white font-sans antialiased">
    <div class="max-w-6xl mx-auto p-8">
        <header class="flex justify-between items-center mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-[#1DB954]">Marrr Spotify Stats 🎧</h1>
            <div class="bg-[#282828] px-4 py-2 rounded-full text-sm font-bold border border-zinc-700">
                Connected via Laravel
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($tracks as $index => $track)
        <div class="bg-[#181818] p-5 rounded-xl hover:bg-[#282828] transition-all duration-300 group shadow-xl">
            <div class="relative overflow-hidden rounded-lg mb-4">
                <img src="{{ $track['album']['images'][0]['url'] }}" alt="Album Art" class="w-full aspect-square object-cover transform group-hover:scale-105 transition duration-500">
                <div class="absolute bottom-2 right-2 bg-[#1DB954] p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.333-5.89a1.5 1.5 0 000-2.538L6.3 2.841z"></path></svg>
                </div>
            </div>
            <div>
                <h3 class="font-bold text-lg truncate mb-1">{{ $track['name'] }}</h3>
                <p class="text-zinc-400 text-sm font-medium">{{ $track['artists'][0]['name'] }}</p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-xs bg-zinc-800 text-zinc-400 px-2 py-1 rounded">#{{ $index + 1 }} Top Track</span>
                </div>
            </div>
        </div>
    @endforeach 
</div> <header class="flex justify-between items-center mb-8 mt-20">
    <h2 class="text-3xl font-bold text-white">Recently Played 🕒</h2>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($recentTracks as $recent)
        <div class="bg-[#181818] p-5 rounded-xl hover:bg-[#282828] transition-all duration-300 group shadow-xl flex items-center gap-4">
            <img src="{{ $recent['track']['album']['images'][0]['url'] }}" alt="Album Art" class="w-16 h-16 rounded shadow-md object-cover">
            
            <div class="overflow-hidden">
                <h3 class="font-bold text-base truncate">{{ $recent['track']['name'] }}</h3>
                <p class="text-zinc-400 text-xs truncate">{{ $recent['track']['artists'][0]['name'] }}</p>
                <p class="text-zinc-500 text-[10px] mt-1 italic">
                    Played: {{ \Carbon\Carbon::parse($recent['played_at'])->diffForHumans() }}
                </p>
            </div>
        </div>
    @endforeach
</div> <footer class="mt-20 pt-8 border-t border-zinc-800 text-center">
    <p class="text-zinc-500 text-sm">Data fetched from Spotify Web API • Built with Laravel 8 & Tailwind By Maria Esperansa</p>
</footer>