<div>
    <form id="create-user-form">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        @if (request()->path() != 'add')
            <div class="mb-3">
                <label for="situacao" class="form-label">Situação</label>
                <select class="form-control" id="situacao" name="situacao">
                    <option value="0">Em análise</option>
                    <option value="1">Aprovado</option>
                    <option value="2">Reprovado</option>
                </select>
            </div>
        @endif

        <button type="button" class="btn btn-success" id="btn-add-salvar">Salvar</button>
        <a href="/" class="btn btn-secondary">Voltar</a>
    </form>
</div>
