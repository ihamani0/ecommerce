<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>
            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
        </div>

        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach($Categories as $item)
                    <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="shop-grid-right.html"><img src="{{\Illuminate\Support\Facades\Storage::url($item->category_img)}}" alt="" /></a>
                        </figure>
                        <h6><a href="shop-grid-right.html">{{$item->category_name}}</a></h6>
                        <span>{{$item->countProductsForEachCategory()}} items</span>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
