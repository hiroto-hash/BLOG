var modalTrigger = document.querySelectorAll('[data-modal]');
  if (modalTrigger.length > 0) {
    for (let i = 0; i < modalTrigger.length; i++) {
      var el = modalTrigger[i];
      contole.log(el);
      //イベントをバインド
      _addModalEvent(el);
    }
  }

  function _addModalEvent(el) {
    el.addEventListener('click', function(event) {
      event.preventDefault();
      // data-modalに指定したIDの要素を取得
      var target = el.getAttribute('data-modal');
      // モーダルのコンテンツを取得
      var modalContent = document.querySelector(target);
      if (modalContent) {
        // コンテンツをセット
        modal.setContent(modalContent.innerHTML);
        // モーダルオープン
        modal.open();
      }
    })
  }