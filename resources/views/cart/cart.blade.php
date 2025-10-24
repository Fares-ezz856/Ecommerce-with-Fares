@extends('layouts.master')
@section('content')
<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove">
                                    </th>
									<th class="product-image">Product Image</th>
									<th class="product-name">name</th>
									<th class="product-price">price</th>
                                    <th class="product-quantity">quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($carts as $cart )
                                <tr class="table-body-row">
                                    <td> <a href="/deletecartitem/{{ $cart->id }}"><i class="far fa-window-close"></i></a></td>
									<td class="product-image"><img src="{{ asset($cart->product->imagepath) }}" alt=""></td>
									<td class="product-name">{{ $cart->product->name }}</td>
									<td class="product-price">{{ $cart->product->price }}</td>
									<td class="product-quantity">{{ $cart->quantity }}</td>
									<td class="product-total">{{ number_format( $cart ->product->price * $cart ->quantity,2) }}$</td>
								</tr>
                                @endforeach


							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>

								<tr class="total-data">
									<td><strong>Total: </strong></td>
									<td class="product-total">
                                        {{ number_format($carts->sum(function($cart) {
                                            return $cart->product->price * $cart->quantity;
                                        }), 2) }}$
                                    </td>

								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">

							<a href="/completeorder" class="boxed-btn black">Check Out</a>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
@endsection
