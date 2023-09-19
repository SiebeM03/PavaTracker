@props(['member'])

@if($member->town_hall == null)
    <div class="flex justify-center">
        <x-phosphor-question-light class="h-8 text-card-title-border"/>
    </div>
@elseif(isset($member->getTownHallLevel()[1]))
    <div class="th flex justify-center">
        <img src="{{ asset('/storage/th_icons/th' . $member->getTownHallLevel()[0] . '.png') }}"
                class="h-12"
                alt="Town Hall {{ $member->getTownHallLevel()[0] }}"
                data-tippy-content="<div class='flex'> {{ str_repeat('<svg class="h-4 w-4 text-yellow-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
  <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd"/>
</svg>', $member->getTownHallLevel()[1]) }} </div>"
        />
    </div>
@else
    <div class="flex justify-center">
        <img src="{{ asset('/storage/th_icons/th' . $member->getTownHallLevel()[0] . '.png') }}"
                class="h-12"
                alt="Town Hall {{ $member->getTownHallLevel()[0] }}"/>
    </div>
@endif