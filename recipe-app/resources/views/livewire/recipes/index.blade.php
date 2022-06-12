<div class="flex flex-col lg:flex-row lg:space-x-6">
    <div class="w-full lg:w-4/5 order-2 lg:order-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-5">
            @foreach ($recipes as $recipe)
                <a href="{{ route('recipes.show', $recipe) }}">
                    <div class="w-full h-full rounded-md shadow-md bg-white dark:bg-gray-700">
                        <div class="p-4 rounded-b-md dark:text-gray-200 space-y-2">
                            <p>
                                {{ $recipe->name }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
