<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'KH Fashion')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('theme.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="logo">
                    <a href="/home">
                        <img src="{{ $logo ? asset('storage/' . $logo->image) : asset('Uploads/logo.png') }}" width="100px" height="100px" style="object-fit: cover;" alt="KH Fashion Logo">
                        <h1>KH FASHION</h1>
                    </a>
                </div>
                <ul class="menu">
                    <li><a href="/home">HOME</a></li>
                    <li><a href="/shop">SHOP</a></li>
                    <li><a href="/news">NEWS</a></li>
                </ul>
                <div class="search">
                    <form action="/search" method="get">
                        <input type="text" name="s" class="box" placeholder="SEARCH HERE">
                        <button>
                            <div style="background-image: url({{ asset('Uploads/search.png') }});
                                        width: 28px;
                                        height: 28px;
                                        background-position: center;
                                        background-size: contain;
                                        background-repeat: no-repeat;">
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <main class="home">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">NEW PRODUCTS</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($newProducts as $product)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        @if ($product->discount)
                                            <div class="status">Promotion</div>
                                        @endif
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" style="width: 450px; height: 670px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            <div class="price d-none">US {{ $product->regular_price }}</div>
                                            @if ($product->discount)
                                                <div class="regular-price"><strike>US {{ $product->regular_price }}</strike></div>
                                                <div class="sale-price">US {{ $product->regular_price - $product->discount }}</div>
                                            @else
                                                <div class="sale-price">US {{ $product->regular_price }}</div>
                                            @endif
                                        </div>
                                        <h5 class="title">{{ $product->name }}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">PROMOTION PRODUCTS</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($promotionProducts as $product)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" style="width: 450px; height: 670px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            <div class="price d-none">US {{ $product->regular_price }}</div>
                                            <div class="regular-price"><strike>US {{ $product->regular_price }}</strike></div>
                                            <div class="sale-price">US {{ $product->regular_price - $product->discount }}</div>
                                        </div>
                                        <h5 class="title">{{ $product->name }}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">POPULAR PRODUCTS</h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($popularProducts as $product)
                            <div class="col-3">
                                <figure>
                                    <div class="thumbnail">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" style="width: 450px; height: 670px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            <div class="price d-none">US {{ $product->regular_price }}</div>
                                            @if ($product->discount)
                                                <div class="regular-price"><strike>US {{ $product->regular_price }}</strike></div>
                                                <div class="sale-price">US {{ $product->regular_price - $product->discount }}</div>
                                            @else
                                                <div class="sale-price">US {{ $product->regular_price }}</div>
                                            @endif
                                        </div>
                                        <h5 class="title">{{ $product->name }}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <span>All Rights Reserved @ {{ date('Y') }}</span>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
