<div class="flex h-[calc(100vh-65px)]" wire:poll>

    @if ($conversations->isNotEmpty())
        <div class="h-full w-80 border-r border-gray-200">
            @foreach ($conversations as $conversation)
                <button wire:click="$set('c', {{ $conversation->id }})" class="flex w-full items-center gap-4 p-4 text-left hover:bg-gray-100">
                    <div>
                        <x-avatar src="{{ $conversation->consignee->user->photo() }}" />
                    </div>
                    <div>
                        <h6 class="text-lg font-medium">{{ $conversation->consignee->user->username }}</h6>
                        @if ($conversation->messages()->count())
                            <p class="line-clamp-1 text-gray-500">{{ $conversation->messages()->latest()->first()->content }}</p>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>

        <div class="h-full w-full">
            @if (!empty($c))
                <div class="flex items-center gap-4 border-b border-gray-200 p-4">
                    <div>
                        <x-avatar src="{{ $conversation->consignee->user->photo() }}" />
                    </div>
                    <h6 class="text-xl font-medium">{{ $conversation->consignee->user->username }}</h6>
                </div>

                <div class="flex h-[calc(100vh-186px)] flex-col-reverse overflow-y-auto">
                    @if ($conversation->messages->isNotEmpty())
                        @foreach ($conversation->messages()->latest()->get() as $message)
                            <div class="space-y-2 p-4">
                                @if ($message->model_type === 'App\Models\Consignee')
                                    <div class="w-fit rounded bg-gray-100 p-4">
                                        {{ $message->content }}
                                    </div>
                                @else
                                    <div class="ml-auto w-fit rounded bg-blue-400 p-4 text-white">
                                        {{ $message->content }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                <form wire:submit="send" class="flex h-[55px] w-full items-center gap-4 border-t border-gray-200">
                    <input
                        type="text"
                        class="block h-full w-full px-4 focus:outline-none"
                        wire:model="message"
                        placeholder="Type a message..."
                    >

                    <div class="px-4">
                        <x-button variety="primary">send</x-button>
                    </div>
                </form>
            @endif
        </div>
    @else
        <div class="flex h-full w-full items-center justify-center">
            <p>You have no conversations</p>
        </div>
    @endif
</div>
