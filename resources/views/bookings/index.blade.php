@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

<style>
    #inline-calendar {
        width: 420px;
        max-width: 100%;
        font-size: 1.2rem;
    }
    .flatpickr-day {
        height: 3rem;
        line-height: 3rem;
        width: 3rem;
        margin: 0.15rem;
        font-size: 1.1rem;
    }
    .flatpickr-time input {
        font-size: 1.1rem;
        width: 3.5rem;
        height: 2.5rem;
        padding: 0.25rem 0.5rem;
    }
    .flatpickr-prev-month,
    .flatpickr-next-month {
        height: 2.5rem;
        width: 2.5rem;
    }
</style>

<div class="bg-gradient-to-br from-[#e0dfff] via-[#d8e9f4] to-[#bcd9ea] py-10 min-h-screen overflow-y-auto">
    <div class="max-w-3xl mx-auto space-y-10 px-4">

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow-md border border-green-300 text-center">
                {{ session('success') }}
            </div>
        @endif

        <section aria-labelledby="booking-form-heading" class="bg-white/60 backdrop-blur-lg shadow-2xl rounded-2xl p-8 border border-blue-200">
            <h2 id="booking-form-heading" class="text-3xl font-bold mb-8 text-blue-800 text-center">
                Create a Booking
            </h2>

            <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-blue-700">Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title') }}"
                        required
                        class="w-full mt-1 border border-blue-300 bg-white text-blue-900 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400" 
                    />
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-blue-700">Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="3"
                        required
                        class="w-full mt-1 border border-blue-300 bg-white text-blue-900 rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" />

                <div>
                    <label for="inline-calendar" class="block text-sm font-medium text-blue-700 mb-2">Booking Date & Time</label>
                    <div id="inline-calendar" class="rounded-md border border-blue-200 bg-white/70 p-4"></div>
                    <p class="text-blue-600 text-xs mt-2">Select your booking date and time.</p>
                    @error('booking_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 text-center">
                    <button type="submit" class="bg-blue-500 text-white py-3 px-8 rounded-full hover:bg-blue-600 transition font-semibold text-lg">
                        Create Booking
                    </button>
                </div>
            </form>
        </section>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const bookedDates = @json($bookedDates);
    const hiddenInput = document.getElementById("booking_date");

    flatpickr("#inline-calendar", {
        inline: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        disable: bookedDates,
        time_24hr: false,
        defaultDate: hiddenInput.value || null,
        onChange: function(selectedDates, dateStr) {
            hiddenInput.value = dateStr;
        }
    });
</script>
@endsection
