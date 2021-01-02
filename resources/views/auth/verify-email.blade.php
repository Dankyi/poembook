@extends('layouts.app')

@section('content')
    <div class="p-15 flex items-center justify-center">
        <div class="bg-white bg-blue-100 p-8 rounded-xl border max-w-xl">
            <div class="flex justify-center text-2xl font-semibold">{{ __('Verify Your Email Address') }}</div>
            <p class="text-black block text-xl leading-snug mt-5">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-link underline p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
            </p>
        </div>
    </div>
@endsection