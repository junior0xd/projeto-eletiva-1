# Início
Este é o repositório do projeto referente a matéria Programação Web

# Próximos Passos
1. Adicionar Modal no Botão de Filtros ✅
2. Adicionar Modal para Novos Produtos ✅
3. Melhorar a Responsividade do Site 🚧
4. Adicionar Página de Perfil do Usuário ✅
5. Adicionar Página de Detalhes do Produto ✅
6. Página para gerenciamento de usuários ✅
7. Página para gerenciamento de categoria (HARDCODED) 🚧
8. Aumentar segurança do sistema verificando as permissões ✅
9. Adicionar página para inserir muitos produtos de uma vez ❌
10. Implementar cargos de usuário (admin, usuário comum, etc) ❌
11. Adicionar histórico para cada produto em estoque (quem criou, ultima atualizacao, etc.) ❌

# Problemas

### Problema: PDOException: Could not find Driver
1. Se você instalou o apache através do XAMPP, baixe as extensões do MySQL para o PHP.
```bash
    sudo apt update
    sudo apt install php-mysql
```
2. Verifique se a extensão está habilitada no arquivo `php.ini`.\

    Na minha máquina está instalado a versão 8.3 do PHP e estou utilizando o editor Xed.
```bash
    sudo xed /etc/php/8.3/apache2/php.ini
```
\
    Procure por `extension=pdo_mysql` e remova o ponto e vírgula (`;`) no início da linha, se houver.\
    Adicione a linha `extension=pdo` se não estiver presente.


3. Reinicie o servidor Apache.
```bash
    sudo systemctl restart apache2
```
4. Verifique se o problema foi resolvido acessando sua aplicação novamente.

### Instalar PhpMyAdmin 

1. Instale o PhpMyAdmin.
```bash
    sudo apt update
    sudo apt install phpmyadmin
```
2. Durante a instalação, selecione o servidor web (Apache2) e configure o banco se necessário.

3. Inclua o PhpMyAdmin na configuração do Apache.
```bash
    sudo echo 'Include /etc/phpmyadmin/apache.conf' >> /etc/apache2/apache2.conf
```
4. Reinicie o servidor Apache.
```bash
    sudo systemctl restart apache2
```


# Licença

MIT License

Copyright (c) 2025 Junior

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
