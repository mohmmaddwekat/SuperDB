<x-layout title="{{ __('Create Users') }}">

  <header class="register " id="Main">
      <div class="row justify-content-center  ">
          <div class="col-md-6 col-12 ">
              <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                  <div class="card-content text-start">

                      <div class="card-body  text-dark">
                          <form action="{{ route('users.store') }}" method="post" >
                              @csrf
                              <h1 class="  text-center">{{ __('Sign Up') }}</h1>
                              <div class="form-group">
                                  <label for="Username" class="form-label ">{{ __('Username') }}</label>
                                  <input type="text" value="{{ old('username')}}" name="username" class="form-control  @error('username') is-invalid @enderror">
                                </div>

                                <div class="row g-3 mt-2">
                                  <div class="col-6">
                                    <label for="firstname" class="form-label">{{ __('First Name') }}</label>
                                    <input type="text" value="{{ old('firstname') }}"  class="form-control  @error('firstname') is-invalid @enderror" name="firstname">
                                  </div>
                                  <div class="col-6">
                                    <label for="lastname" class="form-label">{{ __('Last Name') }}</label>
                                    <input type="text" value="{{ old('lastname') }}" class="form-control  @error('lastname') is-invalid @enderror" name="lastname">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="Email" class="form-label ">{{ __('Email') }}</label>
                                  <input type="email" value="{{ old('email') }}" name="email" class="form-control  @error('email') is-invalid @enderror" >
                                </div>

                                <div class="form-group">
                                  <label for="Password" class="form-label ">{{ __('Password') }}</label>
                                  <input type="password"  name="password" class="form-control  @error('password') is-invalid @enderror " >
                                </div>

                              <div class="form-group">
                                  <label  class="form-label ">{{ __('Type of admin') }}</label>
                                  <select name="type" class="form-select  @error('type') is-invalid @enderror" >
                                      <option  value="">{{ __('Choose Type of admin') }}</option>
                                      <option @if (old('type') == "admin") selected @endif value="admin">{{ __('Admin') }}</option>
                                      <option @if (old('type') == "staff") selected @endif value="staff">{{ __('Staff') }}</option>
                                      <option @if (old('type') == "reader") selected @endif value="reader">{{ __('Reader') }}</option>
                                  </select>
                              </div>
                              <!-- Type of roles -->
                              <div class="mt-4">
                                <label for="Type of roles">{{ __('Type of roles') }}</label>
                                <select name="role_id" class="form-select col-md-8 col-lg-12 @error('role_id') is-invalid @enderror" id="">
                                    <option value="">{{ __('No role') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role['id'] }}" @if ($role->id == old('role_id')) selected @endif>{{ __($role['name']) }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group mt-4  ">
                                  <button class="btn btn-primary  ">{{ __('Sign Up') }}</button>
                              </div>
                            </form>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </header>

</x-layout>