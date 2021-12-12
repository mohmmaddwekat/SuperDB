    <x-layout title="{{ __('Create Roles') }}">

    <div>
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('super-db.roles.store') }}">
                                @csrf
                                @include('super-db.roles._form',[
                                'savelabel' => 'Add'
                                ])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </x-layout>