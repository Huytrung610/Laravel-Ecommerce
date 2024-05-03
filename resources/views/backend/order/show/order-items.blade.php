<?php
    $orderedProducts = $cartProducts['cart-products'];
?>

@if(!empty($orderedProducts))
    <section class="confirmation_part section_padding" style="margin-top: 20px">
        <div class="order_boxes">
            <div class="row tw-flex tw-justify-center">
                <div class="col-lg-6 col-lx-6 tw-bg-gray-200 tw-py-4" style="flex: 0 0 49%;">
                    <div class="oder-items-info order-info">
                        <h4 class="text-center pb-4 tw-font-bold">{{ __("ORDER ITEMS INFORMATION") }}</h4>
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                              </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($orderedProducts as $key => $product)
                                <?php
                                    $productName = !empty($product->code_variant) ? $product->product->title . ' ' . $product->product_variant->name : $product->product->title;
                                ?>
                              <tr>
                                <th scope="row">{{ $product->product_id }}</th>
                                <td><a href="{{route('product.edit',[$product->product_id])}}">{{ $productName }}</a></td>
                                <td class="tw-text-center">{{ $product->quantity }}</td>
                                <td>{{ number_format($product->price,0)}}đ </td>
                                <td>{{ number_format($product->amount,0)}}đ </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
