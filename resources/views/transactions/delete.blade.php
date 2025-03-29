<h1>You want to delete "{{ $transaction->title }}"</h1>
<form action={{route('transactions.delete', $transaction->id)}} method="POST">
  @csrf
  @method('DELETE')
  <button type="submit">Delete</button>
</form>