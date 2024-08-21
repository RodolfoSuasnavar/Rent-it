<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter your email" required>
    <input type="password" name="password" placeholder="Enter new password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
    <button type="submit">Reset Password</button>
</form>
