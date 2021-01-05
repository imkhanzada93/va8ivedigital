@extends('layouts.app')

@section('content')
    <div class="card-header">
        Sale
    </div>
    <div class="card-body">
        @foreach ($products as $product)
            <button class="btn btn-success" onclick="addProduct('{{ $product->id }}', '{{ $product->name }}', '{{ $product->price }}', '{{ $product->available }}')">{{ $product->name }}</button>
        @endforeach

        <br/><br/>
        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="saleTbl">

            </tbody>
            <tfoot id="saleTblFoot">

            </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script>
        function buy_2_get_1_free(id, price){
            $('#product_'+id).children(':nth-child(1)').html('');

            var qty = $('#product_'+id).children(':nth-child(4)').html();
            var discount = parseInt(qty/3) * price;

            $('#product_'+id).children(':nth-child(4)').html(qty);
            $('#product_'+id).children(':nth-child(5)').html(discount);
            $('#product_'+id).children(':nth-child(6)').html(((qty*price)-discount));
            $('#product_'+id).addClass("buy_2_get_1_free");
            grandTotal();
        }

        function buy_1_get_half_off(id, price){
            $('#product_'+id).children(':nth-child(1)').html('');

            var qty = $('#product_'+id).children(':nth-child(4)').html();
            var discount =  (price/2)*parseInt(qty/2);

            $('#product_'+id).children(':nth-child(4)').html(qty);
            $('#product_'+id).children(':nth-child(5)').html(discount);
            $('#product_'+id).children(':nth-child(6)').html(((qty*price)-discount));
            $('#product_'+id).addClass("buy_1_get_half_off");
            grandTotal();
        }

        function grandTotal(){
            var total = 0;
            $('#saleTbl').find('tr').each(function(){
                total += parseInt($(this).children(':nth-child(6)').html());
            })
            $('#saleTblFoot').html('<tr><td colspan="5"></td><td>'+Math.round(total)+'</td></tr>');
        }
        var cart= [];
        function addProduct(id, name, price, available){
            if(cart.includes(id)){
                var qty = $('#product_'+id).children(':nth-child(4)').html();
                if(available == qty){
                    alert("Quantity not available")
                    return false;
                }else{
                    qty = parseInt(qty) + parseInt(1);
                }
                $('#product_'+id).children(':nth-child(4)').html(qty);
                $('#product_'+id).children(':nth-child(6)').html(((qty*price)));

                if($('#product_'+id)[0].classList.contains("buy_2_get_1_free")){
                    buy_2_get_1_free(id, price);
                }
                if($('#product_'+id)[0].classList.contains("buy_1_get_half_off")){
                    buy_1_get_half_off(id, price);
                }
            }else{
                cart.push(id);
                var qty = 1;
                html = "<tr id='product_"+id+"'>\
                            <td>\
                                <button class='btn btn-sm btn-primary' onclick='buy_2_get_1_free("+id+", "+price+")'>Buy 2 Get 1 Free</button>\
                                <button class='btn btn-sm btn-primary' onclick='buy_1_get_half_off("+id+", "+price+")'>Buy 1 Get 50% off on next buy</button>\
                            </td>\
                            <td>"+name+"</td>\
                            <td>"+price+"</td>\
                            <td>"+qty+"</td>\
                            <td>"+0+"</td>\
                            <td>"+(qty*price)+"</td>\
                        </tr>";
                $('#saleTbl').append(html);
            }
            grandTotal();
        }
    </script>
@endsection