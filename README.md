# Impact Academy Platform — V1.0 (MVP)

## Visão geral
A **Impact Academy Platform** é uma plataforma web de desenvolvimento humano, liderança e alta performance.  
O objetivo do MVP é permitir que **administradores** publiquem e organizem conteúdos (programas, módulos e aulas) e que **alunos** consumam esse conteúdo com acompanhamento de progresso e um sistema simples de gamificação (pontuação e ranking).

---

## Perfis de acesso
- **Administrador**
  - Gerencia usuários, programas, módulos, aulas, biblioteca, eventos, ranking e certificados.
- **Mentor** (planejado/expandível)
  - Publica conteúdos, cria desafios e acompanha alunos.
- **Aluno**
  - Assiste aulas, acessa biblioteca, participa de desafios e acompanha progresso.

---

## Principais funcionalidades (V1)
### Área pública
- Página inicial institucional (hero, sobre, programas, benefícios, depoimentos, eventos e contato)
- Páginas: Sobre, Programas, Contato
- Login e Cadastro

### Área do aluno
- **Dashboard**: programas ativos, última aula, pontuação, nível/ranking, certificados (quando habilitado)
- **Meus Programas**: lista de programas disponíveis/matriculados
- **Programa → Módulos → Aulas**
- **Aula**: vídeo incorporado do YouTube, texto complementar, material em PDF e botão “concluir”
- **Ranking**: Top 10 alunos por pontuação

### Gamificação (Jogo Olímpico)
Pontuação sugerida:
- Concluir aula: +10  
- Concluir módulo: +50  
- Concluir programa: +200  
- Participar evento: +100  
- Enviar atividade: +25  

Níveis:
- Bronze, Prata, Ouro, Olímpico, Lendário

Conquistas (exemplos):
- Primeira Aula, Primeiro Programa, Primeiro Certificado, Primeiro Evento, Top Ranking

---

## Estrutura de conteúdo
- **Programa**
  - **Módulos**
    - **Aulas**
      - Exercícios / materiais complementares (PDF e links)

---

## Tecnologias
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript ES6
- **Backend**: PHP 8+, PDO, arquitetura MVC
- **Banco de Dados**: MySQL (phpMyAdmin)
- **Hospedagem (MVP)**: InfinityFree

---

## Banco de dados (resumo)
Entidades principais:
- usuários
- programas
- módulos
- aulas
- matrículas
- progresso (aulas concluídas)
- biblioteca (materiais em PDF)
- eventos
- pontuação/ranking e conquistas
- certificados

---

## Segurança (princípios aplicados)
- Senhas com `password_hash()` e verificação com `password_verify()`
- PDO com prepared statements (prevenção de SQL Injection)
- Sessões seguras e controle de permissões por perfil
- CSRF Token para formulários
- Logs de acesso e middleware de autenticação

---

## Objetivo do MVP
Entregar uma base sólida para:
1. Publicação e organização de programas, módulos e aulas
2. Experiência do aluno com progresso e engajamento
3. Administração centralizada de conteúdos e usuários

---

## Roadmap resumido
- **V1**: área do aluno + programas/módulos/aulas + biblioteca + gamificação  
- **V2**: certificados automáticos + comunidade  
- **V3/V4**: apps Android e iOS  
- **V5**: versão SaaS licenciável
