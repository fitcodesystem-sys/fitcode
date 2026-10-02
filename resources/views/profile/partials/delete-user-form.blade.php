<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Excluir a conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assim que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir a sua conta, por favor, baixe quaisquer dados ou informações que você deseje manter.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Apagar conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Você tem certeza que deseja excluir a sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Assim que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Por favor, entre com sua senha para confirmar se você gostaria de excluir permanentemente sua conta') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Senha') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Excluir a conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
