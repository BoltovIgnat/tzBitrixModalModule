<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

<div class="ibc-container">
    <button type="button" class="btn btn-success ibc-btn-modal" disabled>Success</button>
    <div class="ibc-modal-backdrop"></div>
</div>


<div class="modal ibc-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ваш трек значение из BarCodee</h5>
                <button type="button" class="btn-close ibc-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ibc-modal-body">
                <div class="input-group mb-3 ibc-barcode-input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control ibc-barcode-input" placeholder="Barcode" aria-label="Barcode" aria-describedby="basic-addon1">
                </div>
                <span class="ibc-result-msg"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary ibc-btn-close" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary ibc-btn-submit">Отправить</button>
            </div>
        </div>
    </div>
</div>

