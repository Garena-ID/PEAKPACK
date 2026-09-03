<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-primary">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-primary/60">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label
                for="update_password_current_password"
                class="mb-2 block text-sm font-bold text-primary"
            >
                {{ __('Current Password') }}
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="input w-full"
            >

            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password"
                class="mb-2 block text-sm font-bold text-primary"
            >
                {{ __('New Password') }}
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="input w-full"
            >

            @error('password', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label
                for="update_password_password_confirmation"
                class="mb-2 block text-sm font-bold text-primary"
            >
                {{ __('Confirm Password') }}
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="input w-full"
            >

            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-green-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>