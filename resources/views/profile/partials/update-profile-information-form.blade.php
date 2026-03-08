<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="phone" placeholder="Enter your phone number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" autocomplete="address" placeholder="Enter your address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio / About Me')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4" placeholder="Tell us about yourself">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Skills -->
        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <textarea id="skills" name="skills" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3" placeholder="List your skills (e.g., PHP, JavaScript, Laravel, React)">{{ old('skills', $user->skills) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                {{ __('Upload a profile photo (JPG, PNG or GIF)') }}
            </p>
            
            @if($user->profile_photo)
                <div class="mb-3 p-3 bg-gray-100 dark:bg-gray-700 rounded flex items-center gap-4">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="w-16 h-16 rounded-full object-cover">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Current photo') }}
                        </p>
                    </div>
                </div>
            @endif
            
            <input type="file" name="profile_photo" id="profile_photo" accept=".jpg,.jpeg,.png,.gif" class="mt-1 block w-full">
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- Resume Upload -->
        <div>
            <x-input-label for="resume" :value="__('Resume')" />
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                {{ __('Upload your resume (PDF, DOC, or DOCX files only) - Required for applying to jobs') }}
            </p>
            
            @if($user->resume)
                <div class="mb-3 p-3 bg-gray-100 dark:bg-gray-700 rounded">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Current resume: ') }}<strong>{{ basename($user->resume) }}</strong>
                    </p>
                    <a href="{{ asset('storage/' . $user->resume) }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 underline">
                        {{ __('View Resume') }}
                    </a>
                </div>
            @endif
            
            <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" class="mt-1 block w-full">
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

