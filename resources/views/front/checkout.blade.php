@extends('front.extends.layout')


@section('title','Namira | Home')

@section('content')
    @php
        if(session()->has('stock_msg')){
            echo '<script>alert("'.session()->get("stock_msg").'");location.replace("/cart");</script>';
        }
    @endphp


    <!-- Page Title -->
    <section class="page-title text-center">
      <div class="container">
        <h1 class=" heading page-title__title">checkout</h1>
      </div>
    </section> <!-- end page title -->


    <!-- Checkout -->
    <section class="section-wrap checkout">
      <div class="container relative">
        <div class="row">

          <div class="ecommerce col">
            <!--    
            <div class="row mb-30">
              <div class="col-md-8">
                <p class="ecommerce-info">
                  Returning Customer? 
                  <a href="#" class="showlogin">Click here to login</a>
                </p>
              </div>
            </div>-->

            <form name="checkout" class="checkout ecommerce-checkout row" action="/checkout/order" method="POST">
               @csrf 
              <div class="col-lg-7" id="customer_details">
                <div>
                  <h2 class="uppercase mb-30">billing details</h2>

                  <div class="row">
                    <div class="col-md-6">
                      <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field" id="billing_first_name_field">
                        <label for="billing_first_name">First Name
                          <abbr class="required" title="required">*</abbr>
                        </label>
                        <input type="text" class="input-text" placeholder  name="first_name" value="{{ old('first_name') ?? '' }}" id="billing_first_name">
                        <div style='color:#FF0000;'>{{ $errors->first('first_name') }}</div>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <p class="form-row form-row-last validate-required ecommerce-invalid ecommerce-invalid-required-field" id="billing_last_name_field">
                        <label for="billing_last_name">Last Name
                          <abbr class="required" title="required">*</abbr>
                        </label>
                        <input type="text" class="input-text" placeholder  name="last_name" id="last_name" value="{{ old('last_name') ?? '' }}">
                        <div style='color:#FF0000;'>{{ $errors->first('last_name') }}</div>
                      </p>
                    </div> 
                  </div> <!-- end name / last name -->


                  <p class="form-row form-row-wide address-field validate-required ecommerce-invalid ecommerce-invalid-required-field" id="billing_address_1_field">
                    <label for="billing_address_1">Address
                      <abbr class="required" title="required">*</abbr>
                    </label>
                    <input type="text" class="input-text" placeholder="Street address"  name="address" id="billing_address_1" value="{{ old('address') ?? '' }}">
                    <div style='color:#FF0000;'>{{ $errors->first('address') }}</div>
                  </p>

                  <!--
                  <p class="form-row form-row-wide address-field validate-required" id="billing_city_field" data-o_class="form-row form-row-wide address-field validate-required">
                    <label for="billing_city">Town / City
                      <abbr class="required" title="required">*</abbr>
                    </label>
                    <input type="text" class="input-text" placeholder="Town / City" value name="billing_city" id="billing_city">
                  </p>

                  <p class="form-row form-row-first address-field validate-state" id="billing_state_field" data-o_class="form-row form-row-first address-field validate-state">
                    <label for="billing_state">State / County</label>
                    <input type="text" class="input-text" placeholder value name="billing_state" id="billing_state">
                  </p>

                  <p class="form-row form-row-last address-field validate-required validate-postcode ecommerce-invalid ecommerce-invalid-required-field" id="billing_postcode_field" data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                    <label for="billing_postcode">Postcode / ZIP
                      <abbr class="required" title="required">*</abbr>
                    </label>
                    <input type="text" class="input-text" placeholder value name="billing_postcode" id="billing_postcode">
                  </p>-->

                  <div class="row">
                    <div class="col-md-6">
                      <p class="form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                        <label for="billing_phone">Phone
                          <abbr class="required" title="required">*</abbr>
                        </label>
                        <input type="text" class="input-text" placeholder  name="phone" id="billing_phone" value="{{ old('phone') ?? '' }}">
                        <div style='color:#FF0000;'>{{ $errors->first('phone') }}</div>
                      </p>
                    </div>
                    <!--
                    <div class="col-md-6">
                      <p class="form-row form-row-first validate-required validate-email" id="billing_email_field">
                        <label for="billing_email">Email Address
                          <abbr class="required" title="required">*</abbr>
                        </label>
                        <input type="text" class="input-text" placeholder value name="billing_email" id="billing_email">
                      </p>
                    </div>-->
                  </div>                      

                </div>
              </div> <!-- end col -->

              <!-- Your Order -->
              <div class="col-lg-5">
                <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                  <h2 class="uppercase">Your Order</h2>
                  <table class="table shop_table ecommerce-checkout-review-order-table">
                    <tbody>
                      @php
                          $user_id=Auth::guard('user_account')->user()->user_id;
                          $OrderCarts=\App\OrderCart::WHERE('user_id',$user_id)->WHERE('session_id',"!=",0)->get();
                          
                          if(count($OrderCarts)==0){
                                echo '<script>location.replace("/cart");</script>';
                          }  
                          $total=0;
                      @endphp  
                      @foreach ($OrderCarts as $OrderCart)
                        @php
                            $total+=$OrderCart->cart_price;
                        @endphp
                        <tr>
                            <th>{{ $OrderCart->p_name }}<span class="count"> x {{ $OrderCart->quantity }}</span></th>
                            <td>
                            <span class="amount">${{ $OrderCart->cart_price }}</span>
                            </td>
                        </tr>
                      @endforeach
   
                      <tr class="shipping">
                        <th>Shipping</th>
                        <td>
                          <span>300</span>
                          <input type="hidden" name="shipping_fee" value="300"/>
                        </td>
                      </tr>
                      <tr class="order-total">
                        <th><strong>Total Amount</strong></th>
                        <td>
                          <strong><span class="amount">${{ $total+300 }}</span></strong>
                          <input type="hidden" name="order_total" value="{{ $total+300 }}"/>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div id="payment" class="ecommerce-checkout-payment">
                    <h2 class="uppercase">Payment Method</h2>
                    <ul class="payment_methods methods">
                      <!--      
                      <li class="payment_method_bacs">
                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked">
                        <label for="payment_method_bacs">Direct Bank Transfer</label>
                        <div class="payment_box payment_method_bacs">
                          <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
                        </div>
                      </li>

                      <li class="payment_method_cheque">
                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque">
                        <label for="payment_method_cheque">Cheque payment</label>
                        <div class="payment_box payment_method_cheque">
                          <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                        </div>
                      </li>-->

                      <li class="payment_method_paypal">
                        <input id="payment_method_paypal" type="radio" class="input-radio" name="pay_way" value="ecpay"" checked="checked">
                        <label for="payment_method_paypal">ECPAY(綠界付款)</label>
                        <img src="img/shop/paypal.png" alt="">
                        <div class="payment_box payment_method_paypal">
                          <p>綠界科技Ecpay是第三方支付領導品牌,提供金流、物流、電子發票、 跨境電商、資安聯防一站購足服務</p>
                        </div>
                      </li>

                    </ul>
                    <div class="form-row place-order">
                      <input type="submit"  class="btn btn-lg btn-color btn-button" id="place_order" value="Place order">
                    </div>
                  </div>
                </div>
              </div> <!-- end order review -->
            </form>

          </div> <!-- end ecommerce -->

        </div> <!-- end row -->
      </div> <!-- end container -->
    </section> <!-- end checkout -->


    @endsection