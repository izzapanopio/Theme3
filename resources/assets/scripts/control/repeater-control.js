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
    $doneBtn   : '.done-button',
    $form      : {
      values   : [],
      selector : function(el) {
        return $(`#${module.getCurrentModule(el)} .repeater-form`);
      },
      generate : function(el) {
        var form = this.selector(el).clone().removeClass('d-none');
        return form.html();
      },
      onInputUpdated: function() {
        var current = module.$collector(this).attr('name');
        var container = $(this).closest('.card-repeater');
        var idx = $(`#${module.getCurrentModule(this)} #repeater-form-container .card-repeater`).index(container);
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
      var idx = $(`#${module.getCurrentModule(this)} #repeater-form-container .card-repeater`).index(container);
      var current = module.$collector(this).attr('name');

      container.remove();
      module.$form.values[current].splice(idx, 1);
      module.$form.notifyDataSetChanged(current);
    },
    onClickToggle: function(item) {
      var item = $(item);
      var body = item.parent().siblings();
      body.collapse('toggle');
    },
    onComplete: function() {
      var body = $(this).closest('.collapse');
      body.collapse('toggle');
    },
    init: function() {
      context.module = this;

      $(`.repeater-control_collector`).map((x, y) => {
        if(!$(y).val()) $(y).val('[]');
        module.$form.values[$(y).attr('name')] = JSON.parse($(y).attr('value'));
      });
    }
  }

  module.$document.on('click', module.$addBtn, module.onClickAdd);
  module.$document.on('click', module.$rmvBtn, module.onClickRemove);
  module.$document.on('click', module.$doneBtn, module.onComplete);
  module.$document.on('change', '.form-control', module.$form.onInputUpdated );
  return module.init();
});
