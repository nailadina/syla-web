@extends('layout.base')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card mb-3">
        <div class="card-body justify-content-center">
            <h4 class="card-title">Add New Product Product</h4>
            <div class="d-flex justify-content-between">
              <div class="description">
            <p class="card-description">
                Insert new product here
            </p>
          </div>
          <div class="tomboladd">
            <a href="{{ url('dashboard/product/create') }}" type="submit" class="btn btn-primary">Tambah Product</a>
          </div>
          </div>
        </div>
    </div>
  </div>
  
  <div class="card mb-4">
    <div class="card-header">
        Data Product
    </div>
    <div class="table-responsive">
        <table class="table table-striped m-3">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $key => $item)
  
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <form action="{{ url('dashboard/product',$item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{ url('dashboard')}}/product/{{$item->id}}/edit" type="submit" class="btn btn-warning btn-sm mx-2">Edit Product</a>
                            <input type="submit" class="btn btn-danger btn-sm mx-2" value="DELETE">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection