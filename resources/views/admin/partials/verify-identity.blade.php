<form action="{{ route('identity.verify') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="user_id" class="block text-sm font-medium text-gray-700">User ID:</label>
        <input type="text" name="user_id" value="{{ $userId }}" readonly class="mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div class="mb-4">
        <label for="user_name" class="block text-sm font-medium text-gray-700">User Name:</label>
        <input type="text" name="user_name" value="{{ $userName }}" readonly class="mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div class="mb-4">
        <label for="verification_status" class="block text-sm font-medium text-gray-700">Verification Status:</label>
        <select name="verification_status" id="verification_status" class="mt-1 p-2 border border-gray-300 rounded">
            <option value="verified">Verified</option>
            <option value="declined">Declined</option>
        </select>
    </div>

    <div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
    </div>
</form>
