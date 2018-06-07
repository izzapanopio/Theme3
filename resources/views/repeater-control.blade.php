<style>
    button.minimize,
    button.close {
        cursor: pointer;
        outline: 0 !important;
    }
    .repeater-wrapper .repeater-form-title {
        padding: 13px 15px;
        font-size: 13px;
        font-weight: 500;
        margin: 0 !important;
    }
    .repeater-wrapper .card-header {
        cursor: pointer !important;
    }
    .repeater-wrapper a.card-link {
        box-shadow: none !important;
        outline: none !important;
    }
</style>

<div class="repeater-wrapper">
    <div class="row mb-3">
        <div class="col">
            <button type="button" class="button add-new-widget float-right add-button">
                <span>{{ $form->button_label }}</span>
            </button>
        </div>
    </div>
    <div class="row">
        <input type="hidden" class="repeater-control_collector" name="{{ esc_attr($form->id) }}" {{ $form->link() }} />
        <div class="d-none repeater-form">
            <div class='card card-repeater p-0 m-0 rounded-0'>
                <div class='card-header p-0'>
                    <h3 class="repeater-form-title" onclick='module.onClickToggle(this)'>{{ $form->title }}</h3>
                </div>
                <div class='card-body collapse show p-0'>
                    <div class="pt-3 pl-3 pr-3">
                        @include($form->view)
                    </div>
                    <div class="pb-3 pr-4 float-right">
                        <a href="#" class="card-link done-button text-success">
                            <i class="fa fa-check"></i>
                        </a>
                        <a href="#" class="card-link remove-button text-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" id="repeater-form-container">
            @if(isset($data) && count($data))
                @foreach($data as $item)
                    <div class='card card-repeater p-0 m-0 rounded-0'>
                        <div class='card-header p-0'>
                            <!-- <button type="button" class="minimize bg-transparent p-0 border-0 show" onclick='module.onClickToggle(this)'>+</button>
                            <button type="button" class="close remove-button" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                            <h3 class="repeater-form-title" onclick='module.onClickToggle(this)'>{{ $form->title }}</h3>
                        </div>
                        <div class='card-body collapse p-0'>
                            <div class="pt-3 pl-3 pr-3">
                                @include($form->view, array( 'item' => $item ))
                            </div>
                            <div class="pb-3 pr-4 float-right">
                                <a href="#" class="card-link done-button text-success">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="#" class="card-link remove-button text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
