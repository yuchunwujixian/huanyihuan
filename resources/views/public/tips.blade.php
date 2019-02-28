<div class="tips">
    <div id="carousel-ad" class="carousel slide" data-ride="carousel"  data-interval="3000">
        <div class="carousel-inner" role="listbox">
            @foreach($tips as $v)
                <div class="item @if($loop->index == 0) active @endif">
                    <div class="img-responsive">{{ $v->title }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <i class="glyphicon glyphicon-remove tips-del"></i>
</div>