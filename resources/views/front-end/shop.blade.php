<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Shop - KH FASHION')</title>
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
                    <li><a href="{{ url('/home') }}">HOME</a></li>
                    <li><a href="{{ url('/shop') }}" class="active">SHOP</a></li>
                    <li><a href="{{ url('/news') }}">NEWS</a></li>
                </ul>
                <div class="search">
                    <form action="{{ url('/shop') }}" method="get">
                        <input type="text" name="s" class="box" placeholder="SEARCH HERE" value="{{ request('s') }}">
                        <button type="submit">
                            <div style="background-image: url({{ asset('Uploads/search.png') }});
                                        width: 28px;
                                        height: 28px;
                                        background-position: center;
                                        background-size: contain;
                                        background-repeat: no-repeat;"></div>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="shop">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                @if (isset($products) && $products->count() > 0)
                                    @foreach ($products as $product)
                                        <div class="col-4 mb-4">
                                            <figure>
                                                <div class="thumbnail">
                                                    @if ($product->discount && $product->discount > 0)
                                                        <div class="status">Promotion</div>
                                                    @endif
                                                    <a href="{{ url('/product/' . $product->id) }}">
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="detail">
                                                    <div class="price-list">
                                                        @if ($product->discount && $product->discount > 0)
                                                            <div class="regular-price"><strike>US {{ number_format($product->regular_price, 2) }}</strike></div>
                                                            <div class="sale-price">US {{ number_format($product->regular_price - ($product->regular_price * $product->discount / 100), 2) }}</div>
                                                        @else
                                                            <div class="sale-price">US {{ number_format($product->regular_price, 2) }}</div>
                                                        @endif
                                                    </div>
                                                    <h5 class="title">{{ $product->name }}</h5>
                                                </div>
                                            </figure>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <p>No products found.</p>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <ul class="pagination justify-content-center">
                                        {{ $products->links() ?? '' }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 filter">
                            <h4 class="title">Category</h4>
                            <ul>
                                <li><a href="{{ url('/shop') }}" class="{{ !request('cat') ? 'active' : '' }}">ALL</a></li>
                                @foreach ($categories ?? [] as $category)
                                    <li><a href="{{ url('/shop?cat=' . urlencode($category->name)) }}" class="{{ request('cat') == $category->name ? 'active' : '' }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>

                            <h4 class="title mt-4">Price</h4>
                            <div class="block-price mt-4">
                                <a href="{{ url('/shop?price=max') }}" class="{{ request('price') == 'max' ? 'active' : '' }}">High</a>
                                <a href="{{ url('/shop?price=min') }}" class="{{ request('price') == 'min' ? 'active' : '' }}">Low</a>
                            </div>

                            <h4 class="title mt-4">Promotion</h4>
                            <div class="block-price mt-4">
                                <a href="{{ url('/shop?promotion=true') }}" class="{{ request('promotion') == 'true' ? 'active' : '' }}">Promotion Product</a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer>
                <span>All Rights Reserved @ {{ date('Y') }}</span>
            </footer>
        </body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
