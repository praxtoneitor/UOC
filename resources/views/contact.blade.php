<!-- resources/views/contact.blade.php -->
<form method="POST" action="{{ route('send.email') }}">
    @csrf
    <label for="email">Tu correo electrónico:</label>
    <input type="email" name="email" required>
    <label for="message">Mensaje:</label>
    <textarea name="message" required></textarea>
    <button type="submit">Enviar</button>
</form>