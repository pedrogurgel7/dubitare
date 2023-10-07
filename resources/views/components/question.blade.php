@props([
    'question'
])


<div class="dark:text-gray-200 uppercase shadow shadow-blue-400 rounded p-3 flex justify-between items-center">
    <span>{{$question->question}}</span>
    <div>
        <x-form :action="route('question.like', $question)"  >
            <button class="flex items-start space-x-2 ">
                <x-icon.thumbs-up class="h-5 w-5 text-green-700 hover:text-green-500 cursor-pointer"/>
                <span>{{$question->votes_sum_like}}</span>

            </button>
        </x-form>

        <x-form :action="route('question.unlike', $question)"  >
            <button class="flex items-start space-x-2 ">
                <x-icon.thumbs-down class="h-5 w-5 text-red-700 hover:text-red-500 cursor-pointer"/>
                <span>{{$question->votes_sum_unlike}}</span>

            </button>
        </x-form>
        
        {{--<x-icon.thumbs-down class="h-5 w-5 text-red-700 hover:text-red-500 cursor-pointer"/>
--}}
    </div>
</div>