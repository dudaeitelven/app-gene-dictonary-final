<div class="container mx-auto mt-2 p-2">
    <div wire:loading wire:target="storeResearch">
        <x-loading-indicator />
    </div>

    <form enctype="multipart/form-data">
        <div class="card-header m-2 p-2">
            <h2>Description of research</h2>
        </div>

        <div class="sm:col-span-6 m-2 p-2">
            <div class="mt-1">
                <input type="text" id="description" wire:model.lazy="description" name="description" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-jet-section-border />

        <div class="card">
            <div class="card-header m-2 p-2">
                <h2>Lines to research</h2>
            </div>

            <div class="card-body m-2 p-2">
                <table class="table" id="lines_table">
                    <thead>
                        <tr>
                            <th>Gene</th>
                            <th>Organism</th>
                            <th>Target Organism</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($researchLines as $index => $researchLine)
                        <tr>
                            <td>
                                <input type="text"
                                       name="researchLines[{{$index}}][gene]"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                       wire:model.lazy="researchLines.{{$index}}.gene" />
                            </td>
                            <td>
                                <input type="text"
                                       name="researchLines[{{$index}}][organism]"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                       wire:model.lazy="researchLines.{{$index}}.organism" />
                            </td>
                            <td>
                                <input type="text"
                                       name="researchLines[{{$index}}][target_organism]"
                                       class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                       wire:model.lazy="researchLines.{{$index}}.target_organism" />
                            </td>
                            <td>
                                <x-jet-button wire:click.prevent="removeLine({{$index}})" class="bg-green-500 btn btn-sm btn-secondary">Delete</x-jet-button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="flex content-center p-2 m-2">
                        <x-jet-button wire:click.prevent="addLine" class="bg-green-500 btn btn-sm btn-secondary">+ Add line</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-jet-section-border />

    <div class="flex content-center m-2 p-2">
        <x-jet-button wire:click="storeResearch">Search</x-jet-button>
    </div>
</div>
