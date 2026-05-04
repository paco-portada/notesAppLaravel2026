<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Note') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
            
                <form method="POST" action="/note">
                
                    @csrf
                    <div class="form-group">
                        <textarea name="title" class="bg-gray-100 dark:text-white dark:bg-gray-800 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter the title'></textarea>  
                        @if ($errors->has('title'))
                            <span class="text-danger dark:text-white dark:bg-gray-500">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <textarea name="description" class="bg-gray-100 dark:text-white dark:bg-gray-800 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter the description'></textarea>  
                        @if ($errors->has('description'))
                            <span class="text-danger dark:text-white dark:bg-gray-500">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>