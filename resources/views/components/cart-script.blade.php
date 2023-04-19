<script>



    $('#filter input').change(function (){
        getProducts();
    });

    function getCart(){
        $.ajax({
            url: '',
            method: 'get',
            data: $('#filter').serialize(),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data){
                $('#products').html(data.content)
            },
        });
    }

    function getProducts(){
        $.ajax({
            url: 'api.catalog',
            method: 'get',
            data: $('#filter').serialize(),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data){
                $('#products').html(data.content)
            },
        });
    }

    function add_cart(product){
        $.ajax({
            url: 'api/cart/add',
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data: {product: product},
            success: function(data){
                countCartHeaderShow();
            }
        });
    }

    function countCartHeaderShow(){
        $.ajax({
            url: 'api/cart/total',
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data){
                $('.items').text(data.count);
            }
        });
    }

    $(document).on('click', '[add_cart]', function (){
        add_cart($(this).attr('add_cart'));
    });







    function updateCart(product,qtu=1){
        $.ajax({
            url: 'api/cart/update',
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data:{product:product,qtu:qtu},
            dataType: 'json',
            success: function(data){
                countCartHeaderShow();
            }
        });
    }

    function destroyProductCart(product){
        $.ajax({
            url: 'api/cart/delete',
            method: 'post',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data:{product:product},
            dataType: 'json',
            success: function(data){
                countCartHeaderShow();
            }
        });
    }

    $(document).on('click', '[destroyProductCart]', function (){
        var product =  $(this).attr('destroyProductCart');
        $('[cart-item="'+product+'"]').remove();
        destroyProductCart(product);
    });

    // Уменьшаем кол-во товара в корзине
    $(document).on('click', '[_minus_product_]', function (){

        let product =  $(this).attr('_minus_product_'),
            valSelector = $('[product-input="'+product+'"]'),
            val = valSelector.val();

        var attr_cart = $('[cart-item="'+product+'"]')

        if(val>0 && (attr_cart.length<=0)){
            val = parseInt(val) - 1;
            valSelector.val(val);
            updateCart(product,val);

        }

        if(val>1 && (attr_cart.length>0)){
            val = parseInt(val) - 1;
            valSelector.val(val);
            updateCart(product,val);
            var price = $('[product_sum="'+product+'"]').attr('product_price')
            $('[product_sum="'+product+'"]').text(val*price);

        }

        if(val === 0){
            toggleBtnCart(product,'show');
        }
    });

    $(document).on('click', '[_plus_product_]', function (){
        let product =  $(this).attr('_plus_product_'),
            valSelector = $('[product-input="'+product+'"]'),
            val = valSelector.val();
        val = parseInt(val) + 1;
        valSelector.val(val);
        updateCart(product,val);
    });
</script>
