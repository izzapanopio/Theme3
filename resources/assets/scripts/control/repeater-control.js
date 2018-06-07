jQuery(document).ready(() => {
  var context = this;
  var module = {
    $document  : $(document),
    $container : function(el) {
      return $(`#${this.getCurrentModule(el)} #repeater-form-container`);
    },
    $collector : function(el) {
      return $(`#${this.getCurrentModule(el)} .repeater-control_collector`);
    },
    $addBtn    : '.add-button',
    $rmvBtn    : '.remove-button',
    $form      : {
      values   : [],
      selector : function(el) {
        return $(`#${module.getCurrentModule(el)} .repeater-form`);
      },
      generate : function(el) {
        var form = this.selector(el).clone().removeClass('d-none');
        return `<div class='card card-repeater p-0 m-0 rounded-0'>
                  <div class='card-header pt-0 pb-1 pr-2 pl-2'>
                    <button type="button" class="minimize bg-transparent p-0 border-0 show" onclick='module.onClickToggle(this)'>–</button>
                    <button type="button" class="close remove-button" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class='card-body collapse p-0 show'>
                    <div class="p-3">${ form.html() }</div>
                  </div>
                </div>`;
      },
      onInputUpdated: function() {
        var current = module.$collector(this).attr('name');

        var container = $(this).closest('.card-repeater');
        var idx = $(`#${module.getCurrentModule(this)} .card-repeater`).index(container);
        var form = $(this).closest('.repeater-form');
        var data = {};

        $.each($(form).serializeArray(), function(_, field) {
          data[field.name] = field.value;
        });

        module.$form.values[current][idx] = data;
        module.$form.notifyDataSetChanged(current);
      },
      notifyDataSetChanged: function(current) {
        $(`input[name='${current}']`).val(JSON.stringify(module.$form.values[current]));
        $(`input[name='${current}']`).trigger('change');
      }
    },
    getCurrentModule: function(el) {
      return $(el).closest('.customize-control-repeater').attr('id');
    },
    onClickAdd: function(ev) {
      var current = module.$collector(this).attr('name');

      module.$container(this).append(module.$form.generate(this));
      module.$form.values[current].push({});
      module.$form.notifyDataSetChanged(current);
    },
    onClickRemove: function() {
      var container = $(this).closest(`.card-repeater`);
      var idx = $(`#${module.getCurrentModule(this)} .card-repeater`).index(container);
      var current = module.$collector(this).attr('name');

      container.remove();
      module.$form.values[current].splice(idx, 1);
      module.$form.notifyDataSetChanged(current);
    },
    onClickToggle: function(item) {
      var item = $(item);
      var body = item.parent().siblings();
      body.collapse('toggle');

      if(item.hasClass('show')) {
        item.removeClass('show');
        item.html('+');
      } else {
        item.addClass('show');
        item.html('–');
      }
    },
    init: function() {
      context.module = this;

      $(`.repeater-control_collector`).map((x, y) => {
        if(!$(y).val()) $(y).val('[]');
        module.$form.values[$(y).attr('name')] = JSON.parse($(y).attr('value'));
      });

      console.log(module.$form.values);
    }
  }

  module.$document.on('click', module.$addBtn, module.onClickAdd);
  module.$document.on('click', module.$rmvBtn, module.onClickRemove);
  module.$document.on('change', '.form-control', module.$form.onInputUpdated )
  return module.init();
});
