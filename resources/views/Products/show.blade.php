<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>


    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
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
    <nav class="flex items-center justify-between  gap-4 px-6 py-2 rounded-lg mt-3">
        {{--logo--}}
        <div class="flex gap-4 items-center">
            <img src="{{ asset ('images/logo-icon.jpg') }}" alt="">

            {{--static navbar--}}
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

        {{--icons--}}
        <div class="flex gap-4 items-center ">
            {{--search --}}
            <x-search-button>
                Search
            </x-search-button>

            {{--cart favorite--}}
            <span class="text-xl cursor-pointer hover:text-red-500">
                    <i class="fa-regular fa-heart"></i>
                </span>
            <span class="text-xl cursor-pointer hover:text-red-500">
                    <i class="fa-solid fa-cart-shopping"></i>
                </span>
        </div>
    </nav>
</x-header>
<section class="w-[80%] h-auto mx-auto mt-32 mb-6">
    <h4>
        Account / Gaming/ {{ $product->name }}
    </h4>
    {{--show image in this--}}
    <div class="flex items-start gap-4">
        <div class="w-[50%]">
            {{--image--}}
            <img class="rounded-lg" src="{{ \Illuminate\Support\Facades\Storage::url ($product->image) }}" alt="">
        </div>
        <div class="w-[50%]">
            {{--show information--}}
            <h3 class="text-2xl font-bold"> {{ $product->name }} </h3>
            <h4 class="text-xl"> ${{ $product->sale_price }} </h4>
            <p>
                {{ \Illuminate\Support\Str::limit ($product->description, 400) }}
            </p>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="flex items-center gap-4">
                {{-- Remove from cart --}}
                <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE') {{-- keep only if route is DELETE --}}
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Remove
                    </button>
                </form>

                {{-- Total --}}
                @php $total = 0; @endphp
                @foreach($cart as $id => $detail)
                    @php $total += $detail['price'] * $detail['quantity']; @endphp
                @endforeach

                <p>Total: {{ $total }}</p>

                {{-- Add to cart --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Add
                    </button>
                </form>
            </div>


        </div>
    </div>
</section>


</body>

</html>
