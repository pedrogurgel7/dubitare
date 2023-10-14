<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My questions') }}
        </x-header>
    </x-slot>


    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"/>
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">


        

        <div class="dark:text-gray-400 uppercase font-bold mb-4">Drafts</div>

        <div class="dark:text-gray-400 space-y-6">
            <x-table>
                <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                </x-table.thead>

                <tbody>
                    @foreach ($questions->where('draft', true) as $question)
                        <x-table.tr>
                            <x-table.td>{{$question->question}}</x-table.td>
                            <x-table.td>
                                
                                <x-form :action="route('question.publish', $question)" put>
                                    <x-btn.primary>Publish</x-btn.primary>
                                </x-form>

                                <x-form :action="route('question.destroy', $question)" delete>
                                    <x-btn.primary>Delete</x-btn.primary>
                                </x-form>

                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>        
        </div>



        <div class="dark:text-gray-400 uppercase font-bold mb-4">My Questions</div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                </x-table.thead>

                <tbody>
                    @foreach ($questions->where('draft', false) as $question)
                        <x-table.tr>
                            <x-table.td>{{$question->question}}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.destroy', $question)" delete>
                                    <x-btn.primary>Delete</x-btn.primary>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>        
        </div>
    </x-conteiner>

            
           

 
</x-app-layout>
