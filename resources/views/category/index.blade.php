@extends('layout.base')

@section('content')
<!-- Add new Category -->
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body justify-content-center">
            <h4 class="card-title">Add New Product Category</h4>
            <p class="card-description">
                Insert new product category here
            </p>
            <form action="{{route('category.store')}}" method="post" class="form-inline d-flex justify-content-between">
                @csrf
                @method('post')
                <label class="sr-only" for="inlineFormInputName2">Category</label>
                <input type="text" class="form-control mb-2" name="name" id="inlineFormInputName2"
                    placeholder="Electronic">
                <button type="submit" class="btn btn-primary mb-2 ms-2">Add Category</button>
            </form>
        </div>
    </div>
</div>

<!-- Showing Category Data -->
<div class="col-12 grid-margin stretch-card my-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List Category</h4>
            <p class="card-description">
                See available product category in our shop
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-left">{{ $item->name }}</td>
                            <!-- Action -->
                            <td class="d-flex justify-content-center">
                                <form action="{{url('dashboard')}}/category/{{ $item->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="{{url('dashboard/')}}/category/{{ $item->id }}/edit">
                                        <button type="button" class="btn btn-info btn-icon-text mx-2">
                                            Edit
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-icon-text mx-2">
                                        <i class="typcn typcn-trash btn-icon-prepend"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">There's no category</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection