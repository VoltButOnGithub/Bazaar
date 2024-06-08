@props(['lease'])
 
<div class="border-b-4 h-72 flex items-center">
    <x-ads.card-small :ad="$lease->ad" />
    <div class="flex flex-col">
        <span class="font-bold">{{__('global.renting_out')}}</span>
        <span class="font-semibold">
        {{__('global.renting_between', 
        ['start' => $lease->start_date->format('d-m-Y'),
        'end' => $lease->end_date->format('d-m-Y')
        ])}} </span>
        <span>{{__('global.renting_to')}}</span>
        <x-users.card-medium :user="$lease->user" />
    </div>
</div>
