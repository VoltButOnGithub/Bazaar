@extends('layouts.app')

@section('title', __('global.contracts'))

@section('content')
    <div class="flex w-full flex-col rounded-lg bg-white p-6 shadow-md">
        <form method="POST" action="{{ route('contract.store') }}">
        @csrf
            <x-forms.text-input id="title" for="title" :label="__('global.contract_title')" />
            <x-forms.textarea-input id="text" for="text" :label="__('global.contract_text')" />
            <x-forms.submit-button id="submitButton" :text="__('global.create_contract')" />
        </form>
    </div>
@endsection
