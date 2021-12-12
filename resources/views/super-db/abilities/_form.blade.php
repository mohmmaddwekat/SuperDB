<div class="form-group">
    <label for="" class="text-capitalize">{{ __('Add admin permissions') }}</label>
    <div>
        @foreach ($abilities as $abilitiy)

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="abilitiy[]" value="{{ $abilitiy->id }}" @if (in_array($abilitiy['id'], $roles_Abilitiles)) checked @endif >
                <label class="form-check-label text-capitalize">
                    {{ $abilitiy->explain }}
                </label>
            </div>
            @if ($abilitiy->id % 8 === 0)
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
