<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <span class="text-blue-500 font-bold text-3xl">My Applications</span>
                    @foreach ($applications as $application)
                    <div class='mt-5 ms-5'>
                        <div class="rounded-xl border p-5 shadow-md w-9/12 bg-white m-5">
                            <div class="flex w-full items-center justify-between border-b pb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                                    <div class="text-lg font-bold text-slate-700">{{$application->user->name}}</div>
                                </div>
                                <div class="flex items-center space-x-8">
                                    <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$application->id}}</button>
                                    <div class="text-xs text-neutral-500">{{$application->updated_at->format('Y/m/d')}}</div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="mt-4 mb-6">
                                    <div class="mb-3 text-xl font-bold">{{$application->subject}}</div>
                                    <div class="text-sm text-neutral-600">{{$application->message}}</div>
                                </div>
                                @if($application->file_url!=null)
                                <div class="cursor-pointer ms-5">
                                    <a href="{{asset('storage/' . $application->file_url)}}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                        </svg>
                                    </a>
                                </div>
                                @else
                                <div class="ms-5">No file</div>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center justify-between text-slate-500">
                                    {{$application->user->email}}
                                </div>
                                @if ($application->answer()->exists())
                                <div class="border-t">
                                    <span class="text-indigo-600 text-xl mt-5 pt-5">Answer:</span>{{$application->answer->body}}
                                </div>
                                @else
                                <span class="text-indigo-600 text-xl mt-5 pt-5">Answer:</span> Not answer
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex items-center mt-5 justify-center">
                    <div class="pagination-wrapper">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>