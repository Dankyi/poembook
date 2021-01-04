@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
        <div class="flex">
            <div class="w-full">
                <div id="alert-div" class="hidden text-white mb-5 px-6 py-4 border-0 rounded relative bg-green-500">
                    <span class="text-xl inline-block mr-5 align-middle">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="inline-block align-middle mr-8">
                        Profile updated successfully!
                    </span>
                    <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                        <span>×</span>
                    </button>
                </div>

                <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                    <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                        {{ __('Edit Profile') }}
                    </header>

                    <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('user-profile-information.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Name') }}:
                            </label>

                            <input id="name" type="name"
                                   class="form-input w-full @error('name') border-red-500 @enderror" name="name"
                                   value="{{ old('name') ?? auth()->user()->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email"
                                   class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                   value="{{ old('email') ?? auth()->user()->email }}" required autocomplete="email" autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <button id="update-btn" type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal mb-8 focus:outline-none no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>

            <script>
                const updateBtn = document.querySelector('#update-btn');
                const alertDiv = document.querySelector('#alert-div');

                updateBtn.addEventListener('click', () => {
                    alertDiv.classList.toggle('hidden');
                    alertDiv.classList.toggle('flex');
                });
            </script>

        </div>
    </main>
@endsection
