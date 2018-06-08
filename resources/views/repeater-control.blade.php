<div class="repeater-wrapper">
    <div class="row mb-3">
        @if(isset($form->options->type) && $form->options->type != 'fixed')
        <div class="col">
            <button type="button" class="button add-new-widget float-right add-button">
                <span>{{ $form->options->button_label }}</span>
            </button>
        </div>
        @endif
    </div>
    <div class="row">
        <input type="hidden" class="repeater-control_collector" name="{{ esc_attr($form->id) }}" {{ $form->link() }} />
        <div class="d-none repeater-form">
            <div class='card card-repeater p-0 m-0 rounded-0'>
                <div class='card-header p-0'>
                    <h3 class="repeater-form-title" onclick='module.onClickToggle(this)'>{{ $form->options->title }}</h3>
                </div>
                <div class='card-body collapse show p-0'>
                    <div class="pt-3 pl-3 pr-3">
                        @include($form->options->form)
                    </div>
                    <div class="pb-3 pr-4 float-right">
                        <a href="#" class="card-link done-button text-success">
                            <i class="fa fa-check"></i>
                        </a>
                        @if(isset($form->options->type) && $form->options->type != 'fixed')
                        <a href="#" class="card-link remove-button text-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col" id="repeater-form-container">
            @if(isset($data) && count($data))
                @foreach($data as $item)
                    <div class='card card-repeater p-0 m-0 rounded-0'>
                        <div class='card-header p-0'>
                            <h3 class="repeater-form-title" onclick='module.onClickToggle(this)'>{{ $form->options->title }}</h3>
                        </div>
                        <div class='card-body collapse p-0'>
                            <div class="pt-3 pl-3 pr-3">
                                @include($form->options->form, array( 'item' => $item ))
                            </div>
                            <div class="pb-3 pr-4 float-right">
                                <a href="#" class="card-link done-button text-success">
                                    <i class="fa fa-check"></i>
                                </a>
                                @if(isset($form->options->type) && $form->options->type != 'fixed')
                                <a href="#" class="card-link remove-button text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
