@extends('layout.base')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body justify-content-center">
            <h4 class="card-title">Add New Product Category</h4>
            <p class="card-description">
                Insert new product category here
            </p>
            <form action="/category" method="post" class="form-inline d-flex justify-content-between">
                @csrf
                @method('post')
                <label class="sr-only" for="inlineFormInputName2">Category</label>
                <input type="text" class="form-control mb-2" name="name" id="inlineFormInputName2"
                    placeholder="Electronic">
                <button type="submit" class="btn btn-primary mb-2 ms-2">Add Category</button>

                @if ($errors->has('category'))
                    <div class="col-12 alert alert-danger">
                        <p>{{ $errors->first('category') }}</p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection