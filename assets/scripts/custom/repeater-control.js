jQuery(document).ready(() => {
  var context = this;
  var module = {
    $document  : $(document),
    $container : $('#repeater-form-container'),
    $collector : $('#repeater-control_collector'),
    $addBtn    : '.add-button',
    $rmvBtn    : '.remove-button',
    $form      : {
      values   : [],
      selector : $('.repeater-form'),
      generate : function() {
        var form = this.selector.clone().removeClass('d-none');
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
        var container = $(this).closest('.card-repeater');
        var idx = $('.card-repeater').index(container);
        var form = $(this).closest('.repeater-form');
        var data = {};

        $.each($(form).serializeArray(), function(_, field) {
          data[field.name] = field.value;
        });

        module.$form.values[idx] = data;
        module.$form.notifyDataSetChanged();
      },
      notifyDataSetChanged: function() {
        module.$collector.val(JSON.stringify(module.$form.values));
        module.$collector.trigger('change');
      },
      prefill: function() {
        module.$form.values.map((data, i) => {
          module.$container.append(module.$form.generate());

          var form = $('.card-repeater form.repeater-form').get(i);
          $.each($(form).serializeArray(), function(_, field) {
            console.log(`data: ${JSON.stringify(data)}, field: ${JSON.stringify(field)}`);
          });
        });
      }
    },
    onClickAdd : function(ev) {
      module.$container.append(module.$form.generate());
      module.$form.values.push({});
    },
    onClickRemove: function() {
      var container = $(this).closest('.card-repeater');
      var idx = $('.card-repeater').index(container);

      container.remove();
      module.$form.values.splice(idx, 1);
      module.$form.notifyDataSetChanged();
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
      if(module.$collector.val()) module.$form.values = JSON.parse(module.$collector.val());
    }
  }

  module.$document.on('click', module.$addBtn, module.onClickAdd);
  module.$document.on('click', module.$rmvBtn, module.onClickRemove);
  module.$document.on('change', '.form-control', module.$form.onInputUpdated )
  return module.init();
});
