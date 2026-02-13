<x-app-layout>
    @php
        $meUser = auth()->user();
        $otherName = $meUser?->isHouse() ? $connection->personnel->user->name : $connection->house->user->name;
    @endphp

    <div class="py-6">
        <div class="rounded-[15px] bg-white p-4 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <div class="truncate text-sm font-semibold text-gray-900">
                        <i class="fa-solid fa-comments mr-2 text-[#0d6efd]"></i>{{ $otherName }}
                    </div>
                    <div class="mt-1 text-xs text-gray-600">Chat sécurisé (mise en relation validée)</div>
                </div>
                <a href="{{ route('chat.index') }}" class="text-sm font-semibold text-[#0d6efd]">Liste</a>
            </div>
        </div>

        <div id="chatMessages" class="mt-4 space-y-2 pb-44">
            @foreach($messages as $m)
                @php $isMe = (int) $m->sender_id === (int) $me; @endphp
                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $isMe ? 'bg-[#0d6efd] text-white rounded-br-[4px]' : 'bg-white text-gray-900 rounded-bl-[4px]' }} max-w-[85%] rounded-[15px] px-4 py-2 shadow-sm">
                        <div class="whitespace-pre-wrap text-sm">{{ $m->message }}</div>
                        <div class="mt-1 text-[10px] opacity-75 {{ $isMe ? 'text-white' : 'text-gray-500' }}">
                            {{ $m->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="md:hidden fixed left-0 bottom-[72px] w-full z-40">
        <div class="mx-auto max-w-md px-4">
            <form method="POST" action="{{ route('chat.messages.store', $connection) }}" class="flex items-center gap-2 rounded-[15px] bg-white p-2 shadow-[0_-2px_12px_rgba(0,0,0,0.08)]">
                @csrf
                <input name="message" required placeholder="Votre message..."
                    class="flex-1 rounded-[15px] border-gray-200 text-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                />
                <button class="shrink-0 rounded-[15px] bg-[#0d6efd] px-4 py-2 text-sm font-semibold text-white hover:bg-[#0b5ed7]">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="hidden md:block">
        <div class="mx-auto w-full max-w-3xl">
            <form method="POST" action="{{ route('chat.messages.store', $connection) }}" class="flex items-center gap-2 rounded-[15px] bg-white p-3 shadow-sm">
                @csrf
                <input name="message" required placeholder="Votre message..."
                    class="flex-1 rounded-[15px] border-gray-200 text-sm focus:border-[#0d6efd] focus:ring-[#0d6efd]"
                />
                <button class="shrink-0 rounded-[15px] bg-[#0d6efd] px-4 py-2 text-sm font-semibold text-white hover:bg-[#0b5ed7]">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

    <script>
        (() => {
            const el = document.getElementById('chatMessages');
            if (el) {
                window.requestAnimationFrame(() => {
                    window.scrollTo({ top: document.body.scrollHeight, behavior: 'auto' });
                });
            }
        })();
    </script>
</x-app-layout>

