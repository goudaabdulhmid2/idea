<x-layout title="Login">
    <x-form.form title="Welcome Back" description="Sign in to your account to continue.">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <x-form.field name="email" type="email" label="Email" :value="old('email')" required autofocus
                autocomplete="username" />

            <x-form.field name="password" type="password" label="Password" required autocomplete="current-password" />

            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-border text-primary focus:ring-primary focus:ring-offset-background bg-background">
                <label for="remember" class="ml-2 text-sm font-medium text-foreground">Remember me</label>
            </div>

            <div class="pt-4 flex items-center justify-between">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors underline underline-offset-4">
                        Don't have an account?
                    </a>
                @endif
                <button type="submit" class="btn">
                    Log in
                </button>
            </div>
        </form>
    </x-form.form>
</x-layout>