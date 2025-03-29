<h1>You want to delete "{{ $goal->name }}" ?</h1>
<form action="{{route('goals.delete', $goal->id)}}" method="POST">
  @csrf
  @method('DELETE')
  <button type="submit">Delete</button>
</form>