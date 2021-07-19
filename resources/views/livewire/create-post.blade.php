<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
 
    <x-jet-button wire:click="$set('open', true)">
       
        crear post
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            crear nuevo post
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="titulo del post"></x-jet-lable>
                <x-jet-input type="text" class="w-full" wire:model.defer="title"></x-jet-lable>
                <x-jet-label value="titulo del contenido"></x-jet-lable>
                <textarea wire:model.defer="content" rows="6" class="p-4 mt-4 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm;"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="save">Crear</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)">cerrar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
