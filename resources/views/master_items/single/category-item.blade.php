@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{ route('category') }}" class="btn btn-secondary">Kembali ke Daftar Kategori Item</a>
            </div>
            <div class="card">
                <div class="card-header">Kategori Item</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th>Nama Kategori</th>
                            <td>:</td>
                            <td>{{$data->nama_kategori_item}}</td>
                        </tr>
                    </table>
                    <a class="btn btn-info" href="{{ route('category.form', ['method' => 'edit']) }}/{{$data->id}}">Edit</a>
                    <a class="btn btn-danger" href="{{url('master-items/delete')}}/{{$data->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection