@extends('layout.base')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body justify-content-center">
            <h4 class="card-title">Edit Product Category</h4>
            <p class="card-description">
                Edit Product Category here
            </p>
            <form action="{{url('dashboard')}}/category/{{$category->id}}" method="post" class="form-inline d-flex justify-content-between">
                @csrf
                @method('patch')
                <label class="sr-only" for="inlineFormInputName2">Category</label>
                <input type="text" class="form-control mb-2" name="name" id="inlineFormInputName2"
                    placeholder="{{$category->name}}" value={{$category->name}}>
                <button type="submit" class="btn btn-primary mb-2 ms-2">Edit Category</button>

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