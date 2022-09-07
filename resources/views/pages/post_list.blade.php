<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('posting.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded shadow-lg">+ Tambah
                    Posting</a>
            </div>

            <form action="{{ route('posting') }}">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Pencarian</label>
                <div class="relative mb-10">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="keyword" id="default-search"
                        class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pencarian..." value="{{ Request::get('keyword') }}">
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                </div>
            </form>

            <div class="grid grid-cols-4 gap-4">
                @forelse ($posting as $value)
                    <div>
                        <div class="card w-full bg-base-100 shadow-xl">
                            <figure><img src="https://placeimg.com/400/225/arch" alt="Shoes" /></figure>
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $value->name }}

                                    <div class="badge">{{ $value->category }}</div>
                                </h2>

                                <p>{{ $value->description }}</p>
                                <div class="card-actions justify-end">
                                    <a href="{{ route('posting.edit', $value->id) }}"
                                        class="btn btn-info btn-xs text-white">edit</a>
                                    <form action="{{ route('posting.destroy', $value->id) }}" class="delete-form"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-error btn-xs text-white"
                                            onclick="return confirm('Apakah anda yakin?')">delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="stroke-current flex-shrink-0 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Belum ada postingan.</span>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center items-center mt-10">
                {{ $posting->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
