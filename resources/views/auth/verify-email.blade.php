@extends('layouts.app')

@section('content')
    <div id="alert-div" class="hidden container mx-auto max-w-xl text-white mt-10 px-6 py-4 border-0 rounded relative bg-green-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-check-circle"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </span>
        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
            <span>×</span>
        </button>
    </div>

    <div class="p-15 flex items-center justify-center">
        <div class="bg-white bg-blue-100 p-8 rounded-xl border max-w-xl">
            <div class="flex justify-center text-2xl font-semibold">{{ __('Verify Your Email Address') }}</div>
            <p class="text-black block text-xl leading-snug mt-5">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button id="request-btn" type="submit" class="btn btn-link underline p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
            </p>
        </div>

        <script>
            const requestBtn = document.querySelector('#request-btn');
            const alertDiv = document.querySelector('#alert-div');

            requestBtn.addEventListener('click', () => {
                alertDiv.classList.toggle('hidden');
                alertDiv.classList.toggle('flex');
            });

            function closeAlert(event){
                let element = event.target;
                while(element.nodeName !== "BUTTON"){
                    element = element.parentNode;
                }
                element.parentNode.parentNode.removeChild(element.parentNode);
            }
        </script>
    </div>
@endsection