@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<div x-data="{ showBookings: false }" class="min-h-screen bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-10 px-4 sm:px-6 lg:px-8 overflow-y-auto">
    <div class="max-w-4xl mx-auto space-y-8">

        <!-- Success message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl shadow-md border border-green-300 text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="bg-white/30 backdrop-blur-lg rounded-2xl p-8 border border-teal-300 shadow-lg">
            <h3 class="text-3xl font-semibold text-[#334188] drop-shadow-md">Welcome, {{ Auth::user()->name }}!</h3>
            <p class="text-[#4a5c7a] mt-2 text-lg">Here’s your personalized dashboard summary:</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- Total Bookings (click to toggle bookings list) -->
            <div 
                @click="showBookings = !showBookings" 
                class="bg-white/60 backdrop-blur-md border-l-4 border-teal-500 shadow-lg p-6 rounded-2xl cursor-pointer hover:bg-white/80 transition"
                title="Click to toggle your bookings"
                role="button" tabindex="0"
                @keydown.enter.prevent="showBookings = !showBookings"
                @keydown.space.prevent="showBookings = !showBookings"
            >
                <h4 class="text-teal-700 font-semibold text-xl">Total Bookings</h4>
                <p class="text-4xl font-bold text-teal-600 mt-2">{{ $totalBookings }}</p>
            </div>

            <!-- Total Users (Clickable Card without list) -->
            <a href="{{ route('users.index') }}" class="block group" title="View all users">
                <div class="bg-white/60 backdrop-blur-md border-l-4 border-indigo-500 shadow-lg p-6 rounded-2xl hover:bg-white/80 transition cursor-pointer">
                    <h4 class="text-indigo-700 font-semibold text-xl group-hover:text-indigo-900">Total Users</h4>
                    <p class="text-4xl font-bold text-indigo-600 group-hover:text-indigo-800">{{ $totalUsers }}</p>
                </div>
            </a>
        </div>

        <!-- Booking List: Hidden initially -->
        <div
            x-show="showBookings"
            x-transition
            class="bg-white/40 backdrop-blur-lg shadow-xl rounded-2xl p-8 border border-indigo-300 mt-6"
            style="display: none;"
        >
            <h3 class="text-2xl font-semibold text-indigo-700 mb-6">Your Bookings</h3>

            @if ($bookings->count())
                <div class="space-y-5">
                    @foreach ($bookings as $booking)
                        <div class="bg-white rounded-xl p-5 border border-indigo-200 shadow hover:shadow-xl transition duration-300">
                            <h4 class="text-lg font-semibold text-indigo-800">{{ $booking->title }}</h4>
                            <p class="text-indigo-700 text-sm mt-1">{{ $booking->description }}</p>
                            <p class="text-xs text-indigo-500 mt-3">
                                📅 {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y h:i A') }}
                            </p>

                            <div class="mt-4 flex space-x-6">
                                <a href="{{ route('bookings.edit', $booking->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-semibold underline"
                                >
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this booking?');"
                                      class="inline"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-indigo-600 italic text-sm">You don’t have any bookings yet.</p>
            @endif
        </div>

    </div>
</div>
@endsection
