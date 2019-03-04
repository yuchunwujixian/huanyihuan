@if(!empty($tips))
    <div class="tips">
        <div class="carousel slide" data-ride="carousel"  data-interval="3000">
            <div class="carousel-inner" role="listbox">
                @foreach($tips as $v)
                    <div class="item @if($loop->index == 0) active @endif">
                        <div class="img-responsive">@if($v->url)<a href="{{ url($v->url) }}" class="text-info" target="_blank">{{ $v->title }}</a>@else{{ $v->title }} @endif</div>
                    </div>
                @endforeach
            </div>
        </div>
        <i class="glyphicon glyphicon-remove tips-del"></i>
    </div>
@endif