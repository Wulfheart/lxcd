<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>{{ env("APP_NAME") }} - LXCD</title>
</head>

<body>



    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            @if ($dirurl->parent())
            <a href="{{ url($dirurl->parent()) }}" class="group ">
                <div class="my-6 overflow-hidden bg-white shadow group-hover:bg-gray-100 sm:rounded-lg">
                    <div class="flex flex-row px-4 py-5 align-bottom border-b border-gray-200 sm:px-6">
                        <svg fill="none" class="h-6 pr-2" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8">
                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <h3 class="text-base text-lg font-bold leading-6 text-gray-900">
                            /..
                        </h3>
                    </div>
                </div>
            </a>
            @endif

            @foreach ($folders as $folder)
            <a href="{{ url($dirurl->child($folder)) }}" class="group ">
                <div class="my-6 overflow-hidden bg-white shadow group-hover:bg-gray-100 sm:rounded-lg">
                    <div class="flex flex-row px-4 py-5 align-bottom border-b border-gray-200 sm:px-6">
                        <svg fill="none" class="h-6 pr-2" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8">
                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <h3 class="text-base text-lg font-bold leading-6 text-gray-900">
                            {{ $folder }}
                        </h3>
                    </div>
                </div>
            </a>
            @endforeach

            @foreach ($components as $component)
            <div class="my-6 overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg font-bold leading-6 text-gray-900">
                        {{ $component->label }}
                    </h3>
                    <p class="max-w-2xl mt-1 text-sm leading-5 text-gray-500">
                        {{ $component->description }}
                    </p>
                </div>
                <div class="pb-2 sm:p-0">
                    {{--  --}}

                    <div class="flex flex-col">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div
                                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="min-w-full table-fixed">
                                    <thead>
                                        <tr>
                                            <th class="w-2 py-3 border-b border-gray-200 bg-gray-50"></th>
                                            <th
                                                class="w-1/6 px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Name
                                            </th>
                                            <th
                                                class="w-1/6 px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Type
                                            </th>
                                            <th
                                                class="w-1/5 px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Default value
                                            </th>
                                            <th
                                                class="w-auto px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Description
                                            </th>
                                        </tr>
                                    </thead>
                                    @if (count($component->params) > 0)

                                    <tbody class="bg-white">
                                        @foreach ($component->params as $param)
                                        <tr class="hover:bg-gray-50">
                                            @if ($param->required())
                                            <td class="w-2 bg-red-500 border-b border-gray-200"></td>
                                            @else
                                            <td class="w-2 border-b border-gray-200"></td>
                                            @endif
                                            <td
                                                class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 border-b border-gray-200">
                                                {{ $param->name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm leading-5 text-gray-500 border-b dborder-gray-200">
                                                {{ $param->type }}
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                                                @if ($param->default)
                                                <span
                                                    class="p-1 font-mono bg-gray-200 rounded">{{ $param->default }}</span>
                                                @endif
                                            </td>
                                            <td
                                                class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                                                {{ $param->description }}
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                {{-- Empty --}}
                                </table>
                                <div class="w-full px-2 py-4 text-center bg-white">
                                    There are no parameters defined for this component.
                                </div>

                                @endif

                            </div>
                        </div>
                    </div>

                    {{--  --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>



</body>

</html>
