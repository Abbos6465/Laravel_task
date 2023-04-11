<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role->name === "manager")
                    <span class="text-blue-500 font-bold text-3xl">Received Applications</span>
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
                                <div class="flex justify-end">
                                    <a href="{{route('application.answer',['application'=>$application->id])}}" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                        Success
                                    </a>
                                </div>
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


                @else
                @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{session('error')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
                @endif
                <div class='flex items-center justify-center min-h-screen from-teal-100 via-teal-300 to-teal-500'>
                    <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
                        <div class='max-w-md mx-auto space-y-6'>
                            @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form action="{{route('application.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h2 class="text-2xl font-bold ">Submit your application</h2>
                                <hr class="my-6">
                                <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                <input name="subject" type="text" value="{{old('subject')}}" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                <label class="uppercase text-sm font-bold opacity-70">Message</label>
                                <textarea name="message" required class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none" rows="5">{{old('msgfmt_parse_message')}}</textarea>
                                <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                <input type="file" name="file" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                <input type="submit" class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300" value="Send">
                            </form>

                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-app-layout>