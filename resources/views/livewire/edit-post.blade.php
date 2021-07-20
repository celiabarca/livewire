
<div>
    {{-- Be like water. --}}
    <div class="cursor-pointer w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
        <a wire:click="$set('open', true)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </a>
    </div>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar post
        </x-slot>
        <div wire:loading wire:target="image" class="w-full bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
            <p class="font-bold">Cargando imagen</p>
        </div>
        <x-slot name="content">
            <div>
                @if ($image)
                    <img src="{{$image->temporaryUrl()}}" alt="">
                @else
                    <img src="{{Illuminate\Support\Facades\Storage::url($post->image)}}" alt="">
                @endif
            </div>
            <div class="mb-4">
                <x-jet-label value="Titulo"></x-jet-lable>
                <x-jet-input type="text" wire:model="post.title" class="w-full"></x-jet-input>
            </div> 
            <div class="mb-4">
                <x-jet-label value="Post"></x-jet-lable>
                <textarea  wire:model="post.content" rows="6" class="p-4 mt-4 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm;"></textarea>
                {{-- <x-jet-input-error for="content"/> --}}
            </div>
            <div class="mt-4">
                <x-jet-label value="imagen del post"></x-jet-lable>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-jet-input-error for="image"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open', false)">cerrar</x-jet-danger-button>
            <x-jet-secondary-button wire:click="save"  wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-90">Actualizar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
