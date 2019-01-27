/* jshint strict: true */
'use strict'

require('semantic-ui-css/components/transition')
require('semantic-ui-css/components/dimmer')
require('semantic-ui-css/components/dropdown')
require('semantic-ui-css/components/popup')
require('./admin/editor.js')

$(document).ready(() => {
  $('.dropdown').dropdown()

  $('.inscriptions-save').click(function (e) {
    e.preventDefault()
    let url = $(this).data('url')
    let data = {
      inscription_next_date: $('#next_date').val(),
      inscription_limit_date: $('#limit_date').val(),
      inscription_link_fr: $('#francais').val(),
      inscription_link_en: $('#anglais').val(),
      inscription_link_fa: $('#farsi').val(),
      inscription_link_ps: $('#pashto').val(),
      inscription_link_ar: $('#arabe').val()
    }
    $.post(url, data, (r) => { location.reload() })
  })

  $('.figures-save').click(function (e) {
    e.preventDefault()
    let url = $(this).data('url')
    let data = {
      nb_students: $('#nb_students').val(),
      percent_diplomas: $('#percent_diplomas').val()
    }
    $.post(url, data, (r) => { location.reload() })
  })

  console.log('✅ Started website.')
})
