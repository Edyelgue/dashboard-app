<!-- You can open the modal using ID.showModal() method -->
<button class="btn" onclick="my_modal_4.showModal()">open modal</button>
<dialog id="my_modal_4" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">{{ $titleModal  }}</h3>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn btn-info">Aplicar</button>
                <button class="btn btn-error">Cancelar</button>
            </form>
        </div>
    </div>
</dialog>