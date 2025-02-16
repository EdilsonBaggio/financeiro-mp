@extends('layout.master')

@section('content')
<div class="container content-login">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="col text-center content-logo">
                <h1>Redefinir senha</h1>
                <p>Redefina a sua senha</p>
            </div>
            <div class="card">
                <div class="card-body contant-login-form">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group d-none">
                            <label for="email">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                                    <!-- SVG Path -->
                                </svg>
                            </label>
                            <div>
                                <span>E-mail</span>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M10.176 5.432L6.744 8.872L5.424 7.552C5.35298 7.46589 5.26472 7.3956 5.1649 7.34564C5.06508 7.29569 4.95591 7.26717 4.84441 7.26193C4.73291 7.2567 4.62155 7.27485 4.51749 7.31522C4.41342 7.3556 4.31896 7.4173 4.24017 7.49637C4.16138 7.57544 4.10001 7.67012 4.06001 7.77433C4.02 7.87854 4.00225 7.98996 4.00788 8.10144C4.01352 8.21292 4.04242 8.32199 4.09273 8.42163C4.14304 8.52127 4.21364 8.60928 4.3 8.68L6.18 10.568C6.32989 10.717 6.53266 10.8006 6.744 10.8006C6.95535 10.8006 7.15811 10.717 7.308 10.568L11.308 6.568C11.4586 6.41842 11.5437 6.21512 11.5444 6.00283C11.5452 5.79054 11.4616 5.58664 11.312 5.436C11.1624 5.28536 10.9591 5.2003 10.7468 5.19955C10.5345 5.1988 10.3306 5.28242 10.18 5.432H10.176ZM8 0C6.41775 0 4.87103 0.469192 3.55544 1.34824C2.23985 2.22729 1.21447 3.47672 0.608967 4.93853C0.00346625 6.40034 -0.15496 8.00887 0.153721 9.56072C0.462403 11.1126 1.22433 12.538 2.34315 13.6569C3.46197 14.7757 4.88743 15.5376 6.43928 15.8463C7.99113 16.155 9.59966 15.9965 11.0615 15.391C12.5233 14.7855 13.7727 13.7602 14.6518 12.4446C15.5308 11.129 16 9.58225 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0ZM8 14.4C6.7342 14.4 5.49683 14.0246 4.44435 13.3214C3.39188 12.6182 2.57158 11.6186 2.08717 10.4492C1.60277 9.27973 1.47603 7.9929 1.72298 6.75142C1.96992 5.50994 2.57946 4.36957 3.47452 3.47452C4.36958 2.57946 5.50995 1.96992 6.75143 1.72297C7.9929 1.47603 9.27973 1.60277 10.4492 2.08717C11.6186 2.57157 12.6182 3.39188 13.3214 4.44435C14.0247 5.49683 14.4 6.7342 14.4 8C14.4 9.69739 13.7257 11.3253 12.5255 12.5255C11.3253 13.7257 9.69739 14.4 8 14.4Z" fill="#959396"/>
                                </svg>
                            </label>
                            <div>
                                <span>Nova senha</span>
                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M10.176 5.432L6.744 8.872L5.424 7.552C5.35298 7.46589 5.26472 7.3956 5.1649 7.34564C5.06508 7.29569 4.95591 7.26717 4.84441 7.26193C4.73291 7.2567 4.62155 7.27485 4.51749 7.31522C4.41342 7.3556 4.31896 7.4173 4.24017 7.49637C4.16138 7.57544 4.10001 7.67012 4.06001 7.77433C4.02 7.87854 4.00225 7.98996 4.00788 8.10144C4.01352 8.21292 4.04242 8.32199 4.09273 8.42163C4.14304 8.52127 4.21364 8.60928 4.3 8.68L6.18 10.568C6.32989 10.717 6.53266 10.8006 6.744 10.8006C6.95535 10.8006 7.15811 10.717 7.308 10.568L11.308 6.568C11.4586 6.41842 11.5437 6.21512 11.5444 6.00283C11.5452 5.79054 11.4616 5.58664 11.312 5.436C11.1624 5.28536 10.9591 5.2003 10.7468 5.19955C10.5345 5.1988 10.3306 5.28242 10.18 5.432H10.176ZM8 0C6.41775 0 4.87103 0.469192 3.55544 1.34824C2.23985 2.22729 1.21447 3.47672 0.608967 4.93853C0.00346625 6.40034 -0.15496 8.00887 0.153721 9.56072C0.462403 11.1126 1.22433 12.538 2.34315 13.6569C3.46197 14.7757 4.88743 15.5376 6.43928 15.8463C7.99113 16.155 9.59966 15.9965 11.0615 15.391C12.5233 14.7855 13.7727 13.7602 14.6518 12.4446C15.5308 11.129 16 9.58225 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0ZM8 14.4C6.7342 14.4 5.49683 14.0246 4.44435 13.3214C3.39188 12.6182 2.57158 11.6186 2.08717 10.4492C1.60277 9.27973 1.47603 7.9929 1.72298 6.75142C1.96992 5.50994 2.57946 4.36957 3.47452 3.47452C4.36958 2.57946 5.50995 1.96992 6.75143 1.72297C7.9929 1.47603 9.27973 1.60277 10.4492 2.08717C11.6186 2.57157 12.6182 3.39188 13.3214 4.44435C14.0247 5.49683 14.4 6.7342 14.4 8C14.4 9.69739 13.7257 11.3253 12.5255 12.5255C11.3253 13.7257 9.69739 14.4 8 14.4Z" fill="#959396"/>
                                </svg>
                            </label>
                            <div>
                                <span>Confirmação de senha</span>
                                <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="mt-3 botoes-cadastro">
                            <button type="submit" class="btn btn-primary">
                                Redefinir senha
                            </button>
                        </div>
                        <div class="link-esqueci">
                            <p>Lembrou sua senha? <a href="{{ route('login') }}"> Faça login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
