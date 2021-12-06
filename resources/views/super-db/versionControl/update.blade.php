<x-layout title="{{ __('Version Control') }}">
        <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.jobs.view-column', [$table, $id]) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
    </div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">{{ __('Database') }}</th>
    </tr>
  </thead>
  <tbody>
    @if (sizeof($files) > 0) 
    @foreach ($files as $file)
        <tr>
          <td><a href="{{ route('super-db.versionControl.update', [$file,$table,$id]) }}">{{ $file }}</a></td>
      @endforeach
          @else 
        <tr class="notfound">
          <td colspan="2">
          <h5 style="text-align: center;">{{ __('There are no databases, add a new one') }}</h5>
          </td>
        </tr>
        @endif
      <tr>
      </tr>
  </tbody>
</table>
</x-layout>