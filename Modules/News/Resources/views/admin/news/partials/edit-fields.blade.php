<div class="box-body">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <label for="">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$news->title}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="">URL</label>
                <input type="text" name="url" id="url" class="form-control" value="{{$news->url}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::normalTextarea('content', 'Nội dung bài viết', $errors, $news) !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">
                @mediaSingle('news_avatar',$news, null, null, 'Ảnh bài viết')
            </div>
        </div>
    </div>
</div>
