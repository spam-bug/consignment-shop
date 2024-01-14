@php
    use App\Enums\UserStatus;
    use Carbon\Carbon;
@endphp
<x-admin-layout>
    <h1 class="text-3xl font-medium">Users</h1>

    <div class="mt-8 rounded bg-white shadow">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Type</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Business Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Business Permit</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Account Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase">Joined On</th>
                    <th class="px-4 py-2 text-left text-sm font-medium uppercase"><i class="fa-solid fa-ellipsis"></i></th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @if ($users->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No available data.</td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr>
                            <td class="p-4 text-left font-medium capitalize">{{ $user->name }}</td>
                            <td class="p-4 text-left">{{ $user->email }}</td>
                            <td class="p-4 text-left">{{ $user->type }}</td>
                            <td class="p-4 text-left">
                                {{ $user->isConsignor() ? $user->consignor->business->name : $user->consignee->business->name }}
                            </td>
                            <td class="p-4 text-left">
                                <a href="{{ asset($user->isConsignor() ? $user->consignor->business->permit : $user->consignee->business->permit) }}"
                                    download
                                >
                                    <img
                                        src="{{ asset($user->isConsignor() ? $user->consignor->business->permit : $user->consignee->business->permit) }}"
                                        alt="business permit"
                                        class="w-24"
                                    >
                                </a>
                            </td>
                            <td class="p-4 text-left">
                                <x-badge :variety="$user->status->getVariant()">{{ $user->status }}</x-badge>
                            </td>
                            <td class="p-4 text-left">{{ Carbon::parse($user->created_at)->format('F d, Y') }}</td>
                            <td>
                                @if ($user->status === UserStatus::Inactive)
                                    <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                                        @csrf
                                        <x-button variety="primary">Approve</x-button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        @if ($users->hasMorePages())
            <div class="border-t border-gray-200 p-4">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-admin-layout>
