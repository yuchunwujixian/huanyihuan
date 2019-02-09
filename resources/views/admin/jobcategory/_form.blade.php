<div class="form-group">
    <label for="tag" class="col-md-3 control-label">职位名称</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="title">
    </div>
</div>
<div class="form-group">
    <label for="pid" class="col-md-3 control-label">所属分类</label>
    <div class="col-md-6">
        <select class="form-control" name="parent_id">
            <option value="0">顶级分类</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">
                    @for($i=0;$i<$category->depth;$i++)
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    @endfor
                    {{$category->title}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label for="status" class="col-md-3 control-label">是否显示</label>
    <div class="col-md-6">
        <input type="radio"  name="status" value="1" checked>是
        <input type="radio"  name="status"  value="0">否
    </div>
</div>
<div class="form-group">
    <label for="sort" class="col-md-3 control-label">排序</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="sort" value="0">
    </div>
</div>


