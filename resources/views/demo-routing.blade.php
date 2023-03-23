<form action="/demo-routing" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="POST">
    <button type="submit">Submit</button>
</form>
