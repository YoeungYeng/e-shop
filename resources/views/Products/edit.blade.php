<x-app-layout>
    <section class="mt-6  w-[70%] m-auto   flex justify-between">
        <a href="{{ route ("product.index") }}"
           class=" transition text-center duration-300 w-[100px] text-white px-6 hover:bg-gray-400 py-2 rounded-lg bg-gray-500">
            back
        </a>

    </section>

    <section class="mt-6 shadow w-[70%] mx-auto">
        <form method="POST" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method("Patch")
            <!-- name -->
            <div class="px-6 py-4 rounded-lg mb-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" class="block mt-1 w-full"
                              type="text"
                              name="name"
                              required placeholder="electronic"
                              value="{{ old ('name', $product->name) }}"
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2"/>

                <x-input-label for="price" :value="__('Price')"/>
                <x-text-input id="price" class="block mt-1 w-full"
                              type="number"
                              name="price"
                              required placeholder="50000"
                              value="{{ old ('price', $product->price) }}"
                />

                <x-input-error :messages="$errors->get('price')" class="mt-2"/>

                <x-input-label for="description" :value="__('Description')"/>
                <x-text-input id="description" class="block mt-1 w-full"
                              type="text"
                              name="description"
                              required
                              placeholder="this is description about..."
                              value="{{ old ('description', $product->description) }}"
                />

                <x-input-error :messages="$errors->get('description')" class="mt-2"/>

                <x-input-label for="image" :value="__('Image')"/>
                <x-text-input id="image" class="block mt-1 w-full"
                              type="file"
                              name="image"

                />
                {{--image display--}}
                <div class="w-[100px] h-[100px] mt-2">
                    @if($product->image)
                        <img class="w-full h-full rounded mb-6 object-cover"
                             src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}"
                             alt="{{  \Illuminate\Support\Str::limit($product->name, 5) ?? 'Image' }}">
                    @else
                        <p class="flex items-center justify-center w-full h-full text-gray-500 text-sm">
                            No Picture
                        </p>
                    @endif
                </div>


                <x-input-error :messages="$errors->get('image')" class="mt-2"/>

                <x-input-label for="stock" :value="__('Stock')"/>
                <x-text-input id="stock" class="block mt-1 w-full"
                              type="text"
                              name="stock"
                              required
                              placeholder="100"
                              value="{{ old ('stock', $product->stock) }}"
                />
                <x-input-error :messages="$errors->get('stock')" class="mt-2"/>
                <select class="mt-4 w-full rounded-lg" name="category_id"
                        id="category_id">
                    <option value=""> Select Category</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @empty
                        <option value="">
                            No category
                        </option>
                    @endforelse

                </select>

            </div>


            <div class="flex justify-end mt-4 p-6">
                <x-primary-button>
                    {{ __('Updated') }}
                </x-primary-button>
            </div>
        </form>
    </section>

</x-app-layout>
