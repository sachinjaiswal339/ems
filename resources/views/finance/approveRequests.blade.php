<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Approve Payment Provider Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($paymentProviderRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->payment_method_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->event->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->company->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($request->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($request->status === 'pending')
                                            <form action="{{ route('paymentProviderRequests.updateStatus', $request->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button class="text-green-600 hover:text-green-900">Approve</button>
                                            </form>
                                            <form action="{{ route('paymentProviderRequests.updateStatus', $request->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button class="text-red-600 hover:text-red-900">Reject</button>
                                            </form>
                                        @else
                                            <span>{{ ucfirst($request->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
