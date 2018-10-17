"use  strict";

$(document).ready(function() {
  var materialButton = $('.new-order__material-button');
  var packagingButton = $('.new-order__packaging-button');
  var materialModal = $('.modal--material');
  var packagingModal = $('.modal--packaging');
  var modalOverlay = $('.modal__overlay');

  materialButton.click(function(evt) {
    materialModal.addClass('modal--active');
    modalOverlay.addClass('modal__overlay--active');
  });

  packagingButton.click(function(evt) {
    packagingModal.addClass('modal--active');
    modalOverlay.addClass('modal__overlay--active');
  });

  $('.modal__overlay').click(function(evt) {
    $('.modal').removeClass('modal--active');
    $('.modal__overlay').removeClass('modal__overlay--active');
  });
});
