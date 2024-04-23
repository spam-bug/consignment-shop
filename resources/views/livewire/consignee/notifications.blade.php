<div wire:poll class="relative" x-data="{ open: false }">
    <x-button
        variety="secondary"
        outline
        x-on:click="open = !open"
        wire:click="markAsRead"
    >
        <i class="fa-regular fa-bell"></i>
        @if ($hasUnreadNotification)
            <div class="w-2 h-2 rounded-full bg-red-500 absolute -top-1 right-0"></div>
        @endif
    </x-button>

    <div x-show="open" x-transition class="w-80 h-72 bg-white rounded border border-gray-200 absolute right-0 mt-2 shadow overflow-y-auto">
        <div class="px-4 py-2 border-b border-gray-200">
            <p class="font-medium text-lg">Notifications</p>
        </div>

        @if ($notifications->isNotEmpty())
            @foreach ($notifications as $notification)
                <div class="p-4 border-b border-gray-200">
                    <p class="font-medium mb-1">{{ $notification->data['title'] }}</p>
                    <p class="text-sm text-gray-500">{{ $notification->data['message'] }}</p>
                </div>
            @endforeach
        @else
            <div class="h-full flex flex-col gap-1 items-center justify-center">
                <i class="fa-solid fa-bell text-gray-400 text-4xl"></i>
                <small class="text-gray-500">Notification is empty</small>
            </div>
        @endif
    </div>
</div>