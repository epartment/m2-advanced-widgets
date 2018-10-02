define([
  'underscore',
  'uiRegistry',
  'Magento_Ui/js/form/element/select'
], function (_, uiRegistry, select) {
  'use strict';

  return select.extend({

    /** @inheritdoc */
    initialize: function () {
      this._super();

      this.toggleWidgetFieldset();

      return this;
    },

    onUpdate: function () {
      this.toggleWidgetFieldset();
    },

    toggleWidgetFieldset: function () {
      Array.prototype.forEach.call(
      uiRegistry.get('epartment_widget_form.epartment_widget_form').elems(),
      function (element) {
        if (
        element.name != 'epartment_widget_form.epartment_widget_form.id' &&
        element.name != 'epartment_widget_form.epartment_widget_form.general' &&
        element.componentType == 'fieldset'
        ) {
          element.visible(false);
        }
      }
      );
      uiRegistry.get('epartment_widget_form.epartment_widget_form.' + this.value()).visible(true);
    }

  });
});
