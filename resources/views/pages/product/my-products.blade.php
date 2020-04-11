@extends('layouts')
@section('content')
    <br>
    <div class="row">
        <div class="col text-right">
            <a class="btn btn-sm btn-primary" href="{{ url('/') }}/add-product">Add New</a>
        </div>
    </div>
    <br>

    @if(count($products) <= 0)
        <div class="text-center">
            <h3>No products !</h3>
        </div>
    @endif
        @foreach($products as $product)

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-12">
                        <b>Title -</b> {{ $product['title'] }}
                    </div>
                    <div class="col-sm-6">
                        <b>Description -</b> {!! $product['description'] !!}
                        <div class="text-right">
                            <small><b>Date -</b> {{ date('d-M-Y h:i A',strtotime($product['created_at'])) }}</small>
                        </div>

                        <a href="{{ url('/') }}/p/{{ $product['url'] }}" class="btn btn-sm btn-primary" target="_blank">Comments - {{ $product['comments'] }}</a>

                        <a href="{{ url('/') }}/p/{{ $product['url'] }}" class="btn btn-sm btn-primary" target="_blank">View</a>


                        <a href="{{ url('/') }}/delete-product/{{ $product['id'] }}" class="btn btn-sm btn-danger">Delete</a>

                    </div>
                    <div class="col-sm-6">
                        <?php $images = json_decode($product['images']); ?>
                        <div class="carousel slide" id="main-carousel_{{ $product['id'] }}" data-ride="carousel" data-interval="false">
                            <ol class="carousel-indicators">
                            <?php $i = 0; foreach($images as $image){ if(file_exists('./uploads/'.$image)){ ?>
                                <li data-target="#main-carousel_{{ $product['id'] }}" data-slide-to="{{ $i }}" class="@if($i == 0) active @endif"></li>
                            <?php $i++; } } ?>
                            </ol><!-- /.carousel-indicators -->
                            
                            <div class="carousel-inner">

                            <?php $j=0; foreach($images as $image){ if(file_exists('./uploads/'.$image)){ ?>
                                <div class="carousel-item @if($j == 0) active @endif">
                                    <img class="d-block img-fluid" src="{{ url('/') }}/uploads/{{ $image }}" alt="Image">
                                </div>
                            <?php $j++; } } ?>
                            </div><!-- /.carousel-inner -->
                            
                            <a href="#main-carousel_{{ $product['id'] }}" class="carousel-control-prev" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="sr-only" aria-hidden="true">Prev</span>
                            </a>
                            <a href="#main-carousel_{{ $product['id'] }}" class="carousel-control-next" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="sr-only" aria-hidden="true">Next</span>
                            </a>
                        </div><!-- /.carousel -->
                    </div>
                    
                </div>
            </div>
        </div>
        <br>
           
        @endforeach

@endsection