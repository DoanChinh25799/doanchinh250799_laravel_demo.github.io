<form action="" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Tên danh mục</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="tên danh mục" value="{{old('name', isset($category->c_name)?$category->c_name:'')}}">
        @error('name')
        <hr>
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="icon">Icon</label>
        <input type="text" name="icon" id="icon" class="form-control" placeholder="icon" value="{{old('icon', isset($category->c_icon)?$category->c_icon:'')}}">
        @error('icon')
        <hr>
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="meta_title">Meta-Title</label>
        <input type="text" name="meta_title" class="form-control" placeholder="meta_title" value="{{old('meta_title', isset($category->c_title_seo)?$category->c_title_seo:'')}}">
    </div>
    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <input type="text" name="meta_description" class="form-control" placeholder="meta_description" value="{{old('meta_description', isset($category->c_description_seo)?$category->c_description_seo:'')}}">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
</form>
