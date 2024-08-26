@extends('layout.master') 

@section('content')
<div class="container content-login"> 
   <div class="row justify-content-center"> 
      <div class="col-md-4"> 
         <div class="col text-center content-logo">
            <img  class="img-fluid" src="{{ Vite::asset('resources/images/logo.svg') }}" alt="">
            <h1>Bem-vindo novamente!</h1>
            <p>Faça login para continuar</p>
         </div>
         <div class="card"> 
            <div class="card-body contant-login-form">
               <form method="POST" action="{{ route('login') }}">
                  @csrf 

                  <div class="form-group"> 
                     <label for="usuario">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                           <path d="M12.909 0.924988H2.278C1.67384 0.924988 1.09442 1.16499 0.667211 1.5922C0.240003 2.01941 0 2.59882 0 3.20299V10.797C0 11.4012 0.240003 11.9806 0.667211 12.4078C1.09442 12.835 1.67384 13.075 2.278 13.075H12.909C13.5132 13.075 14.0926 12.835 14.5198 12.4078C14.947 11.9806 15.187 11.4012 15.187 10.797V3.20299C15.187 2.59882 14.947 2.01941 14.5198 1.5922C14.0926 1.16499 13.5132 0.924988 12.909 0.924988ZM12.6 2.44399L8.133 6.90899C8.06244 6.98016 7.97848 7.03665 7.88597 7.07521C7.79345 7.11376 7.69422 7.13361 7.594 7.13361C7.49378 7.13361 7.39455 7.11376 7.30203 7.07521C7.20952 7.03665 7.12556 6.98016 7.055 6.90899L2.589 2.44399H12.6ZM13.671 10.797C13.671 10.9983 13.591 11.1913 13.4487 11.3337C13.3064 11.476 13.1133 11.556 12.912 11.556H2.278C2.0767 11.556 1.88365 11.476 1.74131 11.3337C1.59897 11.1913 1.519 10.9983 1.519 10.797V3.51399L5.984 7.97899C6.41114 8.40571 6.99022 8.64541 7.594 8.64541C8.19778 8.64541 8.77686 8.40571 9.204 7.97899L13.669 3.51399L13.671 10.797Z" fill="#959396"/>
                        </svg>
                     </label>
                     <div>
                        <span>E-mail</span>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus> 
                     </div>
                     @error('email') 
                        <span class="invalid-feedback" role="alert"> 
                           <strong>{{ $message }}</strong> 
                        </span>
                     @enderror 
                  </div>
                  <br>
                  <div class="form-group">
                     <label for="password">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                           <path d="M7.14482 9.04C6.89472 9.0373 6.64977 9.11122 6.44292 9.25183C6.23606 9.39245 6.07721 9.59301 5.9877 9.82657C5.8982 10.0601 5.88233 10.3155 5.94224 10.5583C6.00215 10.8012 6.13496 11.0199 6.32282 11.185V12.327C6.32282 12.545 6.40943 12.7541 6.56358 12.9082C6.71774 13.0624 6.92682 13.149 7.14482 13.149C7.36283 13.149 7.57191 13.0624 7.72607 12.9082C7.88022 12.7541 7.96682 12.545 7.96682 12.327V11.185C8.15469 11.0199 8.2875 10.8012 8.34741 10.5583C8.40732 10.3155 8.39145 10.0601 8.30195 9.82657C8.21244 9.59301 8.05359 9.39245 7.84673 9.25183C7.63987 9.11122 7.39493 9.0373 7.14482 9.04ZM11.2538 5.753V4.109C11.2538 3.01923 10.8209 1.97409 10.0503 1.2035C9.27974 0.432911 8.2346 0 7.14482 0C6.05505 0 5.00991 0.432911 4.23932 1.2035C3.46874 1.97409 3.03582 3.01923 3.03582 4.109V5.753C2.71203 5.75287 2.39139 5.81653 2.0922 5.94035C1.79302 6.06417 1.52116 6.24572 1.29216 6.47463C1.06316 6.70354 0.881497 6.97532 0.757557 7.27445C0.633617 7.57359 0.569824 7.89421 0.569824 8.218V13.971C0.569824 14.6248 0.829529 15.2517 1.29181 15.714C1.75408 16.1763 2.38107 16.436 3.03482 16.436H11.2528C11.9066 16.436 12.5336 16.1763 12.9958 15.714C13.4581 15.2517 13.7178 14.6248 13.7178 13.971V8.218C13.7178 7.56441 13.4583 6.93758 12.9962 6.47534C12.5341 6.01309 11.9074 5.75326 11.2538 5.753ZM4.67882 4.109C4.67882 3.45511 4.93858 2.828 5.40095 2.36563C5.86332 1.90326 6.49043 1.6435 7.14432 1.6435C7.79822 1.6435 8.42533 1.90326 8.8877 2.36563C9.35007 2.828 9.60982 3.45511 9.60982 4.109V5.753H4.67882V4.109ZM12.0788 13.971C12.0788 14.189 11.9922 14.3981 11.8381 14.5522C11.6839 14.7064 11.4748 14.793 11.2568 14.793H3.03482C2.81682 14.793 2.60774 14.7064 2.45358 14.5522C2.29943 14.3981 2.21282 14.189 2.21282 13.971V8.218C2.21388 8.00069 2.30095 7.79263 2.45499 7.63934C2.60903 7.48605 2.81751 7.4 3.03482 7.4H11.2528C11.4708 7.4 11.6799 7.4866 11.8341 7.64076C11.9882 7.79491 12.0748 8.00399 12.0748 8.222L12.0788 13.971Z" fill="#959396"/>
                        </svg>
                     </label>
                     <div>
                        <span>Senha</span>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                     </div>
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                     <div class="show-password" id="showPassword">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                           <path d="M15.9411 6.68002C14.3221 2.93202 11.2901 0.606018 8.01312 0.606018C4.73612 0.606018 1.70012 2.93202 0.0851245 6.68002C0.0412161 6.78081 0.0185547 6.88958 0.0185547 6.99952C0.0185547 7.10946 0.0412161 7.21822 0.0851245 7.31902C1.69912 11.067 4.73612 13.393 8.01312 13.393C11.2901 13.393 14.3261 11.067 15.9411 7.31902C15.985 7.21822 16.0077 7.10946 16.0077 6.99952C16.0077 6.88958 15.985 6.78081 15.9411 6.68002ZM8.01312 11.794C5.48012 11.794 3.08212 9.96402 1.70012 6.99902C3.08212 4.03402 5.48012 2.20602 8.01312 2.20602C10.5461 2.20602 12.9441 4.03602 14.3261 7.00102C12.9441 9.96402 10.5461 11.794 8.01312 11.794ZM8.01312 3.80202C7.38022 3.80202 6.76154 3.98969 6.2353 4.34132C5.70906 4.69294 5.29891 5.19271 5.05671 5.77743C4.81451 6.36215 4.75114 7.00557 4.87461 7.62631C4.99808 8.24705 5.30285 8.81723 5.75038 9.26476C6.19791 9.71229 6.7681 10.0171 7.38883 10.1405C8.00957 10.264 8.65299 10.2006 9.23771 9.95843C9.82243 9.71623 10.3222 9.30608 10.6738 8.77984C11.0254 8.2536 11.2131 7.63492 11.2131 7.00202C11.2121 6.15402 10.8745 5.34111 10.2745 4.74186C9.67445 4.14261 8.86112 3.80602 8.01312 3.80602V3.80202ZM8.01312 8.59702C7.69667 8.59702 7.38733 8.50318 7.12421 8.32737C6.86109 8.15156 6.65602 7.90167 6.53492 7.60931C6.41382 7.31695 6.38213 6.99524 6.44387 6.68487C6.5056 6.3745 6.65799 6.08941 6.88175 5.86565C7.10552 5.64188 7.39061 5.4895 7.70098 5.42776C8.01135 5.36603 8.33306 5.39771 8.62542 5.51881C8.91778 5.63991 9.16767 5.84499 9.34348 6.10811C9.51929 6.37122 9.61312 6.68057 9.61312 6.99702C9.61326 7.20722 9.57197 7.41538 9.49162 7.60962C9.41127 7.80385 9.29344 7.98036 9.14485 8.12903C8.99626 8.27771 8.81983 8.39566 8.62565 8.47613C8.43146 8.5566 8.22332 8.59702 8.01312 8.59702Z" fill="#959396"/>
                        </svg>
                     </div>
                  </div>
                  <div class="content-login-esqueci">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="lembrar">
                        <label class="form-check-label" for="lembrar">
                          Lembrar-me
                        </label>
                     </div>
                     <a href="{{ route('esqueci-a-senha') }}">Esqueceu sua senha?</a>
                  </div>
                  <div class="mb-0 botoes-cadastro">
                     <button type="submit" class="btn btn-primary"> 
                        Log In
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#showPassword').click(function() {
            var passwordField = $('#password');
            var fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
            } else {
                passwordField.attr('type', 'password');
            }
        });
    });
</script>
@endsection