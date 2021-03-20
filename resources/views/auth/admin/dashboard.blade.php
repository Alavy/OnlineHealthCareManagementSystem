<x-admin-dashboard>
    @isset($admin)
        <div class="min-w-full">
            <div class="bg-white p-12">
                <h2 class="font-bold">Admin's Bio</h2>
                <ul>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Name : {{ $admin->name }}</li>
                    <li class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">Email : {{ $admin->email }}</li>
                </ul>
            </div>
        </div>
    @endisset
</x-admin-dashboard>
