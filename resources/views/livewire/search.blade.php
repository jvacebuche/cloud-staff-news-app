<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent class="max-w-sm mx-auto py-5">
        <div class="mb-6">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="search" wire:model.debounce.500ms="searchTerm" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                <button  wire:click.prefetch="search" type="button" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </div>
    </form>
    <div class="max-w-6xl mx-auto py-5">
        <div class="relative overflow-x-auto">
            <h4 class="text-xl font-bold dark:text-white">Pinned Items</h4>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Link</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pinnedArticles as $pinned)
                    <tr>
                        <td>
                            <button class="px-3 py-2 text-xs text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
                            type="button" wire:click="unpinArticle('{{ $pinned['id'] }}')">X</button>
                        </td>
                        <td>{{ $pinned['webTitle'] }}</td>
                        <td><a href="{{ $pinned['webUrl'] }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Click here</a></td>
                        <td>{{ \Carbon\Carbon::parse($pinned['webPublicationDate'])->format('F j, Y, g:i a') }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No pinned items
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>


    <div class="max-w-6xl mx-auto py-5">
        <div class="relative overflow-x-auto">
            <h4 wire:loading class="text-xl font-bold dark:text-white">Searching...</h4>
            <h4 wire:loading.remove class="text-xl font-bold dark:text-white">Result</h4>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Link</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                    <tr>
                        <td>
                            <button class="px-3 py-2 text-xs text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
                            type="button" wire:click="pinArticle('{{ $article['id'] }}')">Pin</button>
                        </td>
                        <td>{{ $article['webTitle'] }}</td>
                        <td><a href="{{ $article['webUrl'] }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Click here</a></td>
                        <td>{{ \Carbon\Carbon::parse($article['webPublicationDate'])->format('F j, Y, g:i a') }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No data available
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
