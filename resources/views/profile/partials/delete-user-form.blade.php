<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-primary">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-primary/60">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-red-700"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="space-y-6 bg-white p-6"
        >
            @csrf
            @method('delete')

            <div>
                <h2 class="text-lg font-bold text-primary">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-2 text-sm text-primary/60">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <div>
                <label
                    for="password"
                    class="mb-2 block text-sm font-bold text-primary"
                >
                    {{ __('Password') }}
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    class="input w-full"
                >

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm font-bold text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-lg border border-primary/20 bg-white px-4 py-2 text-sm font-bold text-primary hover:bg-primary/5"
                >
                    {{ __('Cancel') }}
                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-red-600 px-4 py-2 text-sm font-bold text-white hover:bg-red-700"
                >
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>