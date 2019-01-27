'use strict'

const Quill = require('quill')

// Rich text editing
const container = document.getElementsByClassName('editor')[0]

if (container) {
  const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }], // custom button values
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [{ 'script': 'sub' }, { 'script': 'super' }], // superscript/subscript
    [{ 'indent': '-1' }, { 'indent': '+1' }], // outdent/indent
    [{ 'direction': 'rtl' }], // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }], // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }], // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean'] // remove formatting button
  ]

  const editor = new Quill(container, {
    theme: 'snow',
    modules: {
      toolbar: toolbarOptions
    }
  })

  document.querySelector('form').onsubmit = function () {
    // Populate hidden form on submit
    console.log('submit')
    let content = document.querySelector('textarea#news_item_content')
    content.value = editor.root.innerHTML
    return true
  }
}

$(document).ready(function () {
  console.log('[Editor] started.')
})
