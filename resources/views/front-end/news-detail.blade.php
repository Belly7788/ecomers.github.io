<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Product Detail - KH Fashion')</title>
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

        <main class="shop product-detail">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">{{ $product->name }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="thumbnail">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" style="width: 530px; height: 450px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="detail">
                                <div class="top">
                                    <div class="price-list">
                                        @if ($product->discount)
                                            <div class="regular-price"><strike>US {{ $product->regular_price }}</strike></div>
                                            <div class="sale-price">US {{ $product->regular_price - $product->discount }}</div>
                                        @else
                                            <div class="sale-price">US {{ $product->regular_price }}</div>
                                        @endif
                                    </div>
                                    <div class="stock">
                                        <span>Stock:</span> {{ $product->stock }}
                                    </div>
                                </div>
                                <hr>
                                <div class="description">
                                    {!! $product->description ?? 'No description available.' !!}
                                </div>
                                @if ($product->color_id)
                                    <div class="colors">
                                        <span>Colors:</span>
                                        @foreach (explode(',', $product->color_id) as $colorId)
                                            @php
                                                $color = App\Models\Color::find($colorId);
                                            @endphp
                                            {{ $color ? $color->name : 'N/A' }}{{ $loop->last ? '' : ', ' }}
                                        @endforeach
                                    </div>
                                @endif
                                @if ($product->size_id)
                                    <div class="sizes">
                                        <span>Sizes:</span>
                                        @foreach (explode(',', $product->size_id) as $sizeId)
                                            @php
                                                $size = App\Models\Size::find($sizeId);
                                            @endphp
                                            {{ $size ? $size->name : 'N/A' }}{{ $loop->last ? '' : ', ' }}
                                        @endforeach
                                    </div>
                                @endif
                                @if ($product->brand_id)
                                    <div class="brand">
                                        <span>Brand:</span>
                                        @php
                                            $brand = App\Models\Brand::find($product->brand_id);
                                        @endphp
                                        {{ $brand ? $brand->name : 'N/A' }}
                                    </div>
                                @endif
                                @if ($product->category_id)
                                    <div class="category">
                                        <span>Category:</span>
                                        @php
                                            $category = App\Models\Category::find($product->category_id);
                                        @endphp
                                        {{ $category ? $category->name : 'N/A' }}
                                    </div>
                                @endif
                            </div>
                        </div>
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
