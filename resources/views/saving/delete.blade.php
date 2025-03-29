<h1>You want to delete "{{ $box->name }}" ?</h1>
<form action="{{route('saving.delete', $box->id)}}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit">Delete</button>
</form>