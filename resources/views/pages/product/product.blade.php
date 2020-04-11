@extends('layouts')
@section('content')
    <br>
@if(empty($product))
    <div class="text-center">
        <h3>No products !</h3>
    </div>
@endif

    <div class="card">

    

    <div class="row">
        <div class="col-md-5 col-sm-6">
            <?php $images = json_decode($product['images']); ?>
            <div class="carousel slide" id="main-carousel_{{ $product['id'] }}" data-ride="carousel" data-interval="false">
                <ol class="carousel-indicators">
                <?php $i = 0; foreach($images as $image){ if(file_exists('./uploads/'.$image)){ ?>
                    <li data-target="#main-carousel_{{ $product['id'] }}" data-slide-to="{{ $i }}" class="@if($i == 0) active @endif"></li>
                <?php $i++; } } ?>
                </ol><!-- /.carousel-indicators -->
                
                <div class="carousel-inner">

                <?php $j=0; foreach($images as $image){ if(file_exists('./uploads/'.$image)){ ?>
                    <div class="text-center carousel-item @if($j == 0) active @endif">
                        <img class="d-block img-fluid product-page-slider-image" src="{{ url('/') }}/uploads/{{ $image }}" alt="Image" style="margin: 0 auto">
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
        <div class="col-md-7 col-sm-6">
            <div class="card-body">
                <div class="row">
                    <div class="col col-12">
                        <h5> {{ $product['title'] }}</h5>
                    </div>
                    <div class="col col-12">
                        
                        <b>Price : </b>&#8377; {{ number_format($product['price'],2) }} <br>
                        <b>Owner : </b>{{ $product['user']['f_name'].' '.$product['user']['l_name'] }} <br>
                        <b>Email : </b>{{ $product['user']['email'] }} <br>
                        <b>Mobile : </b>{{ $product['user']['mobile'] }} <br>
                        <b>Listed At : </b>{{ date('d-M-Y h:i A',strtotime($product['created_at'])) }} <br>
                        <b>Description : </b>{!! $product['description'] !!}
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
        
        
    </div>

<br>

@if (!Session::has('user_login'))
    <div class="row">
        <div class="col text-center">
            <p>
                Please login to comment.
            </p>
            <a class="btn btn-primary btn-sm" href="{{ url('/') }}/login">Login</a>
        </div>
    </div>
@endif


@if (Session::has('user_login'))
    <div class="card">
        
        <div class="card-body" id="comments"></div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
        <h5>Add new comment </h5>
            <textarea name="comment" id="comment" class="form-control"></textarea>
            <div class="error" id="comment-empty"></div>
            <br>
            <div class="text-right">
                <button class="btn btn-primary btn-sm" id="add-comment">Add Comment</button>
            </div>
        </div>
    </div>
@endif
    
    
@endsection

@section('js')
    @if (Session::has('user_login'))
        <script>
            var product_id = "{{ $product['id'] }}";
            get_comments();

            setInterval(() => {
                get_comments();
            }, 3000);
            
            function get_comments(){
                $.ajax({
                    url : '{{ url('/') }}/get-comments?id='+product_id,
                    method : 'GET',
                    success(data){
                        comments = JSON.parse(data);
                        if(comments.length > 0){
                            var html = '';
                            for(var i = 0; i < comments.length; i++){
                                //console.log(comments[i]);
                                html += '<div> <div><b>'+comments[i].f_name+' '+comments[i].l_name+' </b> at - <small>'+comments[i].created_at+'</small></div>'+comments[i].text+'</div> <hr>';
                                
                            }
                            
                            $('#comments').html(html);


                        }else{
                            $('#comments').html('No comments');
                        }
                    }
                })
            }

            $('#add-comment').click(function(){
                $('#comment-empty').html('');
                var comment = $('#comment').val();
                
                if(!comment){
                    $('#comment-empty').html('Comment is empty');
                }else{
                    var user_id = "{{ session('user_login') }}";
                    $.ajax({
                        url : '{{ url('/') }}/add-comment',
                        method : 'POST',
                        data : {'product_id' : product_id, 'user_id' : user_id,'comment' : comment},
                        success(data){
                            if(data == 1){
                                $('#comment').val('');
                                get_comments();
                            }else{
                                $('#comment-empty').html('Comment not added. Please try again');
                            }
                        }
                    });
                }
            })
        </script>
    @endif
@endsection
