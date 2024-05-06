@extends('userComponent.default')

@section('title', 'GreenBite')

@section('content')
    <!-- News Detail -->
    <section class="pt-[175px] pb-16">
        <div class="container mx-auto">
            <div class="flex gap-8 my-3 items-start">
                <div class="sticky top-24 flex flex-col items-center px-8 pt-12 gap-6">
                    <span>Bagikan</span>
                    <button type="button" onClick="navigator.clipboard.writeText(window.location.href)" class="text-2xl rounded-full h-12 w-12 bg-primary text-white flex items-center justify-center transition hover:bg-gray/75"><i class='bx bx-link'></i></butto>
                </div>
                <div class="grow">
                    <img src="{{ asset('assets/user/images/news/'.$news->image) }}" alt="Article" class="w-full h-96 object-cover rounded-lg">
                    <p class="text-gray-500 my-4">{{ \Carbon\Carbon::parse($news->date)->format('l, d F Y') }}</p>
                    <div class="mt-8 w-full">
                        <h1 class="font-bold text-3xl mb-6">{{ $news->title }}</h1>
                        <iframe src="{{ route('newsDetailContent', $news->id) }}" frameborder="0" class="w-full" onload='javascript:(function(o){o.style.height=(o.contentWindow.document.body.scrollHeight + 150)+"px";}(this));' style="height:400px;width:100%;border:none;overflow:hidden;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection