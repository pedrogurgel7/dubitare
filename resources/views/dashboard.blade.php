<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>


    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"/>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">




        <div class="dark:text-gray-400 uppercase ">
            Lista de questões
        </div>



        <div class="dark:text-gray-400 space-y-4">
                @foreach ($questions as $q)

                    <x-question :question="$q"/>

                @endforeach             
        </div>
    </x-conteiner>

            
           

 
</x-app-layout>
