Dear {{ $user->present()->fullName }}<br>

Your password has been reset. You can now {!! HTML::linkRoute('login', Translate::recursive('authentication.login')) !!} with: <br>

user: {{ $user->email }}<br>
password: {{ $password }}<br>