<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    public function login()
    {
        $queries = http_build_query([
            // HAPUS kode contoh di bawah dan PASTE Client ID asli dari Spotify Dashboard kamu
            'client_id' => '66828cce198e45ada684553441ed0ba7',
            'response_type' => 'code',
            'redirect_uri' => 'https://wen-puristical-muscly.ngrok-free.dev/callback',
            'scope' => 'user-top-read user-read-recently-played',
        ]);

        return redirect('https://accounts.spotify.com/authorize?' . $queries);
    }

    public function callback(Request $request)
    {
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => 'https://wen-puristical-muscly.ngrok-free.dev/callback',
            'client_id' => '66828cce198e45ada684553441ed0ba7', // Samakan dengan yang di atas
            'client_secret' => '8530fc611979422bb0b84d7a4c8de48a', // Wajib diisi yang asli
        ]);

        $data = $response->json();

        // Tambahkan pengecekan ini agar tidak error lagi
        if (isset($data['access_token'])) {
            session(['spotify_token' => $data['access_token']]);
            return redirect('/dashboard');
        }

        return "Gagal mendapatkan token: " . ($data['error_description'] ?? 'Error tidak diketahui');
    }

    public function index()    {
        $token = session('spotify_token');

        // Ambil Top Tracks (Lagu Teratas)
        $topResponse = Http::withToken($token)
            ->get('https://api.spotify.com/v1/me/top/tracks', ['limit' => 6]);

        // Ambil Recently Played (Baru Diputar)
        $recentResponse = Http::withToken($token)
            ->get('http://googleusercontent.com/spotify.com/4', ['limit' => 6]);

        $tracks = $topResponse->json()['items'] ?? [];
        $recentTracks = $recentResponse->json()['items'] ?? [];

        return view('dashboard', compact('tracks', 'recentTracks'));    }
}