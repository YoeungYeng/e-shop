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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

                    {{-- Header: Cart icon & total --}}
                    <div class="flex justify-between items-center px-4 py-2">
                        <div class="relative">
                            <i class="fa-solid fa-cart-shopping text-xl text-gray-800 dark:text-gray-200"></i>
                            <span
                                class="absolute -top-2 -right-3 bg-red-600 text-white text-xs w-5 h-5 flex justify-center items-center rounded-full">
                                {{ count((array) session('cart')) }}
                            </span>
                        </div>

                        <div>
                            @php $total = 0; @endphp
                            @foreach ((array) session('cart') as $id => $details)
                                @php $total += $details['sale_price'] * $details['quantity']; @endphp
                            @endforeach
                            <h4 class="font-bold text-lg text-gray-900 dark:text-white">
                                Total: <span class="text-red-600">${{ $total }}</span>
                            </h4>
                        </div>
                    </div>

                    {{-- Cart Items --}}
                    <div class="divide-y divide-gray-200 dark:divide-gray-600">
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                <div class="flex gap-4 p-4 items-center">
                                    <img class="w-20 h-20 object-cover rounded-lg"
                                        src="{{ \Illuminate\Support\Facades\Storage::url($details['image']) }}"
                                        alt="{{ $details['name'] }}">

                                    <div class="flex flex-col">
                                        <h3 class="text-base text-gray-900 dark:text-gray-100 font-bold">
                                            {{ $details['name'] }}
                                        </h3>
                                        <h4 class="text-sm text-gray-700 dark:text-gray-300">
                                            Price: ${{ $details['sale_price'] }}
                                        </h4>
                                        <h4 class="text-sm text-gray-700 dark:text-gray-300">
                                            Quantity: {{ $details['quantity'] }}
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="p-4 text-gray-500 dark:text-gray-400 text-sm">Your cart is empty.</p>
                        @endif
                    </div>

                    {{-- Footer: View All --}}
                    <div class="p-4 text-center">
                        <a href="{{ route('cart') }}">
                            <button
                                class="text-white w-full bg-red-600 hover:bg-red-500 duration-300 px-6 py-2 rounded-full">
                                View All
                            </button>
                        </a>
                    </div>
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


    <div class="w-[80%] mx-auto flex items-start justify-between gap-4">
        {{-- aside --}}
        <aside class="w-[20%]">
            <div class="flex justify-start shadow py-6 px-2">
                <ul>
                    @forelse($categories as $category)
                        <li class="hover:underline duration-300 transition-all">
                            <a href="#">{{ $category->name }}</a>
                        </li>
                    @empty
                        <li>
                            <p>No category</p>
                        </li>
                    @endforelse
                </ul>
            </div>

        </aside>
        {{-- auto slide --}}
        <section class="w-[80%]">
            <div class="relative">
                <!-- Swiper -->
                <div class="swiper default-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class=" rounded-2xl h-96 flex justify-center items-center">
                                <span class="text-3xl font-semibold text-indigo-600">
                                    <img src="{{ asset('images/Hero_Banner.jpg') }}" alt="image">
                                </span>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="rounded-2xl h-96 flex justify-center items-center">
                                <img src="{{ asset('images/Banner-2-BG.jpg') }}" alt="image">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="rounded-2xl h-96 flex justify-center items-center">
                                <img src="{{ asset('images/Group-8049.jpg') }}" alt="image">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation buttons -->
                    <button id="slider-button-left"
                        class="swiper-button-prev group !p-2 flex justify-center items-center border border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full top-1/2 -translate-y-1/2 left-5 hover:bg-indigo-600 absolute z-10">
                        <svg class="h-5 w-5 text-indigo-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 16 16">
                            <path d="M10 12L6 8l4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <button id="slider-button-right"
                        class="swiper-button-next group !p-2 flex justify-center items-center border border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full top-1/2 -translate-y-1/2 right-5 hover:bg-indigo-600 absolute z-10">
                        <svg class="h-5 w-5 text-indigo-600 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 16 16">
                            <path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>


    </div>

    {{-- featch of products --}}
    <section class="w-[80%] mt-6  mx-auto flex flex-col shadow mb-6">
        <h3 class="underline text-xl text-red-600 px-2">
            Today's
        </h3>
        <div class="text-center flex gap-6 items-center">
        </div>
        <!--HTML CODE-->
        <div class="w-full relative">
            @if ($products->isNotEmpty())
                <div class="swiper centered-slide-carousel swiper-container relative">
                    <div class="swiper-wrapper">
                        @foreach ($products as $product)
                            <div class="swiper-slide">
                                <div class="rounded-lg h-64 flex flex-col">
                                    <div class="flex flex-col items-center p-4 ">
                                        {{-- Product image --}}
                                        <a href="/singleproduct/{{ $product->id }}">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}"
                                                class="rounded-lg mb-2 w-full h-[200px] object-contain"
                                                alt="{{ $product->name }}">
                                        </a>

                                        {{-- Add to Cart --}}


                                        {{-- Product title --}}
                                        <h3 class="mt-2 font-semibold text-gray-800">
                                            {{ $product->name }}
                                        </h3>

                                        {{-- Product prices --}}
                                        <p>
                                            <span class="line-through text-gray-500">
                                                ${{ $product->origin_price }}
                                            </span>
                                            <span class="font-bold text-red-600 ml-2">
                                                ${{ $product->sale_price }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination + Navigation --}}
                    <div class="swiper-pagination"></div>
                    <div class="flex items-center justify-center mb-6">
                        <x-primary-button>
                            View all Product
                        </x-primary-button>
                    </div>
                </div>
            @else
                <p class="flex justify-center items-center text-xl py-10">
                    No products available
                </p>
            @endif
        </div>


    </section>
    {{-- brows category --}}
    <section class="w-[80%]  mx-auto flex justify-between items-center shadow mb-10 mt-28">
        <div class="flex gap-4 flex-col w-[30%] p-3">
            <h4 class="text-xl text-green-600 font-bold"> Categories </h4>
            <h2 class="text-4xl font-bold text-gray-700"> Enhance Your </h2>
            <h2 class="text-4xl font-bold text-gray-700"> Music Experience </h2>
            <div id="countdown" class="text-4xl font-mono rounded-full text-center bg-red-600 text-white"></div>
            <button
                class="text-white bg-green-800 hover:bg-green-600 duration-500 transition-all w-44 px-6 py-3 rounded-full">
                Buy Now!
            </button>
        </div>

        <div class="w-[60%] p-4 rounded">
            <img src="{{ asset('images/Hero_Banner.jpg') }}" class="rounded-xl mb-4" alt="">
        </div>
    </section>

    {{-- Explore our Products --}}
    <section class="w-[80%] h-auto flex-col mx-auto flex items-center shadow mb-10 mt-28 p-6 bg-gray-50 rounded-lg">
        <!-- Section Header -->
        <div class="flex flex-col items-start  p-4 rounded-lg mb-8 w-full">
            <h4 class="text-xl underline text-gray-700">Our Products</h4>
            <h2 class="text-4xl font-bold text-gray-700">Explore Our Products</h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full mb-9">
            @forelse($products as $product)
                <div class="rounded-lg shadow hover:shadow-lg transition bg-white flex flex-col items-center p-4">
                    <!-- Product image -->
                    <a href="/singleproduct/{{ $product->id }}">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}"
                            class="rounded-lg mb-2 w-full h-[200px] object-contain" alt="{{ $product->name }}">
                    </a>

                    <!-- Product name -->
                    <h3 class="mt-2 font-semibold text-gray-800 text-lg">
                        {{ $product->name }}
                    </h3>

                    <!-- Prices -->
                    <p class="mt-1">
                        <span class="line-through text-gray-500">${{ $product->origin_price }}</span>
                        <span class="font-bold text-red-600 ml-2">${{ $product->sale_price }}</span>
                    </p>
                </div>
            @empty
                <!-- Empty state -->
                <div class="col-span-full text-center py-10 text-red-500 font-bold">
                    No products available.
                </div>
            @endforelse
        </div>
    </section>


    {{-- footer --}}
    <section class="w-[100%] h-auto  mx-auto shadow mb-10 mt-28 p-6 bg-gray-50 rounded-lg">
        <footer class="bg-white ">
            <div class="mx-auto w-full max-w-screen-xl">
                <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class=" hover:underline">About</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Careers</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Brand Center</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Help center</h2>
                        <ul class="text-gray-500  font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Discord Server</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Twitter</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Facebook</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Legal</h2>
                        <ul class="text-gray-500 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Licensing</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Download</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">iOS</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Android</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Windows</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:underline">MacOS</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="px-4 py-6 bg-gray-100  md:flex md:items-center md:justify-between">
                    <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2023 <a
                            href="https://flowbite.com/">Flowbite™</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
                        <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Dribbble account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".default-carousel", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: ".default-carousel .swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".default-carousel .swiper-button-next",
                prevEl: ".default-carousel .swiper-button-prev",
            },
        });
    });


    var swiper = new Swiper(".centered-slide-carousel", {
        centeredSlides: true,
        paginationClickable: true,
        loop: true,
        spaceBetween: 30,
        slideToClickedSlide: true,
        pagination: {
            el: ".centered-slide-carousel .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1920: {
                slidesPerView: 1,
                spaceBetween: 30
            },
            1028: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            990: {
                slidesPerView: 1,
                spaceBetween: 0
            }
        }
    });

    //     time counter
    const endTime = new Date("{{ $endTime }}").getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {
            document.getElementById("countdown").innerHTML = "Time's up!";
            clearInterval(timer);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    const timer = setInterval(updateCountdown, 1000);
    updateCountdown();
</script>


</html>
