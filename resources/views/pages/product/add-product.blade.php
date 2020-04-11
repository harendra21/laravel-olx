@extends('layouts')
@section('content')
    

@if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

    <div class="row">
        <div class="col text-right">
            <a class="btn btn-sm btn-primary" href="{{ url('/') }}/my-products">View All</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form class="form-group" action="{{ url('/') }}/do-add-product" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Product Title" value={{old('title')}}>
                @if ($errors->has('title'))
                    <div class="error">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group">
                <textarea id="tiny" name="description" class="form-control">{{old('description')}}</textarea>
                @if ($errors->has('description'))
                    <div class="error">{{ $errors->first('description') }}</div>
                @endif
            </div>

            

            
            <div class="form-group">
                <input type="number" name="price" class="form-control" placeholder="Selling Price" value={{old('price')}}>
                @if ($errors->has('price'))
                    <div class="error">{{ $errors->first('price') }}</div>
                @endif
            </div>

            <div class="form-group">
                <input type="file" name="images[]" multiple accept="image/*">
                @if ($errors->has('images'))
                    <div class="error">{{ $errors->first('images') }}</div>
                @endif
            </div>

            
            <div class="form-group">
                <input class="btn btn-lg btn-primary btn-block btn-sm" type="submit" value="Add Product">
            </div>

            
            </form><!-- /form -->
        </div>
    </div>

@endsection
@section('js')
    
@endsection