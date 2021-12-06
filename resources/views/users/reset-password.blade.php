<x-user-layout>

    <header class="register " id="Main">
        <div class="row justify-content-center  ">
            <div class="col-md-6 col-12 ">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-content text-start">
                        <x-auth-validation-errors class="mb-4 " :errors="$errors" />

                        <div class="card-body  text-dark">
                            <form action="{{ route('password.email',$request-> email  ) }}" method="post" >
                                @csrf
                                <h1 class="  text-center">Reset Password</h1>
                                <input type="hidden" name ="token" value="{{ $request->route('token') }}">

                

                                  <div class="form-group">
                                    <label for="Password" class="form-label ">{{ __('Password') }}</label>
                                    <input type="password"  name="password" class="form-control  @error('password') is-invalid @enderror " >
                                  </div>

                                  <div class="form-group">
                                    <label for="Password_confirmation" class="form-label ">{{ __('Confirm Password') }}</label>
                                    <input type="password"  name="password_conformation" class="form-control  @error('password') is-invalid @enderror " >
                                  </div>

                                

                                <div class="form-group mt-4  ">
                                    <button class="btn btn-primary  ">{{ __('Update') }}</button>
                                </div>

                               
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

</x-user-layout>