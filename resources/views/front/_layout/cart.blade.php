<!-- Cart -->
<div class="cart-area" id="shopping_cart_top">

</div>

@push('footer_javascript')
<script type="text/javascript">
    //naknadno popunjavanje diva #shopping_cart_top

    function shoppingCartFrontRefreshTop() {
        $.ajax({
            "url": "{{route('front.shopping_cart.content')}}",
            "type": "get", //http metoda GET ili POST
            "data": {}
        }).done(function (response) {
            $('#shopping_cart_top').html(response);
            console.log('Zavrseno ucitavanje sadrzaja');
            //console.log(response);
        }).fail(function (jqXHR, textStatus, error) {
//        console.log('Greska prilikom ocitavanja sadrzaja');
//        console.log(textStatus);
//        console.log(error);
        });

    }

    function shoppingCartFrontRefreshTable() {

        if ($('#shopping_cart_table').length <= 0) {
            return;
        }

        $.ajax({
            "url": "{{route('front.shopping_cart.table')}}",
            "type": "get", //http metoda GET ili POST
            "data": {}
        }).done(function (response) {
            $('#shopping_cart_table').html(response);
            console.log('Zavrseno ucitavanje sadrzaja');
            //console.log(response);
        }).fail(function (jqXHR, textStatus, error) {
//        console.log('Greska prilikom ocitavanja sadrzaja');
//        console.log(textStatus);
//        console.log(error);
        });

    }


    function shoppingCartFrontAddToCart(productId, quantity) {
        $.ajax({
            "url": "{{route('front.shopping_cart.add_product')}}",
            "type": "post",
            "data": {
                "_token": "{{csrf_token()}}",
                "product_id": productId,
                "quantity": quantity
            }
        }).done(function (response) {
            console.log(response);
            toastr.success(response.system_message);
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();
            //alert(response.system_message);
        }).fail(function () {
            //console.log('Neuspesno dodavanje u korpu');
            toastr.error('Unable to add product to cart');
        });
    }
    
     function shoppingCartFrontChangeQyantity(productId, quantity) {
        $.ajax({
            "url": "{{route('front.shopping_cart.change_quantity')}}",
            "type": "post",
            "data": {
                "_token": "{{csrf_token()}}",
                "product_id": productId,
                "quantity": quantity
            }
        }).done(function (response) {
            console.log(response);
            toastr.success(response.system_message);
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();
            //alert(response.system_message);
        }).fail(function () {
            //console.log('Neuspesno dodavanje u korpu');
            toastr.error('Unable to change quantity');
        });
    }

    function shoppingCartFrontRemoveProduct(productId)
    {
        $.ajax({
            "url": "{{route('front.shopping_cart.remove_product')}}",
            "type": "POST",
            "data": {
                "_token": "{{csrf_token()}}",
                "product_id": productId
            }
        }).done(function (response) {

            //alert(response.system_message);
            toastr.success(response.system_message);
            shoppingCartFrontRefreshTop();
            shoppingCartFrontRefreshTable();

        }).fail(function () {
            //console.log('Neuspesno brisanje iz korpe');
            toastr.error('Unable to remove product from cart')
        });
    }

    //selektujem sve DUGMICE koji imatu data-action="add_to_cart"
    $('[data-action="add_to_cart"]').on('click', function (e) {
        e.preventDefault();//ako se klikne na link, da ne ide bukvalno na taj link, vec da odradi neku drugu akciju
        e.stopPropagation();//da se ne opterecuje browser

        let productId = $(this).attr('data-product-id'); //procitaj atribut

        //let productId = $(this).data('product_id'); //citanje atributa od product-a, treba nam id

        let quantity = $(this).attr('data-quantity');

        shoppingCartFrontAddToCart(productId, quantity);
    });

    $('#shopping_cart_top').on('click', '[data-action="remove_product"]', function (e) {

        e.preventDefault();
        e.stopPropagation();

        let productId = $(this).attr('data-product-id');

        shoppingCartFrontRemoveProduct(productId);
    });

    $('#shopping_cart_table').on('click', '[data-action="remove_product"]', function (e) {

        e.preventDefault();
        e.stopPropagation();

        let productId = $(this).attr('data-product-id');

        shoppingCartFrontRemoveProduct(productId);
    });

    $('#shopping_cart_table').on('change', '[data-action="change_quantity"]', function(e){
        e.stopPropagation();
        
        let productId = $(this).attr('data-product-id');
        let quantity = $(this).val();
        
        shoppingCartFrontChangeQyantity(productId, quantity);
    });
    
    shoppingCartFrontRefreshTop(); //kada se ucita stranica prvi put ucitaj i korpu
    shoppingCartFrontRefreshTable();
</script>
@endpush