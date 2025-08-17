<div class="form-group" style="margin-bottom: 15px;">
    <label for="{{ @$id }}">{{ @$label }}</label>

    <select id="{{ @$id }}" class="select form-control" name="{{ @$name }}" placeholder="{{ @$placeholder }}" @if(@$multiple) multiple @endif   autocomplete="off" @if(@$model) wire:model="{{ @$model }}" @endif>
        
        {{ $options }}
      
    </select>
</div> 