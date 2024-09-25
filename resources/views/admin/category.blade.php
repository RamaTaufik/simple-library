@extends('layouts.app-admin', ['page' => 'category'])

@section('title')
Kelola Kategori ● ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Categories</h6>
<h1>Kelola Kategori</h1>
<div class="container fluid">
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Kategori Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category-create') }}" class="mb-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name">{{ __('Nama Kategori') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Tambah') }}
                            </button>
                            <button type="button" class="ms-2 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category-update') }}" class="mb-4" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name">{{ __('Nama Kategori') }}</label>
                                <input id="name-edit" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input id="category_id" type="hidden" name="category_id">
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
            <a class="nav-link" href="{{ route('admin.book-inactive') }}">Buku Non-aktif</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Kelola Kategori</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <button class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i> Tambah</button>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <form action="{{ route('admin.category-delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-warning p-0 px-2" onclick="edit({{json_encode($item)}})" data-bs-toggle="modal" href="#editModal"><i class="fa-solid fa-pencil"></i></a>
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger p-0 px-2"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$category->links()}}
    </div>
</div>
@endsection

@section('script')
<script>
    function edit(array) {
        document.getElementById('name-edit').value = array['name'];
        document.getElementById('category_id').value = array['id'];
    }
</script>
@endsection