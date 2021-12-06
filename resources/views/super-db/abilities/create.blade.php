<x-layout title="{{ __('Create New abilities') }}">

    <div>
        <div class="row match-height justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('super-db.abilities.store', $role['id']) }}">
                                @csrf
                                @include('super-db.abilities._form',[
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