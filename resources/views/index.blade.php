@extends('layout.main')

@section('container')
    <h3 class="mt-3">Product List</h3>
    <div class="text-end">
        <button id="showProduct" type="button" class="btn btn-primary">Show Product</button>
    </div>
    <div class="table-responsive" style="padding-bottom: 10px">
        <table id="table" data-toggle="table" data-toolbar=".toolbar" data-url="" class="table table-striped mb-10">
            <thead>
                <tr>
                    <th data-field="thumbnail" data-align="center" data-formatter="imageFormatter" scope="col">Image</th>
                    <th data-field="title" scope="col">Title</th>
                    <th data-field="category" scope="col">Category</th>
                    <th data-field="brand" scope="col">Brand</th>
                    <th data-field="stock" data-align="right" scope="col">Stock</th>
                    <th data-field="price" data-align="right" data-formatter="priceFormatter" scope="col">Price</th>
                    <th data-field="id" scope="col" data-align="center" data-formatter="actionFormatter">
                        Action</th>
                </tr>
            </thead>

        </table>
    </div>
    <style>
        .mySlides {
            display: none;
        }

        .row>.column {
            padding: 0 8px;
        }


        .column img {
            float: left;
            width: 100%;
        }

        img.demo {
            opacity: 0.6;
        }

        img.active,
        .demo:hover {
            opacity: 1;
        }

        img.hover-shadow {
            transition: 0.3s;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .thumb>.col {
            overflow-x: auto;
            white-space: nowrap;
        }

        .thumb>.col>.column {
            display: inline-block;
            float: none;
            width: 25%;
        }

        .stars {
            --s: 40px;
            width: calc(var(--n, 5)*var(--s));
            height: calc(var(--s)*0.9);
            --v1: transparent, #000 0.5deg 108deg, #0000 109deg;
            --v2: transparent, #000 0.5deg 36deg, #0000 37deg;
            -webkit-mask:
                conic-gradient(from 54deg at calc(var(--s)*0.68) calc(var(--s)*0.57), var(--v1)),
                conic-gradient(from 90deg at calc(var(--s)*0.02) calc(var(--s)*0.35), var(--v2)),
                conic-gradient(from 126deg at calc(var(--s)*0.5) calc(var(--s)*0.7), var(--v1)),
                conic-gradient(from 162deg at calc(var(--s)*0.5) 0, var(--v2));
            -webkit-mask-size: var(--s) var(--s);
            -webkit-mask-composite: xor, destination-over;
            mask-composite: exclude, add;
            background:
                linear-gradient(gold 0 0) 0/calc(var(--l, 0)*var(--s)) 100% no-repeat #ccc;
        }
    </style>
    <div id="detailModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title">iPhone 9</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col" id="mySlides">
                                        <div class="mySlides pb-1">
                                            <img src="https://i.dummyjson.com/data/products/1/1.jpg" style="width:100%">
                                        </div>

                                        <div class="mySlides pb-1">
                                            <img src="https://i.dummyjson.com/data/products/1/2.jpg" style="width:100%">
                                        </div>

                                        <div class="mySlides pb-1">
                                            <img src="https://i.dummyjson.com/data/products/1/3.jpg" style="width:100%">
                                        </div>

                                        <div class="mySlides pb-1">
                                            <img src="https://i.dummyjson.com/data/products/1/4.jpg" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="row thumb">
                                    <div class="col" id="demo">
                                        <div class="column">
                                            <img class="demo" src="https://i.dummyjson.com/data/products/1/1.jpg"
                                                onclick="currentSlide(1)">
                                        </div>

                                        <div class="column">
                                            <img class="demo" src="https://i.dummyjson.com/data/products/1/2.jpg"
                                                onclick="currentSlide(2)">
                                        </div>

                                        <div class="column">
                                            <img class="demo" src="https://i.dummyjson.com/data/products/1/3.jpg"
                                                onclick="currentSlide(3)">
                                        </div>

                                        <div class="column">
                                            <img class="demo" src="https://i.dummyjson.com/data/products/1/4.jpg"
                                                onclick="currentSlide(4)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col" id="price">Price : $ 1.234</div>
                                    <div class="col" id="rating">
                                        <div class="stars" style="--l:4"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col" id="category">Category : Smartphone</div>
                                    <div class="col" id="brand">Brand: Apple</div>
                                </div>
                                <div class="row">
                                    <div class="col" id="description">
                                        Desciption:
                                        basjd asdjashd asjhdjasd asjhdjashd asjdh asdahs dajsdhja shdj asjd

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            // $('#detailModal').modal('show');
        });
        var $table = $('#table');
        $('#showProduct').click(function() {
            $.ajax({
                type: 'GET',
                url: 'https://dummyjson.com/products',
                success: (function(data) {
                    // var obj = JSON.parse(data);
                    $table.bootstrapTable('load', data.products);
                })
            })
        });

        function imageFormatter(value) {
            return '<img src="' + value + '" height="100" />'
        }

        function priceFormatter(value) {
            return '$' + value.toLocaleString('en-US')
        }

        function actionFormatter(value) {
            return '<button onclick="getDetail(' + value + ')" type="button" class="btn btn-primary">View</button>'
        }

        function getDetail(id) {
            if (id == '') {
                $('#title').html('');
                $('#mySlides').html('');
                $('#demo').html('');
                $('#price').html('');
                $('#rating').html('');
                $('#category').html('');
                $('#brand').html('');
                $('#description').html('');
            } else {
                $.ajax({
                    url: 'https://dummyjson.com/products/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#title').html(data.title);
                        $('#price').html('Price : $ ' + data.price.toLocaleString('en-US'));
                        $('#rating').html('<div class="stars" style="--l:' + data.rating + ';--s:19px"></div>')
                        $('#category').html('Category : ' + data.category);
                        $('#brand').html('Brand : ' + data.brand);
                        $('#description').html('Description : </br>' + data.description);
                        var mySlide = '';
                        var demo = '';
                        var num = 0;
                        data.images.forEach((img) => {
                            num += 1;
                            mySlide += '<div class="mySlides pb-1">' +
                                '<img src="' + img + '" style="width:100%"></div>';
                            demo += '<div class="column"><img class="demo" ' +
                                'src="' + img + '" onclick="currentSlide(' + num + ')"></div>';
                        });
                        $('#mySlides').html(mySlide);
                        $('#demo').html(demo);
                        currentSlide(1);
                    }
                });

                $('#detailModal').modal('show');
            }
        }

        // var slideIndex = 1;
        // showSlides(slideIndex);

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
@endsection
