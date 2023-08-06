<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Pregunta --}}
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-md">
            </div>
            <div class="w-full">
                <h2 class="mb-4 flex items-start justify-between">
                    <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-white/90">{{ $thread->title }}</a>
                    <span class="rounded-full text-xs py-2 px-4 capitalize" style="color: {{ $thread->category->color }}; border: 1px solid {{ $thread->category->color }}">{{ $thread->category->name }}</span>
                </h2>

                <div class="flex justify-between items-center mb-4">
                    <div class="text-blue-600 font-semibold text-xs">
                        {{ $thread->user->name }}
                        <span class="text-sky-400 ml-2">{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <div class="flex items-center gap-1 text-slate-700 text-xs">
                        <svg class="h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
                        </svg>
                        {{ $replies_count }} {{ $replies_count !== 1 ? 'respuestas' : 'respuesta' }}
                        
                        |
                        
                        <a href="{{ route('threads.edit', $thread) }}" class="hover:text-white flex items-center gap-1">
                            Editar
                            <svg class="h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <p class="text-white/60">{{ $thread->body }}</p>
            </div>
        </div>
    </div>

    {{-- Formulario de respuesta --}}
    <form wire:submit.prevent="postReply" class="mb-4">
        <input type="text" 
            class="bg-slate-800 border-0 rounded-md w-full p-3 text-white/60 text-xs" 
            placeholder="Escribe una respuesta..." 
            wire:model.defer="body">
    </form>

    {{-- Respuestas --}}
    @foreach ($replies as $reply)
        {{-- Llamando a un componente de livewire y enviando el parámetro reply --}}
        @livewire('show-reply', ['reply' => $reply], key('reply-' . $reply->id))
    @endforeach
</div>