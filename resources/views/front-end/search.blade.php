<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Search Results - KH Fashion')</title>
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
                        <img src="{{ $logo ? asset('storage/' . $logo->image) : asset('Uploads/logo.png') }}" width="180px" alt="KH Fashion Logo">
                        <h1>KH FASHION</h1>
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="/home">HOME</a>
                    </li>
                    <li>
                        <a href="/shop">SHOP</a>
                    </li>
                    <li>
                        <a href="/news">NEWS</a>
                    </li>
                </ul>
                <div class="search">
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" name="s" class="box" placeholder="SEARCH HERE" value="{{ $searchQuery ?? '' }}">
                        <button type="submit">
                            <div style="background-image: url({{ asset('uploads/search.png') }});
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

        <main class="shop">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                Product Result
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        @if ($products->isEmpty())
                            <div class="col-12">
                                <p>No products found for "{{ $searchQuery ?? '' }}".</p>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="col-3">
                                    <figure>
                                        <div class="thumbnail">
                                            @if ($product->discount && $product->discount > 0)
                                                <div class="status">Promotion</div>
                                            @endif
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/450x670' }}" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="detail">
                                            <div class="price-list">
                                                @if ($product->discount && $product->discount > 0)
                                                    <div class="regular-price"><strike>US {{ number_format($product->regular_price, 2) }}</strike></div>
                                                    <div class="sale-price">US {{ number_format($product->regular_price - ($product->regular_price * $product->discount / 100), 2) }}</div>
                                                @else
                                                    <div class="regular-price">US {{ number_format($product->regular_price, 2) }}</div>
                                                @endif
                                            </div>
                                            <h5 class="title">{{ Str::limit($product->name, 50) }}</h5>
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($products->hasPages())
                        <div class="row">
                            <div class="col-12">
                                {{ $products->appends(['s' => $searchQuery])->links() }}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="container">
                    <div class="row mt-5">
                        <div class="col-12">
                            <h3 class="main-title">
                                News Result
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        @if ($newsProducts->isEmpty())
                            <div class="col-12">
                                <p>No news products available.</p>
                            </div>
                        @else
                            @foreach ($newsProducts as $product)
                                <div class="col-3">
                                    <figure>
                                        <div class="thumbnail">
                                            <a href="{{ route('product.detail', $product->id) }}">
                                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/300x300' }}" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="detail">
                                            <h5 class="title">{{ Str::limit($product->name, 50) }}</h5>
                                            <p>{{ Str::limit($product->description ?? 'No description available', 100) }}</p>
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <span>
                All Rights Reserved @ 2023
            </span>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
