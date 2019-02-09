<div class="form-group">
    {{ Form::label('title', '福利名称', array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-6">
        {{ Form::text('title', $title) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('status', '是否可用', array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-6">
        {{ Form::radio('status', '1', ($status)?true:false) }}是&nbsp;&nbsp;
        {{ Form::radio('status', '0', ($status == 0)?true:false) }}否
    </div>
</div>