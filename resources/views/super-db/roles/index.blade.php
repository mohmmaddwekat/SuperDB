    <x-layout title="{{ __('List Roles') }}">

        @php
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
             
      @endphp

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif


    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <div class="row my-2">
            <div class="btn-toolbar">

                <div class="col col-md-6 col-lg-3 col-xl-4 ">
                    <div class="btn-group m-2">
                        @if (in_array('super-db.roles.create',$roles_Abilitiles))
                        <a href="{{ route('super-db.roles.create') }}"><button class="btn btn-primary btn-sm  "
                                aria-haspopup="true" aria-expanded="false"> <span class="fas fa-plus mr-2"><i
                                        data-feather="plus-circle"></i>{{ __('Create new Roles') }}</span></button></a>

                        @endif
                    </div>
                </div>


            </div>



        </div>
        <table class="table table-hover">

            <thead>
                <tr>
                    <th class="dataTable-sorter">#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('# abilities') }}</th>
                    <th></th>
                    <th class="" scope="2">{{ __('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                @forelse ($roles as $role)
                    <tr>
                        <td>
                            <a class="font-weight-bold">
                                {{ $role['id'] }}
                            </a>
                        </td>
                        <td>
                            <span class="font-weight-normal"> {{ $role['name'] }}</span>
                        </td>
                        <td>
                            @foreach ($role->abilities as $ability)
                                <span class="">{{ $ability->pivot->ability_id }}</span>
                            @endforeach
                        </td>
                        <td>

 
                        </td>
                        <td>
                            <div class="btn-group mb-1 text-dark">

                                @if (in_array('super-db.roles.edit',$roles_Abilitiles))
                                    <a class="dropdown-item icon icon-left"
                                        href="{{ route('super-db.roles.edit', [$role['id']]) }}"><span
                                            class="fas fa-edit mr-2"><i data-feather="edit"></i>{{ __('Edit') }}</span></a>
                                    
                                @endif
                                    @if (count($role->abilities) == 0)
                                        @if (in_array('super-db.abilities.create',$roles_Abilitiles))
                                        <a class="dropdown-item icon icon-left"
                                            href="{{ route('super-db.abilities.create', $role['id']) }}"><span
                                                class="fas fa-edit mr-2"><i data-feather="edit"></i>{{ __('Create abilities') }}</span></a>
                                        @endif
                                    @else
                                        @if (in_array('super-db.abilities.edit',$roles_Abilitiles))
                                        <a class="dropdown-item icon icon-left"
                                            href="{{ route('super-db.abilities.edit', $role['id']) }}"><span
                                                class="fas fa-edit mr-2"><i data-feather="edit"></i>{{ __('Edit abilities') }}</span></a>
                                            
                                    @endif
                                    @if (in_array('super-db.roles.destroy',$roles_Abilitiles))
                                    <form action="{{ route('super-db.roles.destroy', $role['id']) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item text-danger"><span
                                                class="fas fa-trash-alt mr-2"><i
                                                    data-feather="trash"></i>{{ __('Delete') }}</span></button>
                                    </form>
                                    @endif        


                            </div>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            No Roles Found.
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>

    </div>


    </x-layout>