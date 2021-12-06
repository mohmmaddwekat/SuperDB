<x-layout title="{{ __('Edit abilities') }}">

    <div>
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form action="{{ route('super-db.abilities.update' , $role['id'])}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @include('super-db.abilities._form',[
                            'savelabel' => 'edit'
                            ])
                        </form>
                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-layout>