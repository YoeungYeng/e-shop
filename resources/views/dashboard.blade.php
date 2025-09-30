<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-7 mb-7">
                    {{-- category box --}}
                    <div class="w-[300px] h-[150px] bg-white shadow rounded-xl flex flex-col justify-between p-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-700">
                                Category
                            </h4>
                            <hr class="my-2 border-gray-300">
                        </div>

                        <h1 class="text-4xl font-bold text-center text-gray-800">
                            {{ $categories }}
                        </h1>
                    </div>
                    {{--product--}}
                    <div class="w-[300px] h-[150px] bg-white shadow rounded-xl flex flex-col justify-between p-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-700">
                                Products
                            </h4>
                            <hr class="my-2 border-gray-300">
                        </div>

                        <h1 class="text-4xl font-bold text-center text-gray-800">
                            {{ $products }}
                        </h1>
                    </div>
                    <div class="w-[300px] h-[150px] bg-white shadow rounded-xl flex flex-col justify-between p-4">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-700">
                                Users
                            </h4>
                            <hr class="my-2 border-gray-300">
                        </div>

                        <h1 class="text-4xl font-bold text-center text-gray-800">
                            {{ $users }}
                        </h1>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <x-Footers />
</x-app-layout>
