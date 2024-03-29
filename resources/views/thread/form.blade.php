<div>
    <input type="text" name="title" placeholder="Título"
        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs mb-4"
        value="{{ old('title', $thread->title) }}">

    <select name="category_id" class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs capitalize mb-4">
        <option value="">Seleccionar categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $thread->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <textarea name="body" placeholder="Descripción de la pregunta" cols="30" rows="10" 
        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs mb-4">{{ old('body', $thread->body) }}</textarea>
</div>