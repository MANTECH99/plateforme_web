<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <h1 class="text-xl font-semibold text-gray-900">Créer un compte</h1>
        <p class="mt-1 text-sm text-gray-600">Choisissez votre profil puis complétez les informations.</p>

        <!-- Role -->
        <div class="mt-6">
            <x-input-label for="role" value="Je suis" />
            <input type="hidden" name="role" id="role" value="{{ old('role', 'house') }}">
            <div class="mt-2 grid grid-cols-2 gap-3">
                <button type="button" data-role="house"
                    class="role-card w-full rounded-[15px] border bg-white p-3 text-left shadow-sm transition"
                >
                    <div class="text-sm font-semibold text-gray-900">🏠 Maison</div>
                    <div class="text-xs text-gray-600">Employer</div>
                </button>
                <button type="button" data-role="personnel"
                    class="role-card w-full rounded-[15px] border bg-white p-3 text-left shadow-sm transition"
                >
                    <div class="text-sm font-semibold text-gray-900">👩‍🍳 Personnel</div>
                    <div class="text-xs text-gray-600">Candidat</div>
                </button>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-6">
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" value="Téléphone" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- House fields -->
        <div id="house-fields" class="mt-4">
            <div class="rounded-[15px] bg-[#f8f9fa] p-4">
                <div class="text-sm font-semibold text-gray-900">Informations Maison</div>
                <div class="mt-3">
                    <x-input-label for="house_city" value="Ville (optionnel)" />
                    <x-text-input id="house_city" class="block mt-1 w-full" type="text" name="house_city" :value="old('house_city')" />
                    <x-input-error :messages="$errors->get('house_city')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Personnel fields -->
        <div id="personnel-fields" class="mt-4 hidden">
            <div class="rounded-[15px] bg-[#f8f9fa] p-4">
                <div class="text-sm font-semibold text-gray-900">Profil (CV)</div>

                <div class="mt-3">
                    <x-input-label for="photo" value="Photo de profil (optionnel)" />
                    <input id="photo" name="photo" type="file" accept="image/*"
                        class="mt-1 block w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                    />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>

                <div class="mt-3 grid grid-cols-2 gap-3">
                    <div>
                        <x-input-label for="job_title" value="Métier" />
                        <x-text-input id="job_title" class="block mt-1 w-full" type="text" name="job_title" :value="old('job_title')" />
                        <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="experience_years" value="Expérience (années)" />
                        <x-text-input id="experience_years" class="block mt-1 w-full" type="number" min="0" name="experience_years" :value="old('experience_years')" />
                        <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-3">
                    <x-input-label for="city" value="Ville" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <x-input-label for="availability" value="Disponibilité" />
                    <x-text-input id="availability" class="block mt-1 w-full" type="text" name="availability" :value="old('availability')" placeholder="Ex: Immédiate / Week-ends / 8h-18h" />
                    <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <x-input-label for="desired_salary" value="Salaire souhaité (optionnel)" />
                    <x-text-input id="desired_salary" class="block mt-1 w-full" type="number" min="0" name="desired_salary" :value="old('desired_salary')" />
                    <x-input-error :messages="$errors->get('desired_salary')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <x-input-label for="description" value="Description (optionnel)" />
                    <textarea id="description" name="description" rows="3"
                        class="mt-1 block w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                    >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                Déjà inscrit ?
            </a>

            <x-primary-button class="ms-4 !bg-[#0d6efd] hover:!bg-[#0b5ed7] focus:!ring-[#0d6efd]">
                Créer mon compte
            </x-primary-button>
        </div>
    </form>

    <script>
        (() => {
            const roleInput = document.getElementById('role');
            const cards = document.querySelectorAll('.role-card');
            const houseFields = document.getElementById('house-fields');
            const personnelFields = document.getElementById('personnel-fields');

            function applyRole(role) {
                roleInput.value = role;
                cards.forEach((btn) => {
                    const active = btn.dataset.role === role;
                    btn.classList.toggle('border-[#0d6efd]', active);
                    btn.classList.toggle('ring-2', active);
                    btn.classList.toggle('ring-[#0d6efd]', active);
                });
                const isPersonnel = role === 'personnel';
                personnelFields.classList.toggle('hidden', !isPersonnel);
                houseFields.classList.toggle('hidden', isPersonnel);
            }

            cards.forEach((btn) => btn.addEventListener('click', () => applyRole(btn.dataset.role)));
            applyRole(roleInput.value || 'house');
        })();
    </script>
</x-guest-layout>
