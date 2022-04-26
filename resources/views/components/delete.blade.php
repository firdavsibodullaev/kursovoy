<div class="modal fade" data-url="{{$url}}" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Удаление!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы действительно хотите удалить запись?</p>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button"
                        onclick="document.querySelector('#delete-form').submit()"
                        class="btn btn-danger btn-flat">Удалить
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<form action="" id="delete-form" method="post">
    @csrf
    @method('delete')
</form>
