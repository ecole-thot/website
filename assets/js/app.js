/* jshint strict: true */
'use strict'

require('../css/app.scss')
require('semantic-ui-css/components/transition')
require('semantic-ui-css/components/dimmer')
require('semantic-ui-css/components/dropdown')
require('semantic-ui-css/components/popup')

$(document).ready(() => {
  $('.dropdown').dropdown()
  console.log('✅ Started website.')
})
