<div class="box-body">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12">
                <label for="">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="">URL</label>
                <input type="text" name="url" id="url" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::normalTextarea('content', 'Nội dung bài viết', $errors) !!}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">
                @mediaSingle('news_avatar', null, null, 'Ảnh bài viết')
            </div>
        </div>
    </div>
</div>
