@extends('layouts.app')

@section('Shop')
active
@endsection

@section('body')


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <ol class="justify-content-center mb-0"></ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">New Products</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <form method="POST" action={{route('shop.store')}}>
                            @csrf
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="sorting" selected class="border-0 form-select-sm bg-light me-3">
                                    <option value="nothing">Nothing</option>
                                    <option value="name">name</option>
                                    <option value="price">Price</option>
                                </select>
                                <button type="submit" class="btn btn ">Sort</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
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
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            @foreach ($products as $product)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src={{$product->img}} class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->category->name}}</div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{$product->name}}</h4>
                                        <p>{{$product->description}}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">{{$product->price}}$</p>
                                            <a href={{route('shop.show',$product->name)}} class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="col-12">
                                <div class="pagination-wrapper d-flex justify-content-center mt-5">
                                    {{$products->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                            <style>
                                .pagination-wrapper ul.pagination {
                                    display: flex;            /* Force horizontal layout */
                                    justify-content: center;   /* Center the items */
                                }

                                .pagination-wrapper .page-item {
                                    margin: 0 5px;             /* Add horizontal spacing */
                                }    
                            </style>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
