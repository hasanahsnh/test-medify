@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{ route('category.form', ['method' => 'new']) }}" class="btn btn-secondary">+ Kategori Item Baru</a>
            </div>
            <div class="card">
                <div class="card-header">Daftar Kategori Item</div>

                <div class="card-body">
                    @include('master_items.index.filter-item-category')
                    @include('master_items.index.table-item-category')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@include('master_items.index.js')
@endsection