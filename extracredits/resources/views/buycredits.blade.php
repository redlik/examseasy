@extends('layouts.app')

@section('extra_scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('extra_styles')
    <style>
        form {
            align-self: center;
            box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
            0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
            border-radius: 7px;
            padding: 40px;
        }

        input {
            border-radius: 6px;
            margin-bottom: 6px;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            font-size: 16px;
            width: 100%;
            background: white;
        }

        .result-message {
            line-height: 22px;
            font-size: 16px;
        }

        .result-message a {
            color: rgb(89, 111, 214);
            font-weight: 600;
            text-decoration: none;
        }

        .hidden {
            display: none;
        }

        #card-error {
            color: rgb(105, 115, 134);
            text-align: left;
            font-size: 13px;
            line-height: 17px;
            margin-top: 12px;
        }

        #card-element {
            border-radius: 4px 4px 0 0;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            width: 100%;
            background: white;
        }

        #payment-request-button {
            margin-bottom: 32px;
        }

        /* Buttons and links */
        /* button {
            background: #5469d4;
            color: #ffffff;
            font-family: Arial, sans-serif;
            border-radius: 0 0 4px 4px;
            border: 0;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
        } */

        button:hover {
            filter: contrast(115%);
        }

        button:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }

        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }

        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
            }
        }

        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
            outline: 1px solid #696969;

        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #CF5299;
            box-shadow: 2px 2px 5px 4px #afafaf;
        }

    </style>
@endsection

@section('show_credits')
    <x-creditbox />
@endsection

@section('content')
    @csrf
    <div class="col-12 col-md-9 mx-auto my-4">
        <h1 class="text-center main-heading display-5 mb-3">Top up your account</h1>
        @if (Auth::user()->unlimited == 0)
            <h6 class="text-center text-secondary">If you just starting or want to add some extra credits to your account - select the credit amount and proceed to checkout page. The&nbspcredits will be added to your account so you can unlock more content to learn.
            </h6>
        @endif
    </div>
    @if (Auth::user()->unlimited == 1)
        <div class="col-12 col-md-9 mx-auto">
            <div class="alert alert-success" role="alert">
                You have the unlimited access account, there's no need to buy any more top-ups. Enjoy the whole library without any extra costs.
            </div>
        </div>
    @else
        <div class="col-12 col-md-9 mx-auto">
            <div class="row d-flex justify-content-sm-center justify-content-md-start ">
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit1" value=499>
                        <img src="{{ asset('images/icons/credits1a.svg') }}" alt="" style="width:150px">
                    </label>
                </div>
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit5" value=1999 checked>
                        <img src="{{ asset('images/icons/credits5a.svg') }}" alt="" style="width:150px">
                    </label>
                </div>
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit15" value=4999>
                        <img src="{{ asset('images/icons/credits15a.svg') }}" alt="" style="width:150px">
                    </label>
                </div>
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit50" value=14999>
                        <img src="{{ asset('images/icons/credits50a.svg') }}" alt="" style="width:150px">
                    </label>
                </div>
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit100" value=24999>
                        <img src="{{ asset('images/icons/credits100a.svg') }}" alt="" style="width:150px">
                    </label>
                </div>
                <div class="form-check form-check-inline mb-3 mx-sm-auto mx-lg-2">
                    <label>
                        <input class="form-check-input" type="radio" name="credit_topup" id="credit100" value=49999>
                        <img src="{{ asset('images/credits_unlimited.svg') }}" alt="" style="width:230px">
                    </label>
                </div>
            </div>
            <div class="text-center">
                <button id="checkout-button" class="btn btn-lg btn-success">
                    Proceed to Checkout
                    <i class="fas fa-chevron-circle-right ml-2"></i>
                </button>
            </div>
        </div>
    @endif
@endsection

@section('bottom_scripts')
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe('{{ config('app.stripe_public') }}');
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function() {
            var credits = $('input[name=credit_topup]:checked').val();
            // Create a new Checkout Session using the server-side endpoint you
            // created in step 3.
            fetch('/create-stripe-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: credits,
                }),
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(session) {
                    return stripe.redirectToCheckout({ sessionId: session.id });
                })
                .then(function(result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using `error.message`.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
