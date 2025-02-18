<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="mb-6">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                 class="w-full h-64 object-cover rounded">
        </div>
        <h1 class="text-3xl font-bold mb-4">{{ $news->title }}</h1>
        <p class="text-gray-700 mb-6">{{ $news->description }}</p>

        @if($news->action === 'more_info')
            <div class="prose">
                {!! $news->more_info !!}
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline">Back to News</a>
        </div>
    </div>
</x-app-layout>
