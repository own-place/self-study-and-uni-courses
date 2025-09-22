<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:grid lg:grid-cols-3 lg:gap-10 m-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-purple-500 to-purple-700 shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-center mb-4 text-white border-4 border-purple-600">
                    <div class="text-center px-6">
                        <h2 class="text-2xl font-bold">Welcome, <em>{{ Auth::user()->first_name }}!</em></h2>
                        <p class="mt-2">Good job with keeping this portal up to date, HR team!</p>
                    </div>
                    <div class="mt-4 mix-blend-luminosity">
                        <img src="{{ asset('images/LP_main_photo.png') }}" alt="Welcome Image" class="h-48 object-cover">
                    </div>
                </div>

                <!-- Statistics -->
                <x-statistics-numbers gridClass="cols"/>

                <x-quote-of-the-day/>
            </div>

            <!-- Calendar Section -->
            <div class="flex flex-col w-full lg:w-auto rounded-lg">
                <x-calendar></x-calendar>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
