<section id="latest-blog" class="padding-large">
    <div class="container">
        <div class="row tw-flex tw-flex-col tw-gap-4">
            <div class="display-header tw-flex tw-justify-between">
                <h2 class="tw-text-lg tw-font-bold tw-uppercase">Tech news</h2>
                <a href="{{route('blog')}}" class="hover:tw-text-yellow-500">See all</a>
            </div>
            <div class="post-grid tw-grid tw-grid-cols-4 tw-gap-4">
                @foreach ($posts as $post)
                    <a href="{{route('blog.detail',$post->slug)}}" class="blog-item tw-rounded-2xl tw-shadow-lg tw-p-1.5 tw-border tw-border-gray-300">
                        <div class="card-blog-image">
                            <img class="tw-rounded-t-2xl" src="{{$post->photo }}" alt="" class="img-fluid">
                        </div>
                        <div class="card-blog-body">
                            <div class="card-blog-meta text-muted tw-flex tw-gap-2 tw-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-w-5 tw-h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                <span class="meta-date tw-text-sm">{{$post->created_at->format('d/m/Y') }}</span>
                            </div>
                            <h3 class="card-blog-title--wrapper">
                                <span class="card-blog-title tw-text-base tw-font-bold" >{{$post->title }}</span>
                            </h3>
                        </div>
                    </a>
               @endforeach
            </div>
        </div>
    </div>
</section>