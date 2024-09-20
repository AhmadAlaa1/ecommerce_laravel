@extends('layouts.app')

@section('Shop')
active
@endsection

@section('body')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    @php $sum=0; @endphp
                    @foreach($orders as $order)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="/{{$order->img}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{$order->name}}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{$order->price}}$</p>
                        </td>
                        <td>
                            <form method="POST" action={{route('cart.update')}}>
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="item" value="{{$order->name}}">
                                <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </form>
                        </td>
                        @php $sum+=$order->price; @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">${{$sum}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: $3.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4">${{$sum+3}}</p>
                    </div>
                    @if(!Session::has('username'))
                        <a href={{route('home.login')}} class="w-100 btn form-control border-secondary py-3 bg-white text-primary mt-auto">Login To Complete Your Payment</a>
                    @else
                        <a href={{route('checkout.index')}} class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection