"use  strict";

// Modal-start //

$(document).ready(function() {
  var materialButton = $('.new-order__material-button');
  var packagingButton = $('.new-order__packaging-button');
  var materialModal = $('.modal--material');
  var packagingModal = $('.modal--packaging');
  var modalOverlay = $('.modal__overlay');
  var modalMaterialButton= $('.modal__button--material');
  var modalPackagingButton= $('.modal__button--packaging');
  var materialCheckbox = materialModal.find('input');

  materialButton.click(function(evt) {
    materialModal.addClass('modal--active');
    modalOverlay.addClass('modal__overlay--active');
  });

  packagingButton.click(function(evt) {
    packagingModal.addClass('modal--active');
    modalOverlay.addClass('modal__overlay--active');
  });

  modalOverlay.click(function(evt) {
    $('.modal').removeClass('modal--active');
    modalOverlay.removeClass('modal__overlay--active');
  });

  // Modal-end //

  // Tags-start //

  modalMaterialButton.click(function() {
    var block = $('<div />');
    var content = $('<p />');
    var close = $('<button />');
    content.text('hello');
    content.addClass('new-order__tag-text');
    close.addClass('new-order__tag-close');
    block.addClass('new-order__tag');
    block.append(content);
    block.append(close);

    block.insertBefore(materialButton);
    $('.modal').removeClass('modal--active');
    modalOverlay.removeClass('modal__overlay--active');
  });

  modalPackagingButton.click(function() {
    var block = $('<div />');
    var content = $('<p />');
    var close = $('<button />');
    content.text('hello');
    content.addClass('new-order__tag-text');
    close.addClass('new-order__tag-close');
    block.addClass('new-order__tag');
    block.append(content);
    block.append(close);

    block.insertBefore(packagingButton);
    $('.modal').removeClass('modal--active');
    modalOverlay.removeClass('modal__overlay--active');
  });

  // Tags-end //
});
