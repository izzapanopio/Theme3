<span class="customize-control-title">{{ esc_attr($form->label) }}</span>

@if(isset($form->description))
    <span id="_customize-description-{{ esc_attr($form->id) }}" class="description customize-description">
        {{ esc_attr($form->description) }}
    </span>
@endif

<span class="customize-inside-control-row radio-image-lockup">
    @foreach($form->choices as $item)
        <label for="_customize-input-{{ esc_attr($form->id . '-radio-' . $item->value) }}" {{ $item->value === get_theme_mod($form->id . '_settings')?"class='active'":'' }}>
            <input type="radio" id="_customize-input-{{ esc_attr($form->id . '-radio-' . $item->value) }}" name="{{ esc_attr($form->id) }}" value="{{ $item->value }}" data-customize-setting-link="{{ esc_attr($form->id . '_settings') }}">
            <img src="{{ esc_attr($item->img) }}" alt="{{ $item->label || '' }}">
        </label>
    @endforeach
</span>
