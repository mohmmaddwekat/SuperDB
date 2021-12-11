    <x-layout title="{{ __('Edit Role') }}">

    <div>
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('super-db.roles.update' , $role['id'])}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @include('super-db.roles._form',[
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