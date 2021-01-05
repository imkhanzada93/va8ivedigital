@extends('layouts.app')

@section('content')
    <div class="card-header">
        Product Import
        <a href="{{ url('sale') }}">Sale</a>
    </div>
    <div class="card-body">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import Product</button>
            <a class="btn btn-warning" href="{{ url('sample/product.csv') }}">Export Product Sample</a>
        </form>
    </div>
@endsection
    