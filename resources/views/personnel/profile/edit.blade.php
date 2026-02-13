<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="font-semibold text-gray-800">Modifier mon profil</div>
            <a href="{{ route('personnel.dashboard') }}" class="text-sm font-semibold text-[#0d6efd]">Retour</a>
        </div>
    </x-slot>

    <div class="py-6">
        @if (session('status'))
            <div class="rounded-[15px] bg-[#0d6efd]/10 p-3 text-sm text-[#0d6efd]">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-4 space-y-3" method="POST" action="{{ route('personnel.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Informations</h2>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Nom</label>
                    <input name="name" value="{{ old('name', $user->name) }}"
                           class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Téléphone</label>
                    <input name="phone" value="{{ old('phone', $user->phone) }}"
                           class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Profil (CV)</h2>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Photo de profil</label>
                    <input name="photo" type="file" accept="image/*"
                           class="mt-1 block w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>

                <div class="mt-3 grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Métier</label>
                        <input name="job_title" value="{{ old('job_title', $personnel->job_title) }}"
                               class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                        <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Expérience (années)</label>
                        <input name="experience_years" type="number" min="0" value="{{ old('experience_years', $personnel->experience_years) }}"
                               class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                        <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Ville</label>
                    <input name="city" value="{{ old('city', $personnel->city) }}"
                           class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Disponibilité</label>
                    <input name="availability" value="{{ old('availability', $personnel->availability) }}"
                           class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Salaire souhaité (optionnel)</label>
                    <input name="desired_salary" type="number" min="0" value="{{ old('desired_salary', $personnel->desired_salary) }}"
                           class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]" />
                    <x-input-error :messages="$errors->get('desired_salary')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                              class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]">{{ old('description', $personnel->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="rounded-[15px] bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-gray-900">Sections CV</h2>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Compétences</label>
                    <textarea name="skills" rows="3"
                              class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]">{{ old('skills', $personnel->skills) }}</textarea>
                    <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Parcours professionnel</label>
                    <textarea name="career_path" rows="3"
                              class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]">{{ old('career_path', $personnel->career_path) }}</textarea>
                    <x-input-error :messages="$errors->get('career_path')" class="mt-2" />
                </div>

                <div class="mt-3">
                    <label class="text-xs font-semibold text-gray-700">Maisons où j’ai travaillé</label>
                    <textarea name="work_history" rows="3"
                              class="mt-1 w-full rounded-[15px] border-gray-300 text-sm shadow-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]">{{ old('work_history', $personnel->work_history) }}</textarea>
                    <x-input-error :messages="$errors->get('work_history')" class="mt-2" />
                </div>
            </div>

            <button class="w-full rounded-[15px] bg-[#0d6efd] px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#0b5ed7]">
                Enregistrer
            </button>
        </form>
    </div>
</x-app-layout>

