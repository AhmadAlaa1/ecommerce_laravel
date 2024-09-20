@extends('layouts.app')

@section('Shop')
active
@endsection

@section('body')
  <!-- Single Page Header start -->
  <div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <form method="POST" action={{route('checkout.store')}}>
                                @csrf
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input name="firstname" type="text" class="form-control">
                                </div>
                                </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="form-item w-100">
                                            <label class="form-label my-3">Last Name<sup>*</sup></label>
                                            <input name="lastname" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Address <sup>*</sup></label>
                                    <input name="address" type="text" class="form-control" placeholder="House Number Street Name">
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Town/City<sup>*</sup></label>
                                    <input name="city" type="text" class="form-control">
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Country<sup>*</sup></label>
                                    <input name="country" type="text" class="form-control">
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Mobile<sup>*</sup></label>
                                    <input name="telephone" type="tel" class="form-control">
                                </div>
                                 <hr>
                             </form>
                    <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
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
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">{{$sum+3}}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                <label class="form-check-label" for="Payments-1">Check Payments</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="button" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection