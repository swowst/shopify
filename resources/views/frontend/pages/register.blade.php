@extends('frontend.layout.layout')
@section('inlineCss')
    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            margin: 0 auto;
        }

        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .title::before,.title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: royalblue;
        }

        .title::before {
            width: 18px;
            height: 18px;
            background-color: royalblue;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message, .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input + span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus + span,.form label .input:valid + span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid + span {
            color: green;
        }

        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
        }

        .submit:hover {
            background-color: rgb(56, 90, 194);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }
    </style>
@endsection


@section('content')

    <form action="{{ route('user-register') }}" method="POST" class="form">
        @csrf
        <p class="title">Register </p>
        <p class="message">Signup now and get full access to our app. </p>

            <label>
                <input required="" placeholder="" name="name" type="text" class="input">
                <span>Full name</span>
            </label>



        <label>
            <input required="" placeholder="" type="email" name="email" class="input">
            <span>Email</span>
        </label>


        <label>
            <input required="" placeholder="" type="number" name="phone" class="input">
            <span>Phone</span>
        </label>

        <label>
            <input required="" placeholder="" type="password" name="password" class="input">
            <span>Password</span>
        </label>
        <label>
            <input required="" placeholder="" type="password" name="password2" class="input">
            <span>Confirm password</span>
        </label>
        <button class="submit">Submit</button>
        <p class="signin">Already have an acount ? <a href="{{ route('account') }}">Signin</a> </p>
    </form>

@endsection
