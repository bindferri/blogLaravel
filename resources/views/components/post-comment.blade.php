@props(['comment'])
<article class="flex bg-gray-100 border border-gray-200 p-6 rounded-xl space-x-4">
    <div>
        <img src="https://robohash.org/honey?set=set{{$comment->author->id}}" alt="" class="rounded-xl">
    </div>
    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{$comment->author->name}}</h3>
            <p class="text-xs">Posted <time>{{$comment->created_at->diffForHumans()}}</time></p>
        </header>
        <p> {{$comment->body}}</p>
    </div>
</article>
