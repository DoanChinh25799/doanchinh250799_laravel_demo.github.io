<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8 offset-2">
            <div class="form-group">
                <label for="a_name">Tên bài viết</label>
                <input type="text" name="a_name" class="form-control" placeholder="tên bài viết"
                       value="{{old('a_name', isset($article->a_name)?$article->a_name:'')}}">
                @error('a_name')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="a_description">Giới thiệu</label>
                <textarea name="a_description" class="form-control" placeholder="giới thiệu ngắn về bài viết" cols="30"
                          rows="3">{{old('a_description', isset($article->a_description)?$article->a_description:'')}}
                </textarea>
                @error('a_description')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="a_content">Nội dung bài viết</label>
                <textarea id="a_content" name="a_content" class="form-control" placeholder="mô tả nội dung bài viết" cols="30"
                          rows="5" >{{old('a_content', isset($article->a_content)?$article->a_content:'')}}
                </textarea>
                @error('a_content')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="a_title_seo">Meta Title</label>
                <input type="text" name="a_title_seo" class="form-control" placeholder="meta title"
                       value="{{old('a_title_seo', isset($article->a_title_seo)?$article->a_title_seo:'')}}">
            </div>
            <div class="form-group">
                <label for="a_description_seo">Meta Description</label>
                <input type="text" name="a_description_seo" class="form-control" placeholder="meta description"
                       value="{{old('a_description_seo', isset($article->a_description_seo)?$article->a_description_seo:'')}}">
            </div>
            <div class="form-group">
                <label for="a_avatar">Ảnh minh họa</label>
                <input id="input_img" type="file" name="a_avatar" class="form-control" placeholder="ảnh minh họa" onchange="readURL(this)" value="{{old('a_avatar',isset($article->a_avatar)?get_image($article->a_avatar):'')}}">
            </div>
            <div class="form-group">
                @if(isset($article->a_avatar))
                <img id="output_img" name="output_img" src="{{pare_url_file($article->a_avatar)}}" alt="" style="width: 200px; height: 100%">
                @else
                    <img id="output_img" name="output_img" src="{{asset('images/img-default.jpg')}}" alt="" style="width: 200px; height: 100%">
                @endif
            </div>
            <div class="form-group">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
</form>

@section('ckeditor')
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('a_content',{
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@stop
