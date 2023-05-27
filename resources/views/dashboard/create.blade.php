@extends('layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-dark">
    <h1 class="text-center">Buat Postingan Baru</h1>
</div>
<div class="col-lg-8">
    <form action="store" method="post">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" id="slug" name="slug" disabled>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Kategori</label>
          <select class="form-select" name="category_id">
            <option selected disabled>Pilih Kategori</option>
            @foreach ($categories as $category)    
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Deskripsi</label>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body"></trix-editor>
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Buat Postingan</button>
    </form>
</div>

<script>
    const title = document.querySelector("#title");
const slug = document.querySelector("#slug");

title.addEventListener("change", function () {
    fetch("/dashboard/create/checkSlug?title=" + title.value)
        .then((response) => response.json())
        .then((data) => (slug.value = data.slug));
});

document.addEventListener("trix-file-accept", function(e){
    e.preventDefault();
});
</script>
@endsection