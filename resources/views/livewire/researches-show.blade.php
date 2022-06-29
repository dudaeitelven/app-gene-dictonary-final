<div class="container mx-auto mt-2">
    <x-jet-banner />
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Date</th>
                            <th scope="col" class="relative px-6 py-3">Menu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr></tr>
                        @forelse($Researches as $research)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $research->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $research->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <x-jet-button onclick="location.href='/researches-tab-detail/{{ $research->id}}'" class="ml-2" wire:loading.attr="disabled">View</x-jet-button>
                                    <x-jet-danger-button class="ml-2" wire:click="researchToDelete({{ $research->id}})" wire:loading.attr="disabled">Delete</x-jet-danger-button>
                                    <x-jet-secondary-button class="ml-2" wire:click="exportResearch({{ $research->id}})" wire:loading.attr="disabled">Export</x-jet-secondary-button>
                                    <x-jet-secondary-button class="ml-2" wire:click="researchToShare({{ $research->id }})" wire:loading.attr="disabled">Share</x-jet-secondary-button>
                                </td>
                            </tr>
                        @empty
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">Nenhuma pesquisa salva...</span>
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <div class="m-2 p-2">
                    {{ $Researches->links() }}
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <x-jet-confirmation-modal wire:model="researchToDelete">
            <x-slot name="title">
                {{ __('Delete Research') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this Research? ') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button class="ml-2" wire:click="deleteResearch({{ $researchToDelete }})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>

                <x-jet-secondary-button class="ml-2" wire:click="$set('researchToDelete', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <!-- Share Modal -->
        <x-jet-dialog-modal wire:model.defer="researchToShare">
            <x-slot name="title">Share a Research</x-slot>--}}

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Select a User to share the research:</div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <select wire:model="userIDToShare" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            <option value="" selected>Choose user</option>
                            @foreach($Users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button class="ml-2" wire:click="saveResearchShare()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>

                <x-jet-secondary-button class="ml-2" wire:click="$set('researchToShare', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
