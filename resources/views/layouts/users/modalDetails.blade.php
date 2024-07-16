<div class="modal fade" id="modalDetails" tabindex="-1" aria-labelledby="modalDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailLabel">Detalhes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row" id="infoDetails">
                        <div class="col">
                            <p>
                                <span><strong>Nome:</strong></span> <span id="detName"></span>
                            </p>
                            <p>
                                <span><strong>E-mail:</strong></span> <span id="detEmail"></span>
                            </p>
                            <p>
                                <span><strong>Situação:</strong></span> <span id="detSituacao"></span>
                            </p>
                            <p>
                                <span><strong>Data de admissão</strong></span> <span id="detDtAdmission"></span>
                            </p>
                        </div>
                    </div>
                    <div class="row" id="divDetLoading">
                        <div class="col" style="text-align: center;">
                            <div class="spinner-border text-primary" role="status" >
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
