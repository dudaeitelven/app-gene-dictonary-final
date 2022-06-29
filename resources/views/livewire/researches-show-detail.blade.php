<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto mt-2">
                <x-jet-banner />
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <div class="m-4 p-2">
                                <h1>{{ $research->description }}</h1>
                            </div>

                            <x-jet-section-border />

                            <table class="">
                                <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left">Gene</th>
                                        <th scope="col" class="px-6 py-3 text-left">Organism</th>
                                        <th scope="col" class="px-6 py-3 text-left">Target Gene</th>
                                        <th scope="col" class="px-6 py-3 text-left">Target Organism</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($researchLines as $researchLine)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $researchLine->gene }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $researchLine->organism }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $researchLine->target_gene }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $researchLine->target_organism }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <x-jet-section-border />

                            <div class="m-2 p-2">
                                <x-jet-button onclick="history.back()" class="ml-2">Back</x-jet-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
