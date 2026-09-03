<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-primary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-primary/60">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="mb-2 block text-sm font-bold text-primary">
                {{ __('Name') }}
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="input w-full"
            >

            @error('name')
                <p class="mt-2 text-sm font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-bold text-primary">
                {{ __('Email') }}
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="input w-full"
            >

            @error('email')
                <p class="mt-2 text-sm font-bold text-red-600">
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-primary/70">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            class="font-bold underline hover:text-primary"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-bold text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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