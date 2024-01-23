<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg pe-5" style="display: flex; justify-content: space-between; align-items: center">
                <h5 class="p-5">
                    {{ __('Employee List') }}
                    <div>
                        <a href="{{ route('employees.create') }}"></a>
                    </div>
                </h5>
                <a href="{{ route('employees.create') }}">create</a>
            </div>

            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center text-sm font-light">
                                <thead class="border-b font-medium dark:border-neutral-500" style="background: rgb(250, 229, 233)">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Name</th>
                                        <th scope="col" class="px-6 py-4">Address</th>
                                        <th scope="col" class="px-6 py-4">Contact</th>
                                        <th scope="col" class="px-6 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $item)
                                    <tr class="border-b border-primary-200 text-neutral-800" style="background: rgb(227, 235, 247)">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->address }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->contact }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div>
                                                <a href="{{ route('employees.edit', $item->id) }}">edit</a>
                                                <form action="{{ route('employees.destroy', $item) }}" method="POST"
                                                    style="display: inline; margin-left: 10px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Confirm deletion?')">
                                                        delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-app-layout>
