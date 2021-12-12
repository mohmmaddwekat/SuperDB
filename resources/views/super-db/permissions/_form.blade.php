<div class="form-group">
    <label for="" class="text-capitalize">{{ __('Add admin permissions') }}</label>
    <div>
        @foreach ($permissions as $permission)

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if (in_array($permission['id'], $roles_permissions)) checked @endif >
                <label class="form-check-label text-capitalize">
                    {{ $permission->explain }}
                </label>
            </div>
            @if ($permission->id % 8 === 0)
                <hr class="pt-1">
            @endif
        @endforeach
    </div>
</div>


<div class="flex items-center justify-end mt-4 " style="font-family: Arial, Helvetica, sans-serif;">

    <button class="ml-4">
        {{ __($savelabel) }}

    </button>
</div>
