<x-layout title="{{ __('Edit permissions') }}">

    <div>
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">

                            <form action="{{ route('super-db.permissions.update' , $role['id'])}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @include('super-db.permissions._form',[
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