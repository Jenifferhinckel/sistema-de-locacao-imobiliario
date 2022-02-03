<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h3>Login</h3>
        <hr />
        <a href="index.php">Voltar</a>
        <h4>Login</h4>
        <form method="POST" action="user/cadastrar.php">
            <table>
                <tr>
                    <td colspan="2" align="right" >* campo(s) obrigatórios</td>
                </tr>
                <tr>
                    <td align="right">*Nome:</td>
                    <td><input type="text" name="nome" /></td>
                </tr>
                <tr>
                    <td align="right">*Senha:</td>
                    <td><input type="password" name="senha" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="submit" value="Cadastrar" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>