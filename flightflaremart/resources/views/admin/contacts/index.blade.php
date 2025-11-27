@extends('admin.layouts.app') 

@section('page_title', 'Contact Messages')

@section('breadcrumb')
    <span class="text-slate-500">Admin / Messages</span>
@endsection

@section('content')
    <div class="mx-auto max-w-full">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Incoming Contact Messages ({{ $messages->count() }})</h2>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-x-auto">
            
            @if ($messages->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <p class="text-xl mb-2">Inbox is empty!</p>
                    <p>No contact messages have been submitted yet.</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subject
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sender
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Message Preview
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($messages as $message)
                            <tr class="@if(!$message->is_read) bg-indigo-50/50 hover:bg-indigo-100/50 @else hover:bg-gray-50 @endif transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium @if($message->is_read) bg-gray-100 text-gray-800 @else bg-indigo-100 text-indigo-800 @endif">
                                        @if(!$message->is_read) New @else Read @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $message->subject }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $message->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                    {{ Str::limit($message->message, 80) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $message->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection