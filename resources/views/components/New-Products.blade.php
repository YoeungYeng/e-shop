<section class="w-[80%] mt-6  mx-auto flex flex-col shadow mb-6">
    <h3 class="underline text-xl text-red-600 px-2">
        Today's
    </h3>
    <div class="text-center flex gap-6 items-center">
        <h1 class="text-2xl font-bold ">Countdown Clock:</h1>
        <div id="countdown" class="text-4xl font-mono text-red-600"></div>
    </div>

    <!--HTML CODE-->
    <div class="w-full relative">
        @if($products->isNotEmpty())
            <div class="swiper centered-slide-carousel swiper-container relative">
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                        <div class="swiper-slide">
                            <div class="rounded-lg h-64 flex flex-col shadow">
                                <div class="flex flex-col items-center p-4">
                                    {{-- Product image --}}
                                    <a href="#">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}"
                                             class="rounded-lg mb-2 h-32 w-32 object-cover"
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
