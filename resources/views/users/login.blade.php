<x-user-layout>

    <header class="register " id="Main">
        <div class="row justify-content-center  ">
            <div class="col-md-6 col-12 ">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-content text-start">
                        <x-auth-validation-errors class="mb-4 " :errors="$errors" />

                        <div class="card-body  text-dark">
                            <form action="{{ route('users.store-login') }}" method="post" >
                                @csrf
                                <h1 class="  text-center">{{ __('Log In') }}</h1>
                                <div class="form-group">
                                    <label for="Username" class="form-label ">{{ __('Username') }}</label>
                                    <input type="text" value="{{ old('username')}}" name="username" class="form-control  @error('username') is-invalid @enderror">
                                  </div>

                                  <div class="form-group">
                                    <label for="Password" class="form-label ">{{ __('Password') }}</label>
                                    <input type="password"  name="password" class="form-control  @error('password') is-invalid @enderror " >
                                  </div>

                                <div class="form-group mt-4  ">
                                    <button class="btn btn-primary  ">{{ __('Log In') }}</button>
                                </div>

                                <a href="{{ url('forgot-password') }}">{{ __('Forgotten your password? Reset it here') }}</a>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

</x-user-layout>