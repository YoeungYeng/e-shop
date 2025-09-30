<x-app-layout>
    <section class="mb-6 w-[80%] mx-auto mt-4 flex justify-end">
        <a href="{{ route ('category.create') }}" class="bg-blue-600 transition duration-300 rounded-lg px-6 py-2
            hover:bg-blue-400 text-[14px] hover:underline text-white">
            Create
        </a>
    </section>
    <section class="shadow w-[80%] mx-auto ">
        <h3 class="text-center mt-6 bg-white text-2xl font-mono underline">
            All Category
        </h3>
        {{--table of category--}}


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        CategoryID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>

                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">{{ $category->id }}</td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ Illuminate\Support\Str::limit($category->description) }}</td>
                        <td class="px-6 py-3 flex gap-4">
                            <a href="{{ route ('category.edit', $category) }}" class="hover:bg-green-500 duration-200 transition-all bg-green-700
                            text-white rounded-lg py-1 px-6">
                                edit
                            </a>
                            <form action="{{ route ('category.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="hover:bg-red-500 duration-200 transition-all bg-red-700 text-white
                             rounded-lg py-1 px-6">delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            No categories found.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

    </section>
</x-app-layout>
