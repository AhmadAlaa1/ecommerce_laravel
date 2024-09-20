@extends('layouts.app')

@section('Shop')
active
@endsection


@section('body')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="/{{$product->img}}" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3">{{$product->name}}</h4>
                        <p class="mb-3">Category: {{$product->category->name}}</p>
                        <h5 class="fw-bold mb-3">{{$product->price}}$</h5>
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="mb-4">{{$product->description}}</p>
                    
                        <form method="POST" action={{route('cart.store')}}>
                            @csrf
                            <input value={{$product->name}} name="name" type="hidden">
                            <button class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                        </form>    

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        @foreach($comments as $comment)
                                        <p class="mb-2" style="font-size: 14px;">{{$comment->created_at->format('y-m-d')}}</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>{{$comment->user->name}}</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>{{$comment->content}}</p>
                                         @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!Session::has('username'))
                         <a href={{route('home.login')}} class="w-100 btn form-control border-secondary py-3 bg-white text-primary">Login To Comment</a>
                    @else
                    <form method="POST" action={{route('shop.comment',$product->name)}}>
                        @csrf
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea name="usercomment"  class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between py-3 mb-5">
                                    <button class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="input-group w-100 mx-auto d-flex mb-4">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="mb-4">
                            <h4>Categories</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <form method="POST" action={{route('shop.store')}}>
                                    @foreach($categories as $category)
                                    @csrf
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <button name="button_category" class="btn" value={{$category->name}}><img src="https://cdn-icons-png.flaticon.com/128/121/121863.png" style="width: 10%;margin-right:1rem;" alt="">{{$category->name}}</button>
                                        </div>
                                    </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-4">Featured products</h4>
                        @foreach($randomProducts as $randomProduct)
                        <div class="d-flex align-items-center mt-2 justify-content-start">
                            <div class="rounded" style="width: 100px; height: 100px;">
                                <a href={{route('shop.show',$randomProduct->name)}}>
                                    <img src="/{{$randomProduct->img}}" class="img-fluid rounded" alt="Image">
                                </a>    
                            </div>
                            <div>
                                <a href={{route('shop.show',$randomProduct->name)}} class="mb-2">{{$randomProduct->name}}</a>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">{{$randomProduct->price}}$</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <a href={{route('shop.index')}} class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection