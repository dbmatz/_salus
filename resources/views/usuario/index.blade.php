<div>
    <form id="formCadastrar" method="post" enctype="multipart/form-data" action="{{route('usuario-store')}}">
        @csrf
            <label for="cNome">Nome</label><br />
            <input id="cNome" name="nome" required=""/><br />
    
            <label for="cDataNasc">Data de Nascimento</label><br />
            <input type="date" id="cDataNasc" name="data_nascimento" required=""/><br />
    
            <label for="cEmail">E-Mail</label><br />
            <input type="email" id="cEmail" name="email" required=""/><br />
    
            <label for="cFoto">Foto (somente .jpg - máximo de 200Kb)</label><br />
            <input id="cFoto" name="foto" type="file" accept="image/jpeg" /><br />
    
            <button type="submit" class="btPadrao">Salvar</button>
        </form>
</div>