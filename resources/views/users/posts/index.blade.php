@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2x6 font-medium mb-1">{{$user->name}}</h1>
                <p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}} received likes: {{$user->likes->count()}}</p>
                <p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}} received likes: {{$user->receivedLikes()->count()}}</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
            @if($posts->count())
                @if($posts->count())
                    @foreach($posts as $post)
                        <x-post :post="$post"/>
                    @endforeach
                    {{ $posts->links() }}
                @else
                    <p>No posts for {{$user->name}}</p>
                @endif

            @endif
            </div>
        </div>

    </div>
@endsection
