@extends('dashboard.admin.layouts.app')

@section('page_title', 'Edit Blog Article')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hi Admin Welcome Back</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.category.view') }}">{{ $category->title }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.article.view', ['id' => $category->id]) }}">Blog
                Articles</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- Messages -->
          @include('dashboard.admin.includes.messages')

          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Blog Article</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('blog.article.update', ['id' => $article->id]) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <input type="hidden" name="category_id" value="{{ $category->id }}">
              <div class="card-body">
                <div class="form-group">
                  <label for="inputPageTitle">Title</label>
                  <input type="text" name="page_title" class="form-control" id="inputPageTitle"
                    placeholder="Enter page title" value="{{ $article->page_title }}">
                </div>

                <div class="form-group">
                  <label for="inputMeta">Meta Description</label>
                  <textarea name="meta_desc" id="inputMeta" rows="3"
                    class="form-control">{{ $article->meta_desc }}</textarea>
                </div>

                <div class="form-group">
                  <label for="inputTitle">Title</label>
                  <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Enter title"
                    value="{{ $article->title }}">
                </div>

                <div class="form-group">
                  <label for="editor">Description</label>
                  <textarea name="description" id="editor" rows="3"
                    class="form-control">{{ $article->description }}</textarea>
                </div>

                <div class="form-group">
                  <label for="inputFile">Photo</label>
                  <input type="file" name="image" class="form-control" id="inputFile">
                  <figure class="figure">
                    <img src="{{ url('/storage/'.$article->image) }}" class="figure-img img-fluid rounded img-thumbnail"
                      alt="Photo">
                  </figure>
                </div>

                <div class="form-group">
                  <label for="inputStatus">Status</label>
                  <select class="form-control" name="status" id="inputStatus">
                    <option value="1" @if($article->status == 1) {{ __('selected') }} @endif>Active</option>
                    <option value="0" @if($article->status == 0) {{ __('selected') }} @endif>Deactive</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('blog.article.view', ['id' => $category->id]) }}"
                  class="btn btn-default float-right">Cancel</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@section('bottom_script')
<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
  // CKEditor configuration //
  ClassicEditor.create(document.querySelector("#editor"))
      .then((editor) => {
          console.log(editor);
      })
      .catch((error) => {
          console.error(error);
      });
  // END / CKEditor configuration //
</script>
@endsection