@if(!empty($banners) && $banners->count() > 0)
    <div class="carousel slide" data-ride="carousel"  data-interval="3000">
        <div class="carousel-inner" role="listbox">
            @foreach($banners as $v)
            <div class="item @if($loop->index == 0) active @endif">
                @if($v->url)
                    <a href="{{ url($v->url) }}" target="_blank"><img class="img-responsive" src="{{ $v->third_img_url }}" alt="{{ $v->title }}" data-img-default="/img/default_banner.png"></a>
                @else
                    <img class="img-responsive" src="{{ $v->third_img_url }}" alt="{{ $v->title }}" data-img-default="/img/default_banner.png">
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endif