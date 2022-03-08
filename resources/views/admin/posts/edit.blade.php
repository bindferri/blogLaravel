<x-layout>
    <x-setting name="Edit Post: {{$post->title}}">
        <form action="/admin/posts/{{$post->id}}" method="post" class="max-w-sm mx-auto" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title',$post->title)"></x-form.input>
            <x-form.textarea name="excerpt">{{old('excerpt',$post->excerpt)}}</x-form.textarea>
            <x-form.textarea name="body">{{old('body',$post->body)}}</x-form.textarea>
            <div class="flex mt-6">
            <x-form.input name="thumbnail" type="file" :value="old('title',$post->title)"></x-form.input>
            <img src="/storage/{{$post->thumbnail}}" alt="" class="rounded-xl" width="100">
            </div>

            <div class="mb-6">
                <x-form.label name="status"></x-form.label>
                <select name="status" id="status">
                    <option value="{{$post->status == 'draft' ? 'draft' : 'published'}}">{{$post->status == 'draft' ? 'Draft' : 'Publish'}}</option>
                    <option value="{{$post->status != 'draft' ? 'draft' : 'published'}}">{{$post->status != 'draft' ? 'Draft' : 'Publish'}}</option>
                </select>
                <x-form.error name="status"></x-form.error>
            </div>

            <div class="mb-6">
                <x-form.label name="author"></x-form.label>
                <select name="author" id="author">
                    @php
                        $authors = \App\Models\User::all();
                    @endphp

                    @foreach($authors as $author)
                        <option value="{{$author->id}}"
                            {{old('author',$post->user_id) == $author->id ? 'selected' : ''}}
                        >{{ucwords($author->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="author"></x-form.error>
            </div>

            <div class="mb-6">
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category">
                    @php
                        $category = \App\Models\Category::all();
                    @endphp

                    @foreach($category as $cat)
                        <option value="{{$cat->id}}"
                            {{old('category',$post->category_id) == $cat->id ? 'selected' : ''}}
                        >{{ucwords($cat->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">Update</button>
            </div>
        </form>
    </x-setting>
</x-layout>
