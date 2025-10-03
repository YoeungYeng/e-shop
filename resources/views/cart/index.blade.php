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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black hover:underline">
                Shopping Cart
            </h2>

            @if (session('cart'))
                @foreach ((array) session('cart') as $id => $details)
                    <div data-id="{{ $id }}"
                        class="rounded-3xl border-2 border-gray-200 p-4 lg:p-8 grid grid-cols-12 mb-8 max-lg:max-w-lg max-lg:mx-auto gap-y-4 ">
                        <div class="col-span-12 lg:col-span-2 img box">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($details['image']) }}"
                                alt="speaker image" class="max-lg:w-full lg:w-[180px] rounded-lg object-cover">
                        </div>
                        <div class="col-span-12 lg:col-span-10 detail w-full lg:pl-3">
                            <div class="flex items-center justify-between w-full mb-4">
                                <h5 class="font-manrope font-bold text-2xl leading-9 text-gray-900">
                                    {{ $details['name'] }}
                                </h5>
                                <form action="{{ route('cart.remove.From.Cart', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?');"
                                        class="rounded-full  group flex items-center justify-center focus-within:outline-red-500">

                                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle
                                                class="fill-red-50 transition-all duration-500 group-hover:fill-red-400"
                                                cx="17" cy="17" r="17" fill="" />
                                            <path
                                                class="stroke-red-500 transition-all duration-500 group-hover:stroke-white"
                                                d="M14.1673 13.5997V12.5923C14.1673 11.8968 14.7311 11.333 15.4266 11.333H18.5747C19.2702 11.333 19.834 11.8968 19.834 12.5923V13.5997M19.834 13.5997C19.834 13.5997 14.6534 13.5997 11.334 13.5997C6.90804 13.5998 27.0933 13.5998 22.6673 13.5997C21.5608 13.5997 19.834 13.5997 19.834 13.5997ZM12.4673 13.5997H21.534V18.8886C21.534 20.6695 21.534 21.5599 20.9807 22.1131C20.4275 22.6664 19.5371 22.6664 17.7562 22.6664H16.2451C14.4642 22.6664 13.5738 22.6664 13.0206 22.1131C12.4673 21.5599 12.4673 20.6695 12.4673 18.8886V13.5997Z"
                                                stroke="#EF4444" stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <p class="font-normal text-base leading-7 text-gray-500 mb-6">
                                {{ Str::limit($details['description'], 200) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('cart.remove', $id) }}">
                                        <button
                                            class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.5 9.5H13.5" stroke="" stroke-width="1.6"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </a>
                                    <input type="number" id="number" value="{{ $details['quantity'] }}"
                                        class="border border-gray-200 rounded-lg w-20 outline-none text-gray-900 font-semibold text-sm py-1.5 px-3 bg-gray-100  text-center"
                                        placeholder="2">
                                    <a href="{{ route('cart.add', $details['id']) }}">
                                        <button
                                            class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                width="18" height="19" viewBox="0 0 18 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.75 9.5H14.25M9 14.75V4.25" stroke=""
                                                    stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>
                                <h6 class="text-indigo-600 font-manrope font-bold text-2xl leading-9 text-right">
                                    ${{ $details['sale_price'] }} </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif



            <div
                class="flex flex-col md:flex-row items-center md:items-center justify-between lg:px-6 pb-6 border-b border-gray-200 max-lg:max-w-lg max-lg:mx-auto">
                <h5
                    class="text-gray-900 font-manrope font-semibold text-2xl leading-9 w-full max-md:text-center max-md:mb-4">
                    Subtotal</h5>

                <div class="flex items-center justify-between gap-5 ">
                    <button
                        class="rounded-full py-2.5 px-3 bg-indigo-50 text-indigo-600 font-semibold text-xs text-center whitespace-nowrap transition-all duration-500 hover:bg-indigo-100">Promo
                        Code?</button>
                    <h6 class="font-manrope font-bold text-3xl lead-10 text-indigo-600">${{ $total }} </h6>
                </div>
            </div>
            <div class="max-lg:max-w-lg max-lg:mx-auto">
                <p class="font-normal text-base leading-7 text-gray-500 text-center mb-5 mt-6">Shipping taxes, and
                    discounts
                    calculated
                    at checkout</p>
                <button
                    class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700 ">Checkout</button>

            </div>


        </div>
        </div>
        </div>
    </section>


    {{-- script --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

{{-- <script type="text/javascript">
    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);
        var id = ele.closest('div[data-id]').data('id');
        console.log("Removing product ID:", id);

        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('cart.remove.From.Cart') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                    id: id
                },
                success: function(response) {
                    console.log("AJAX response:", response);
                    if (response.success) {
                        ele.closest('div[data-id]').remove(); // remove from DOM instantly
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", xhr.responseText);
                }
            });
        }
    });
</script> --}}


</html>
