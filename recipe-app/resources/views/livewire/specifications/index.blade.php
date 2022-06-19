<div>
    <div
        class="w-full flex flex-col lg:flex-row space-y-2 lg:space-y-0 justify-between p-4 bg-white border-b border-gray-200 lg:items-center rounded-t-md dark:bg-gray-700">
        <p class="font-bold dark:text-gray-200">
            All Specifications
        </p>
        <div class="space-y-2 lg:space-y-0 lg:space-x-2">
            <input wire:model="search" type="search" placeholder="Find an Specification"
                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200 text-xs">
        </div>
    </div>
    <div class="p-4">
        <table class="w-full dark:text-gray-200">
            <thead>
                <tr class="hidden lg:table-row border-b">
                    <th class="text-left px-4 py-2 w-1/3">
                        Name
                    </th>
                    <th class="text-left px-4 py-2 w-1/3">
                        Number of Recipes
                    </th>
                    <th class="text-left px-4 py-2 w-1/3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($specifications as $specification)
                    <td class="block lg:table-cell px-4 py-2">
                        <a href="{{ route('admin.specifications.show', $specification) }}"
                            class="hover:text-yellow-600 dark:text-gray-200 dark:hover:text-yellow-600">
                            {{ $specification->name }}
                        </a>
                    </td>
                    <td class="block lg:table-cell px-4 py-2">
                        {{ $specification->recipes->count() }}
                    </td>
                    <td class="flex flex-col lg:flex-row px-4 py-2 lg:justify-end space-y-1 lg:space-y-0 lg:space-x-1">
                        <div>
                            <a href="{{ route('admin.specifications.edit', $specification) }}">
                                <button type="button"
                                    class="w-full lg:w-auto rounded shadow-md py-1 px-2 bg-green-700 text-white hover:bg-green-500 text-xs"
                                    aria-label="Edit Specification">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                        </div>
                        <div>
                            <form action="{{ route('admin.specifications.destroy', $specification) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full lg:w-auto rounded shadow-md py-1 px-2 bg-gray-400 text-white hover:bg-gray-300 text-xs"
                                    aria-label="Delete Specification">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
