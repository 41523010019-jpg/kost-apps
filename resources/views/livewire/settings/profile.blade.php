<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile information')">
        <form wire:submit.prevent="updateProfileInformation" class="my-6 w-full space-y-6">
            
            {{-- Name --}}
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            {{-- Email --}}
            <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <flux:text class="mt-4">
                        {{ __('Your email address is unverified.') }}

                        <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                            {{ __('Click here to re-send the verification email.') }}
                        </flux:link>
                    </flux:text>

                    @if (session('status') === 'verification-link-sent')
                        <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </flux:text>
                    @endif
                </div>
            @endif

            {{-- Phone --}}
            <flux:input wire:model="phone" :label="__('Phone')" type="text" autocomplete="tel" />

            {{-- Gender --}}
            <flux:select wire:model="gender" :label="__('Gender')">
                <option value="">{{ __('Select Gender') }}</option>
                <option value="male">{{ __('Male') }}</option>
                <option value="female">{{ __('Female') }}</option>
            </flux:select>

            {{-- Address --}}
            <flux:input wire:model="address" :label="__('Address')" type="text" />

            {{-- Submit Button --}}
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>

            {{-- Delete User (only for admin) --}}
            @role('admin')
                <livewire:settings.delete-user-form />
            @endrole

        </form>
    </x-settings.layout>
</section>
