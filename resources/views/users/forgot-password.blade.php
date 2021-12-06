<x-user-layout>

    <header class="register " id="Main">
        <div class="row justify-content-center  ">
            <div class="col-md-6 col-12 ">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-content text-start">
                        <x-auth-validation-errors class="mb-4 " :errors="$errors" />

                        @if(session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status')}}
                          </div>
                        @endif

                        <div class="card-body  text-dark">
                            <form action="{{ route('password.request') }}" method="post" >
                                @csrf
                                <h1 class="  text-center">Reset Password</h1>
                                <div class="form-group">
                                    <label for="email" class="form-group ">Email</label>
                                    <input type="email" name="email" name="email" class="form-control  @error('username') is-invalid @enderror">
                                  </div>

                                

                                <div class="form-group mt-4  ">
                                    <button class="btn btn-primary  ">{{ __('Reset password') }}</button>
                                </div>

                               
                              </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

</x-user-layout>