@props(['message', 'id'])

<div class="px-4 py-2 border-b border-gray-200">
    <p class="text-sm text-gray-800">{{ $message }}</p>
    <div class="flex justify-between mt-2">
        <a href="{{ route('notifications.markAsRead', $id) }}" class="text-sm text-green-600 hover:underline">Mark as Read</a>
    </div>
</div>
