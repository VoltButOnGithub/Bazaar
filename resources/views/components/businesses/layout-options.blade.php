@props(['col', 'ads', 'layout'])

<div class="mb-4">
    <x-businesses.layout-option-radio col="{{$col}}" section='0' :ads='$ads' :value="$layout[0]"/>
    <x-businesses.layout-option-radio col="{{$col}}" section='1' :ads='$ads' :value="$layout[1]"/>
    <x-businesses.layout-option-radio col="{{$col}}" section='2' :ads='$ads' :value="$layout[2]"/>
</div>
