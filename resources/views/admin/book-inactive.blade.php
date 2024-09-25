@extends('layouts.app-admin', ['page' => 'book-inactive'])

@section('title')
Buku Non-aktif ● ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Inactive Books</h6>
<h1>Kelola Buku Non-aktif</h1>
<div class="container fluid">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.book-update') }}" class="mb-4" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="title">{{ __('Nama Buku') }}</label>
                                <input id="title-edit" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="author">{{ __('Penulis') }}</label>
                                <input id="author-edit" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required autocomplete="author" autofocus>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="category_id">{{ __('Kategori') }}</label>
                                <select id="category_id-edit" class="form-select @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') }}" required autocomplete="category_id" autofocus>
                                    <option value="" hidden disabled selected> Pilih kategori</option>
                                    @foreach ($category as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="published_year">{{ __('Tahun Terbit') }}</label>
                                <input id="published_year-edit" type="number" class="form-control @error('published_year') is-invalid @enderror" name="published_year" value="{{ old('published_year') }}" required autocomplete="published_year" autofocus>
                                @error('published_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input id="book_id" type="hidden" name="book_id">
                        <div class="d-flex flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Ubah') }}
                            </button>
                            <button type="button" class="ms-2 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.book') }}">Kelola Buku</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Buku Non-aktif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category') }}">Kelola Kategori</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <div class="d-flex justify-content-between">
            <form action="{{ route('admin.book') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Buku">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->author}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->published_year}}</td>
                    <td>@if ($item->is_active) Aktif @else Non-aktif @endif</td>
                    <td>
                        <form action="{{ route('admin.book-delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-secondary p-0 px-2" href="{{ route('admin.book-activate', $item->id) }}">Aktifkan</a>
                            <a class="btn btn-warning p-0 px-2" onclick="edit({{json_encode($item)}})" data-bs-toggle="modal" href="#editModal"><i class="fa-solid fa-pencil"></i></a>
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger p-0 px-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    function edit(array) {
        document.getElementById('title-edit').value = array['title'];
        document.getElementById('author-edit').value = array['author'];
        document.getElementById('category_id-edit').value = array['category_id'];
        document.getElementById('published_year-edit').value = array['published_year'];
        document.getElementById('book_id').value = array['id'];
    }
</script>
@endsection