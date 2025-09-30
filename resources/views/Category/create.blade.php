<x-app-layout>
    <section class="mt-6  w-[70%] m-auto   flex justify-between">
        <a href="{{ route ("category.index") }}"
           class=" transition text-center duration-300 w-[100px] text-white px-6 hover:bg-gray-400 py-2 rounded-lg bg-gray-500">
            back
        </a>

    </section>

    <section class="mt-6 shadow w-[70%] mx-auto">
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            @method("POST")
            <!-- name -->
            <div class="px-6 py-4 rounded-lg ">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" class="block mt-1 w-full"
                              type="text"
                              name="name"
                              required placeholder="electronic"/>

                <x-input-error :messages="$errors->get('name')" class="mt-2"/>


                <x-input-label for="description" :value="__('Description')"/>
                <x-text-input id="description" class="block mt-1 w-full"
                              type="text"
                              name="description"
                              required/>

                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>


            <div class="flex justify-end mt-4 p-6">
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </section>

</x-app-layout>
