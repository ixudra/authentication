Dear {{ $user->present()->fullName }}<br>

Your account has been created successfully. You can now {!! HTML::linkRoute('login', Translate::recursive('authentication.login')) !!} with: <br>

user: {{ $user->email }}<br>
password: {{ $password }}<br>