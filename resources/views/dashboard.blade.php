<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   
    <div class="py-12 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:bg-gray-800">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <table class="w-full text-md rounded mb-4 dark:bg-gray-800">
                    <thead>
                    <tr>
                        <th>
                            <div class="flex-auto text-left text-2xl mt-4 mb-4 dark:text-white">Notes List</div>
                        </th>
                        <th>
                            <div class="flex-auto text-right float-right mt-4 mb-4">
                                <a href="/note" class="btn btn-success">Add a new note</a>                        
                            </div>
                        </th>
                    </tr>
                    <tr class="border-b dark:text-white text-center">
                        <th class="text-center p-3 px-5">Title</th>
                        <th class="text-center p-3 px-5">Description</th>
                        <th class="text-right p-3 px-5">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->notes as $note)
                        <tr class="border-b hover:bg-orange-100 dark:text-white text-center">
                            <td class="p-3 px-5">
                                {{$note->title}}
                            </td>    
                            <td class="p-3 px-5">
                                {{$note->description}}
                            </td>
                            <td class="p-3 px-5">                                  
                                <td>
                                    <a href="/note/{{$note->id}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="/note/{{$note->id}}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>
