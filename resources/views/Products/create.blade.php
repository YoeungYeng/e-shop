<x-app-layout>
    <section class="mt-6  w-[70%] m-auto   flex justify-between">
        <a href="{{ route ("product.index") }}"
           class=" transition text-center duration-300 w-[100px] text-white px-6 hover:bg-gray-400 py-2 rounded-lg bg-gray-500">
            back
        </a>

    </section>

    <section class="mt-6 shadow w-[70%] mx-auto">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <!-- name -->
            <div class="px-6 py-4 rounded-lg mb-6">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" class="block mt-1 w-full"
                              type="text"
                              name="name"
                              required placeholder="electronic"/>

                <x-input-error :messages="$errors->get('name')" class="mt-2"/>

                <x-input-label for="origin_price" :value="__('Price')"/>
                <x-text-input id="origin_price" class="block mt-1 w-full"
                              type="number"
                              name="origin_price"
                              required placeholder="50000"/>

                <x-input-error :messages="$errors->get('origin_price')" class="mt-2"/>

                <x-input-label for="sale_price" :value="__('Discount')"/>
                <x-text-input id="sale_price" class="block mt-1 w-full"
                              type="number"
                              name="sale_price"
                              required placeholder="50000"/>

                <x-input-error :messages="$errors->get('sale_price')" class="mt-2"/>

                <x-input-label for="description" :value="__('Description')"/>
                <x-text-input id="description" class="block mt-1 w-full"
                              type="text"
                              name="description"
                              required
                              placeholder="this is description about..."
                />
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>

                <x-input-label for="image" :value="__('Image')"/>
                <x-text-input id="image" class="block mt-1 w-full"
                              type="file"
                              name="image"
                              required
                />

                <x-input-error :messages="$errors->get('image')" class="mt-2"/>

                <x-input-label for="quantity" :value="__('Stock')"/>
                <x-text-input id="quantity" class="block mt-1 w-full"
                              type="text"
                              name="quantity"
                              required
                              placeholder="100"
                />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2"/>

                <select class="mt-4 w-full rounded-lg" name="category_id"
                        id="category_id">
                    <option value=""> Select Category</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @empty
                        <option value="">
                            no category
                        </option>
                    @endforelse
                </select>

            </div>


            <div class="flex justify-end mt-4 p-6">
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </section>

</x-app-layout>
