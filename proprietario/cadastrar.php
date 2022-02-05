<html>
    <head>
        <title>Cadastrar Proprietários
        </title>
    </head>
    <body>
        <h3>Cadastrar Proprietários
        </h3>
        <hr />
        <a href="../index.php">Sair</a>
        <h4>Cadastrar Proprietários
        </h4>
        <form method="POST" action="registrar.php">
            <table>
                <tr>
                    <td colspan="2" align="right" >* campo(s) obrigatórios</td>
                </tr>
                <tr>
                    <td align="right">*Nome:</td>
                    <td><input type="text" name="name" required/></td>
                </tr>
                <tr>
                    <td align="right">*E-mail:</td>
                    <td><input type="email" name="email" required/></td>
                </tr>
                <tr>
                    <td align="right">*Telefone:</td>
                    <td><input type="text" name="telephone" required/></td>
                </tr>
                <tr>
                    <td align="right">*Dia do Repasse:</td>
                    <td><input type="number" name="repasse_day" required/></td>
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