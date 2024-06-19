<section class="home-slider position-relative mb-30">
    <div class="container">
        {{--background Slide--}}
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                    @if ($Slides->isEmpty())
                        <div class="single-hero-slider single-animation-wrap"
                             style="background-image: url('{{ Illuminate\Support\Facades\Storage::url('public/upload/no-image.svg') }}'); width: 300px; height: 150px;">
                        </div>
                    @else
                        @foreach ($Slides as $item)
                            <div class="single-hero-slider single-animation-wrap"
                                    style="background-image: url({{Illuminate\Support\Facades\Storage::url($item->slide_image)}})">
                                <div class="slider-content">
                                    <h1 class="display-2 mb-40">
                                        {{$item->slide_title}}
                                    </h1>
                                    <p class="mb-65">{{$item->slide_text}}</p>
                                    {{--idont know wha--}}
                                    <form class="form-subcriber d-flex">
                                        <input type="email" placeholder="Your emaill address" />
                                        <button class="btn" type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                     @endif


                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        {{--End background Slide--}}
    </div>
</section>
