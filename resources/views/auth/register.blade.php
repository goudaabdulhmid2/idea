<x-layout title="Register">
    <x-form.form title="Create an Account" description="Join us to start building your ideas.">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <x-form.field name="name" label="Name" :value="old('name')" required autofocus autocomplete="name" />

            <x-form.field name="email" type="email" label="Email" :value="old('email')" required
                autocomplete="username" />

            <x-form.field name="password" type="password" label="Password" required autocomplete="new-password" />

            <x-form.field name="password_confirmation" type="password" label="Confirm Password" required
                autocomplete="new-password" />

            <div class="pt-4 flex items-center justify-between">
                <a href="{{ route('login') }}"
                    class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors underline underline-offset-4">
                    Already registered?
                </a>
                <button type="submit" class="btn" data-testid="register-button">
                    Register
                </button>
            </div>
        </form>
    </x-form.form>
</x-layout>