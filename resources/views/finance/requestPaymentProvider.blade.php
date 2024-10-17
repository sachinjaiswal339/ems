<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Request New Payment Provider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('paymentProviderRequests.store') }}" method="POST">
                        @csrf
                        <!-- Payment Method Name -->
                        <div class="mb-4">
                            <label for="payment_method_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Payment Method Name
                            </label>
                            <input type="text" name="payment_method_name" id="payment_method_name"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300"
                                required>
                        </div>

                        <!-- Website -->
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Website
                            </label>
                            <input type="url" name="website" id="website"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                        </div>

                        <!-- Event -->
                        <div class="mb-4">
                            <label for="event_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Event
                            </label>
                            <select name="event_id" id="event_id"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company
                            </label>
                            <select name="company_id" id="company_id"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
