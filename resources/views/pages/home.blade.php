@extends('layouts')
@section('content')
    



<br>


@if(count($products) <= 0)
        <div class="text-center">
            <h3>No products !</h3>
        </div>
    @endif
        <div class="row">
            @foreach($products as $product)

                <div class="col-md-4 col-sm-6">
                <div class="card">

                <?php $images = json_decode($product['images']); ?>
                <a href="{{ url('/') }}/p/{{ $product['url'] }}">
                    <img class="d-block img-fluid home-page-slider-image" src="{{ url('/') }}/uploads/{{ $images[0] }}" alt="Image">
                </a>    
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-12">
                                <h5> {{ $product['title'] }}</h5>
                            </div>
                            <div class="col col-12">
                                 {{ substr(strip_tags($product['description']),0,120) }}...
                                <div class="text-right">
                                    <small>
                                        {{ date('d-M-Y h:i A',strtotime($product['created_at'])) }}
                                    </small>
                                </div>
                            </div>
                            <div class="col col-6 ">
                                <a class="btn btn-sm btn-primary" href="{{ url('/') }}/p/{{ $product['url'] }}">&#8377; {{ number_format($product['price'],2) }}</a>
                            </div>
                            <div class="col col-6 text-right">
                                <a class="btn btn-sm btn-success" href="{{ url('/') }}/p/{{ $product['url'] }}">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            @endforeach
        </div>
        

@endsection