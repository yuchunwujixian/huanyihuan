@if(!empty($banners))
    <div class="carousel slide" data-ride="carousel"  data-interval="3000">
        <div class="carousel-inner" role="listbox">
            @foreach($banners as $v)
            <div class="item @if($loop->index == 0) active @endif">
                @if($v->url)
                    <a href="{{ url($v->url) }}" target="_blank"><img class="img-responsive" src="{{asset('storage/'.$v->img_url)}}" alt="{{ $v->title }}"></a>
                @else
                    <img class="img-responsive" src="{{asset('storage/'.$v->img_url)}}" alt="{{ $v->title }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endif