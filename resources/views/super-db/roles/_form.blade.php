<!-- Name -->
<div>
    <label for="name">{{__('Name')}}</label>
    <input type="text" name="name" id="name" value="{{ old('name', $role['name']) }}">

</div>

<div class="flex items-center justify-end mt-4 " style="font-family: Arial, Helvetica, sans-serif;">
    <button class="ml-4">
        {{ __($savelabel) }}

    </button>

</div>
