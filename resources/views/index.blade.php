<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");


        body {

            background-color: #eee;
            font-family: "Poppins", sans-serif
        }

        .container {

            height: 100vh;

        }


        .card {

            background-color: #fff;
            position: relative;
            width: 350px;
            border: none;


        }

        .percent {

            width: 63px;
            height: 30px;
            position: absolute;
            background: red;
            color: #fff;
            border-radius: 3px;
            display: flex;
            justify-content: center;
            align-items: center;
            right: 0;
            border-bottom-left-radius: 15px;
            padding: 10px;

        }

        .card-image {

            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .card-inner {

            padding: 20px;

        }

        .price span {

            color: orange;
            font-weight: 600;
            font-size: 20px;

        }

        .price sup {

            color: orange;
            font-weight: 600;
            font-size: 14px;
            top: -3px;

        }


        .details {

            border-radius: 20px;

            width: 110px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .wishlist {


            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #f7a754;
            background: #fdeddc;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.5s all;
            font-size: 15px;

        }


        .wishlist:hover {

            color: #fff;
            background: #f7a754;

        }

        .cart {

            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            background: green;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.5s all;
            margin-left: 5px;
            font-size: 15px;

        }
    </style>
</head>


<div class="container d-flex justify-content-center align-items-center">

    <div class="card">

        <span class="percent">-10%</span>
        <div class="card-image">

            <img src="https://i.ibb.co/ZT0dLn1/kaos.png" width="250">

        </div>

        <div class="card-inner">

            <h5 class="mb-0">Kaos anime</h5>

            <div class="price">
                <span>$22.99</span>
            </div>


            <div class="mt-3 d-flex justify-content-between align-items-center">
                <form action="{{ route('post.post') }}" method="post">
                    @csrf
                    <input type="text" value="kaos anime" name="name" hidden>
                    <input type="text" value="kaos anime gambar banteng" name="description" hidden>
                    <input type="text" value="1" name="quantity" hidden>
                    <input type="text" value="USD" name="currency_code" hidden>
                    <input type="text" value="22.99" name="value" hidden>
                    <button type="submit" class="btn btn-success text-uppercase btn-sm details">Beli</button>
                </form>


                <div class="d-flex flex-row">

                    <span class="wishlist"><i class="fa fa-heart"></i></span>
                    <span class="cart"><i class="fa fa-shopping-cart"></i></span>

                </div>

            </div>

        </div>

    </div>

</div>
