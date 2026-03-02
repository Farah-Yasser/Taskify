<form method="POST" action="{{ route('verification.code.verify') }}">
    @csrf
    <input type="text" name="code" placeholder="Enter verification code">
    <button type="submit">Verify</button>
</form>
