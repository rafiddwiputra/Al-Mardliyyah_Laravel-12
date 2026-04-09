<h2>Verifikasi Email</h2>
<p>Cek email kamu untuk link verifikasi.</p>

@if (session('message'))
    <p>{{ session('message') }}</p>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Kirim Ulang Email</button>
</form>