<style>
    button.minimize,
    button.close {
        cursor: pointer;
        outline: 0 !important;
    }
</style>

<div class="repeater-wrapper">
    <div class="row">
        <input type="hidden" id="repeater-control_collector" name="{{ esc_attr($form->id) }}" value="{{ esc_attr($form->value()) }}" {{ $form->link() }} />
        <div class="d-none repeater-form">
          @include($form->view)
        </div>
        <div class="col" id="repeater-form-container">
          @if(count($data))
            @foreach($data as $item)
              <div class='card card-repeater p-0 m-0 rounded-0'>
                <div class='card-header pt-0 pb-1 pr-2 pl-2'>
                  <button type="button" class="minimize bg-transparent p-0 border-0 show" onclick='module.onClickToggle(this)'>+</button>
                  <button type="button" class="close remove-button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class='card-body collapse p-0'>
                  <div class="p-3">
                    @include($form->view, array( 'item' => $item ))
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button type="button" class="btn btn-primary btn-block add-button rounded-0">{{ $form->button_label }}</button>
        </div>
    </div>
</div>
