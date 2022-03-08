<x-layout>
    <x-setting name="Publish New Post">
        <form action="/admin/posts" method="post" class="max-w-sm mx-auto" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title"></x-form.input>
            <x-form.textarea name="excerpt"></x-form.textarea>
            <x-form.textarea name="body"></x-form.textarea>
            <x-form.input name="thumbnail" type="file"></x-form.input>

            <div class="mb-6">
                <x-form.label name="status"></x-form.label>
                <select name="status" id="status">
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                </select>
                <x-form.error name="status"></x-form.error>
            </div>

            <div class="mb-6">
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category">
                    @php
                        $category = \App\Models\Category::all();
                    @endphp

                    @foreach($category as $cat)
                        <option value="{{$cat->id}}"
                            {{old('category') == $cat->id ? 'selected' : ''}}
                        >{{ucwords($cat->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Submit</button>
            </div>
        </form>
    </x-setting>
</x-layout>
