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
            <div wire:loading wire:target="image" class="w-full bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                <p class="font-bold">Cargando imagen</p>
            </div>
            <div class="mb-4">
                
                <div>
                    @if ($image)
                        <img src="{{$image->temporaryUrl()}}" alt="">
                    @endif
                </div>
                <div class="mt-4">
                    <x-jet-label value="titulo del post"></x-jet-lable>
                    <x-jet-input type="text" class="w-full" wire:model.defer="title"></x-jet-lable>
                    <x-jet-input-error for="title"/>
                </div>
                <div class="mt-4" wire:ignore>
                    <x-jet-label value="post"></x-jet-lable>
                    <textarea id="editor" 
                              wire:model.defer="content" 
                              rows="6" 
                              class="p-4 mt-4 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm;"></textarea>
                    <x-jet-input-error for="content"/>
                </div>
                <div class="mt-4">
                    <x-jet-label value="imagen del post"></x-jet-lable>
                    <input type="file" wire:model="image" id="{{$identificador}}">
                    <x-jet-input-error for="image"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open', false)">cerrar</x-jet-danger-button>
            <x-jet-secondary-button wire:click="save"  wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-90">Crear</x-jet-secondary-button>
            {{-- <span wire:loading wire:target="save">cargando...</span> --}}
        </x-slot>
    </x-jet-dialog-modal>

</div>
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>  
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(function (editor){
                editor.model.document.on('change:data', ()=> {
                    @this.set('content', editor.getData());
                })
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
