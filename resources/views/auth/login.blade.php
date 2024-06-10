<x-layouts.auth>
    <div class="col-md-5 col-11 mx-auto">
        <!-- Header -->
        <div class="py-4 text-center">
            <x-partials.logo />
            <h1 class="h3 fw-bold mt-4 mb-2">{{ trans('auth.pages.login') }}</h1>
        </div>

        <!-- Sign In Form -->
        <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="block block-themed block-rounded block-fx-shadow">
                <div class="block-header">
                    <h3 class="block-title">{{ trans('auth.titles.login') }}</h3>
                </div>
                <div class="block-content">
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                        <label class="form-label" for="email">{{ trans('auth.fields.email') }}</label>
                        <x-forms.errors.input-message model="email" />
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
                        <label class="form-label" for="password">{{ trans('auth.fields.password') }}</label>
                        <x-forms.errors.input-message model="password" />
                    </div>
                    <div class="row">
                        <div class="col-12 text-sm-end push">
                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium w-100">{{ trans('auth.buttons.login') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.auth>
