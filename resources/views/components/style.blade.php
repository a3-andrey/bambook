<link rel="stylesheet" href="{{asset('styles/default.css')}}">
<link rel="stylesheet" href="{{asset('styles/select2.min.css')}}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{asset('styles/first-paint.css')}}">
<link rel="stylesheet" href="{{asset('styles/styles.css')}}">
<style>
    .count-cart.cart-head{
        border: 1px solid #fff;
    }
    .justify--c{
        justify-content: center;
    }
    .d-f{
        display: flex;
    }
    .cart-item-info{
        justify-content: flex-start;
    }
    .flex-0{
        flex: 0;
    }
    .flex-1{
        flex: 1;
    }
    .flex-2{
        flex: 2;
    }
    /*.cart_items-wrapper{*/
    /*    opacity: 1;*/
    /*    visibility: visible;*/
    /*}*/
    .btn.count-cart{
        margin-top: 16px;
    }
    .cart_items-wrapper li button{
        margin-right: 14px;
    }
    .count-cart.cart-head input{
        width: 80px;
    }
    .count-cart.cart-head  button{
        margin-top: 15px;
    }

    .cart_items-wrapper li button{
        margin-top: 11px;
        width: auto;
    }
    count-cart.cart-head input{
        height: auto;
    }
    .cart_items-wrapper li .prices{
        margin-left: inherit;
    }
    .cart_items-wrapper{
        width: 700px;
    }
    .cart_items-wrapper li .cart_item-name{
        max-width: 200px;
    }
    .catalog-button{
        font-family: var(--text-font);
    }
    .menu-hover{
        display: none;
    }
    .menu-hover.open{
        display: block;
    }
    .alert.alert-danger{
        color: var(--accent-color);
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 2px solid var(--button-border-color);
        border-radius: 0.25rem;
    }
    .label__placeholder-required{
        position: absolute;
        right: 0;
        margin-right: 20px;
        margin-top: 15px;
    }
    .cart-item-name a{
        color: #ffffff;
        text-decoration: none;
    }
    .small-article.swiper-initialized.swiper-horizontal.swiper-pointer-events.swiper-backface-hidden{
        margin-top: 20px;
    }
    .article-settings .button{
        margin-top: 10px;
    }
    .button .icon {
        width: 20px;
        height: 23px;
        margin-right: 9px;
    }

    .count-cart{
        max-width: none;
        width: 100%;
        justify-content: space-between;
        margin-right: 0;
    }
    .count-cart input{
        width: 50px;
    }

    .cart__buttons{
        width: 206px;
    }
    .cart_items-wrapper li .prices strike{
        display: block;
    }
    /*.cart::before{*/
    /*    content: '';*/
    /*    width: 0;*/
    /*    height: 0;*/
    /*}*/

    .product-title{
        min-height: 48px;
        text-align: center;
    }
    .preloader-cart-product-add-btn{
        width: 60px;
        height: 30px;
        position: absolute;
        margin-left: 50px;
        padding-left: 20px;
        padding-top: 2px;
        margin-top: 10px;
        background-color: black;
    }
    .preloader-cart-product-add-btn.ipd{
        margin-left: 70px;
    }


    .search-form .search-wrapper ul{
        max-height: 430px;
    }
    a.active + .brands{
        display: block;
    }
    .brands{
        display: none;
    }
    .big-article .slide.swiper-slide{
        opacity: 1!important;
    }
    .thanks__inner{
        min-height: 300px;
    }
    .product-image img{
        object-fit: contain!important;
    }
    .product-title{
        min-height: 48px;
    }
    .catalog-button{
        cursor: pointer;
    }
    .rotation-180{
        transform: rotate(180deg);
    }

    @media screen and (max-width: 480px) {
        .cart-item-info .flex-2.d-f.justify--c:nth-child(odd){
            width: 200px!important;
        }
        .cart-item-info .flex-2.d-f.justify--c .count-cart{
            margin-right: inherit!important;
        }
        .cart-item-info .flex-0{
            width: 200px;
            margin-right: inherit!important;
        }
        .cart-item .remove-list-item{
            margin: 0px!important;
        }
        .cart-item-info .art-item-name, .cart-item-info .prices{
            width: 200px;
            margin-right: inherit;
        }
        .cart-item{
            flex-direction: column;
            text-align: center;
            align-items: center;
        }
        .cart-item .cart-item-info{
            padding: 0px!important;
        }
        .cart-item-name{
            width: auto!important;
        }
        .cart-main{
            text-align: center;
            align-items: center;
        }
        .cart-main .cart-item .cart_item-image{
            align-self: center!important;
            flex: 0.5;
            max-width: 210px
        }
    }
    .product-price{
        justify-content: center;
    }


    body {
        top: 0 !important;
    }
    .skiptranslate {
        display: none;
        height: 0;
    }
    .language__img {
        cursor: pointer;
    }
</style>
