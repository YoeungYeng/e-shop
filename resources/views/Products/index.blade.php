<x-app-layout>
    <section class="mb-6 w-[80%] m-auto mt-4 flex justify-end">
        <a href="{{ route ('product.create') }}" class="bg-blue-600 transition duration-300 rounded-lg px-6 py-2
            hover:bg-blue-400 text-[14px] hover:underline text-white">
            Create
        </a>
    </section>
    <section class="shadow w-[80%] m-auto ">
        <h3 class="text-center mt-6 bg-white text-2xl font-mono underline">
            All Products
        </h3>
        {{--table of products--}}


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ProductID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Origin Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Discount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stock
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>

                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $product->id }}</td>
                        <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($product->name) }}</td>
                        <td class="px-6 py-4">{{ $product->origin_price }}</td>
                        <td class="px-6 py-4">{{ $product->sale_price }}</td>
                        <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($product->description) }}</td>
                        <td class="px-6 py-4">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                     class="w-20 h-20 object-cover rounded-lg" />
                            @else
                                <span class="text-gray-400 italic">No image</span>
                            @endif

                        </td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>

                        <td class="px-6 py-3 flex gap-4">
                            <a href="{{ route ('product.edit', $product) }}" class="hover:bg-green-500 duration-200 transition-all bg-green-700
                            text-white rounded-lg py-1 px-6">
                                edit
                            </a>
                            <form action="{{ route ('product.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="hover:bg-red-500 duration-200 transition-all bg-red-700 text-white
                             rounded-lg py-1 px-6">delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No products found.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

    </section>
</x-app-layout>
