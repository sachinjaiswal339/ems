<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Payment for ') . $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('finance.updatePayment', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Payment Method
                            </label>
                            <select name="payment_method" id="payment_method" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}" {{ $eventPayment && $eventPayment->payment_method_id == $paymentMethod->id ? 'selected' : '' }}>
                                        {{ $paymentMethod->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- VAT Rate -->
                        <div class="mb-4">
                            <label for="vat_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                VAT Rate
                            </label>
                            <input type="number" name="vat_rate" id="vat_rate" step="0.01" value="{{ old('vat_rate', $eventPayment->vat_rate ?? '') }}"
                                class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300" />
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Company
                            </label>
                            <select name="company" id="company" class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-gray-300">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $eventPayment && $eventPayment->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
