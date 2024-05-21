@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- News -->
    <section class="pt-[150px] lg:pt-[200px] pb-16">
        <div class="container mx-auto">
            <div>
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl md:text-5xl font-bold"><span class="text-primary">Green</span>Article</h1>
                    <form action="" method="GET" class="flex gap-2 items-center" x-data="{ open: false, click: 0, search: '' }">
                        <input type="text" name="search" placeholder="Cari ..." class="border-b px-2 py-1 outline-none focus:border-b-2 w-32 lg:w-48" x-show="open" x-model="search">
                        <button @click="open = true; click += 1" x-bind:type="click == 2 ? 'submit' : 'button'" type="button"><i class="bx bx-search text-xl"></i></button>
                    </form>
                </div>
                <div class="flex flex-col gap-4">
                    @foreach ($newsList as $news)
                    <a href="{{ route('newsDetail', $news->id) }}" class="flex flex-col md:flex-row justify-start items-center rounded-lg shadow-lg gap-8 p-8">
                        <img src="{{ asset('assets/user/images/news/'.$news->image) }}" alt="{{ $news->name }}" class="basis-3/12 w-full md:w-3/12 h-48 rounded object-cover">
                        <div class="flex flex-col justify-between basis-9/12">
                            <div>
                                <h2 class="text-2xl font-bold">{{ $news->title }}</h2>
                                <span class="text-gray-400 mb-4 block">{{ \Carbon\Carbon::parse($news->date)->format('l, d F Y') }}</span>
                                <p class="text-gray-500">
                                    {{ strip_tags($news->content) }}
                                </p>
                            </div>
                            
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    
@endsection