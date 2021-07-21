
<div wire:init="loadPosts">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-table>
            <div class="px-6 py-4 flex items-center">
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cant" class=" items-center mx-2 p-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>
                <x-jet-input class="flex-1 mx-4" placeholder="Buscar" type="text" wire:model="search" />
                @livewire('create-post')
            </div>
            @if (count($posts))
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th wire:click="order('id')" class="w-24 cursor-pointer py-3 px-6 text-left">ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt float-right mt-1 ml-3"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt float-right mt-1 ml-3"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1 ml-3"></i>
                                @endif
                            </th>
                            <th wire:click="order('title')" class="cursor-pointer py-3 px-6 text-left">TITLE 
                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt float-right mt-1 ml-3"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt float-right mt-1 ml-3"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1 ml-3"></i>
                                @endif
                            </th>
                            <th wire:click="order('content')" class="cursor-pointer py-3 px-6 text-center">CONTENT
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt float-right mt-1 ml-3"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt float-right mt-1 ml-3"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1 ml-3"></i>
                                @endif
                            </th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($posts as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$item->id}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center text-left">
                                        <span class="font-medium">{{$item->title}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="font-medium ">{{$item->content}}</span>
                                </td>
                                <td class="py-3 flex px-6">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <div class="flex items-center cursor-pointer w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a wire:click="edit({{$item}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <x-jet-dialog-modal wire:model="open_edit">
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
                                            <x-jet-danger-button wire:click="$set('open_edit', false)">cerrar</x-jet-danger-button>
                                            <x-jet-secondary-button wire:click="update"  wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-90">Actualizar</x-jet-secondary-button>
                                        </x-slot>
                                    </x-jet-dialog-modal>
                                    <div class="flex items-center w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a wire:click="$emit('deletePost', {{$item->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                @if ($posts->hasPages())
                <div class="px-6 py-3">
                    {{$posts->links()}}
                </div>
                
            @endif
            @else
                <div class="px-6 py-4">
                    <p>no hay posts</p>
                </div>
            @endif
            
            
            
        </x-table>
                        

    </div>

</div>
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('deletePost', postId=> {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('show-post', 'delete', postId)

                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            
            })
        })
    </script>
@endpush
{{-- <div class="flex item-center justify-center">
    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </div> --}}
    {{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        </div>
    </div> --}}