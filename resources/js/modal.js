var modalwrap = null;
   const showModal = () => {
   // Do not create multiple modal
     if(modalwrap !== null){
          modalwrap.remove();
     }

    modalwrap = document.createElement ('div');
    modalwrap.innerHTML = 
    }