<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


            <div
                class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 rounded-3xl shadow-2xl p-16 md:p-24 mb-12 text-center">
                <h1 class="font-extrabold tracking-wide leading-tight text-gray-900" style="font-size: 5rem;">
                    Welcome, {{ strtoupper(Auth::user()->name) }}
                </h1>
            </div>

            <div class="mt-4">

                <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition"
                    style="display: flex; flex-direction: :row;">
                    <h3 class="text-3xl font-bold text-bg-dark mb-4">User ID:</h3>
                    <p class="text-3xl font-semibold text-gray-800 ml-4">
                        {{ Auth::user()->id }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition"
                    style="display: flex; flex-direction: :row;">
                    <h3 class="text-3xl font-bold text-bg-dark mb-4">Email:</h3>
                    <p class="text-xl font-semibold text-gray-700 break-all mt-1 ml-4">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition"
                    style="display: flex; flex-direction: :row;">
                    <h3 class="text-3xl font-bold text-bg-dark mb-4">Phone:</h3>
                    <p class="text-3xl font-semibold text-gray-800 ml-4">
                        {{ Auth::user()->phone }}
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition"
                    style="display: flex; flex-direction: :row;">
                    <h3 class="text-3xl font-bold text-bg-dark mb-4">Age:</h3>
                    <p class="text-3xl font-semibold text-gray-800 ml-4">
                        {{ Auth::user()->age }}
                    </p>
                </div>

                @role('superadmin')
                <div class="bg-white shadow rounded-lg p-4 mt-4">
                    <h2 class="text-xl font-bold mb-3">Notifications</h2>

                    @foreach(auth()->user()->notifications as $notification)
                        <div class="p-3 border-b">
                            <p>{{ $notification->data['message'] }}</p>
                        </div>
                    @endforeach
                </div>
                @endrole

            </div>
        </div>
    </div>
</x-app-layout>