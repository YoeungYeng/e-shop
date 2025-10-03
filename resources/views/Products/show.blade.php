<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .swiper-wrapper {
            width: 80%;
            height: max-content !important;
            padding-bottom: 100px !important;
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }

        .swiper-pagination-bullet {
            background: #4F46E5;
        }

        .swiper-pagination-bullet-active {
            background: #4F46E5 !important;
        }
    </style>

</head>

<body>
    <x-header>
        <nav class="flex justify-between  gap-4 px-6 py-2 rounded-lg mt-3">
            {{-- logo --}}
            <div class="flex gap-4 items-center">
                <img src="{{ asset('images/logo-icon.jpg') }}" alt="">

                {{-- static navbar --}}
                <x-nav-link href="/">
                    Home
                </x-nav-link>
                <x-nav-link href="/contact">
                    Contact
                </x-nav-link>

                <x-nav-link href="/about">
                    About
                </x-nav-link>
            </div>

            {{-- icons --}}
            <div class="flex gap-4 items-center ">
                {{-- search --}}
                <x-search-button>
                    Search
                </x-search-button>

                {{-- cart favorite --}}
                <span class="text-xl cursor-pointer hover:text-red-500">
                    <i class="fa-regular fa-heart"></i>
                </span>
                <button id="multiLevelDropdownButton" data-dropdown-toggle="multi-dropdown"
                    class="text-gray-700 relative top-0 right-0  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center "
                    type="button">
                    <span class="text-xl cursor-pointer hover:text-red-500 ">
                        <i class="fa-solid fa-cart-shopping "></i> <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full">
                            {{ count((array) session('cart')) }}
                        </span>
                    </span>
                </button>

                <!-- Dropdown menu -->
                <div id="multi-dropdown"
                    class="z-10 hidden p-2 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-96 h-[500px] overflow-y-auto dark:bg-gray-700">
                    <ul class="py-2 gap-4 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="multiLevelDropdownButton">
                        <div class="flex justify-between px-4">
                            <div>
                                <span class="text-xl relative top-0 right-0">
                                    <i class="fa-solid fa-cart-shopping "></i>
                                    <span
                                        class="absolute -top-1 -right-3 bg-red-600 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full">{{ count((array) session('cart')) }}</span>
                                </span>
                            </div>
                            <div>
                                @php $total = 0 @endphp
                                @foreach ((array) session('cart') as $id => $details)
                                    @php $total += $details['sale_price'] * $details['quantity'] @endphp
                                @endforeach
                                <h4 class="font-bold text-2xl text-white">
                                    Total: <span>${{ $total }} </span>
                                </h4>
                            </div>
                        </div>
                        {{-- image, title, price & quality --}}
                        <div class="flex gap-4 p-4 justify-start items-start">
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                    <div>
                                        {{-- image --}}
                                        <img class="w-32 h-32 object-cover rounded-lg"
                                            src="{{ \Illuminate\Support\Facades\Storage::url($details['image']) }}"
                                            alt="{{ $details['name'] }}">
                                    </div>
                                    <div>

                                        <h3 class="text-lg text-gray-100 font-bold"> {{ $details['name'] }} </h3>
                                        <h4 class="text-sm text-gray-100 font-medium"> Price:
                                            ${{ $details['sale_price'] }}
                                        </h4>
                                        <h4 class="text-sm text-gray-100 font-medium"> Quality:
                                            {{ $details['quantity'] }} </h4>
                                @endforeach
                            @endif
                            <a href="{{ route('cart') }}">
                                <button
                                    class="mt-2 mx-auto text-white w-[200px] bg-red-600 hover:bg-red-500 duration-500 transition-all px-6 py-2 rounded-full">
                                    View All
                                </button>
                            </a>
                        </div>
                </div>



                </ul>

                </div>

            {{-- user --}}
            <span class="text-xl cursor-pointer hover:text-red-500">
                <a href="{{ route('register') }}">
                    <i class="fa-regular fa-user"></i>
                </a>
            </span>
            </div>

        </nav>
    </x-header>
    <section class="w-[80%] h-auto mx-auto mt-32 mb-6">
        <h4>
            Account / Gaming/ {{ $product->name }}
        </h4>
        {{-- show image in this --}}
        <div class="flex items-start gap-4">
            <div class="w-[50%]">
                {{-- image --}}
                <img class="rounded-lg" src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}"
                    alt="">
            </div>
            <div class="w-[50%]">
                {{-- show information --}}
                <h3 class="text-2xl font-bold"> {{ $product->name }} </h3>
                <h4 class="text-xl"> ${{ $product->sale_price }} </h4>
                <p>
                    {{ \Illuminate\Support\Str::limit($product->description, 400) }}
                </p>
                <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

                <div class="flex items-center gap-4">
                    {{-- Add to cart --}}

                    <a href="{{ route('cart.add', $product->id) }}">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Add To Cart
                        </button>
                    </a>
                </div>


            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>



</html>
