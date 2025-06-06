<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'News - KH Fashion')</title>
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
                    <form action="/search" method="get">
                        <input type="text" name="s" class="box" placeholder="SEARCH HERE">
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

        <main class="shop news-blog">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">
                                NEWS BLOG
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
                    <!-- Pagination Links -->
                    @if ($newsProducts->hasPages())
                        <div class="row">
                            <div class="col-12">
                                {{ $newsProducts->links() }}
                            </div>
                        </div>
                    @endif
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
