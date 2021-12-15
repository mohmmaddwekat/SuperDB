    <x-layout title="{{ __('List Roles') }}">

        @php
            $roles_permissions = Auth::user()
                ->role->permissions()
                ->pluck('code')
                ->toArray();
            
        @endphp




        <div class="card card-body shadow-sm table-wrapper table-responsive pt-0 main-content">
            <div class="row my-2">
                <div class="btn-toolbar">
                    <div class="col col-md-6 col-lg-3 col-xl-4 ">
                        <div class="btn-group m-2">
                            @if (in_array('super-db.roles.create', $roles_permissions))
                                <a href="{{ route('super-db.roles.create') }}"><button class="btn btn-primary btn-sm  "
                                        aria-haspopup="true" aria-expanded="false"> <span class="fas fa-plus mr-2"><i
                                                data-feather="plus-circle"></i>{{ __('Create new Roles') }}</span></button></a>

                            @endif
                        </div>
                    </div>


                </div>



            </div>
            <table class="table table-hover ">

                <thead>
                    <tr>
                        <th class="dataTable-sorter">#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('# permissions') }}</th>
                        <th></th>
                        <th class="" scope="2">{{ __('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Item -->
                    @forelse ($roles as $role)
                        <tr>
                            <td>
                                <span class="font-weight-bold">
                                    {{ $role['id'] - 1 }}
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal"> {{ $role['name'] }}</span>
                            </td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="">{{ $permission->pivot->permission_id }}</span>
                                @endforeach
                            </td>
                            <td>


                            </td>
                            <td>
                                <div class="btn-group mb-1 text-dark">

                                    @if (in_array('super-db.roles.edit', $roles_permissions))
                                        <a class="dropdown-item icon icon-left"
                                            href="{{ route('super-db.roles.edit', [$role['id']]) }}"><span
                                                class="fas fa-edit mr-2"><i
                                                    data-feather="edit"></i>{{ __('Edit') }}</span></a>

                                    @endif
                                    @if (count($role->permissions) == 0)
                                        @if (in_array('super-db.permissions.create', $roles_permissions))
                                            <a class="dropdown-item icon icon-left"
                                                href="{{ route('super-db.permissions.create', $role['id']) }}"><span
                                                    class="fas fa-edit mr-2"><i
                                                        data-feather="edit"></i>{{ __('Create permissions') }}</span></a>
                                        @endif
                                    @else
                                        @if (in_array('super-db.permissions.edit', $roles_permissions))
                                            <a class="dropdown-item icon icon-left"
                                                href="{{ route('super-db.permissions.edit', $role['id']) }}"><span
                                                    class="fas fa-edit mr-2"><i
                                                        data-feather="edit"></i>{{ __('Edit permissions') }}</span></a>

                                        @endif
                                    @endif
                                    @if (in_array('super-db.roles.destroy', $roles_permissions))
                                        <form action="{{ route('super-db.roles.destroy', $role['id']) }}"
                                            method="post">
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
