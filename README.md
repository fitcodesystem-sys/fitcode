# FitCode

## Resumo
O Brasil experimenta um fenômeno de acentuado crescimento no número de estabelecimentos voltados à prática de atividades físicas instalados pelo país. Este avanço é impulsionado, em grande parte, pela disseminação de conteúdos digitais por atletas, influenciadores e celebridades que promovem hábitos saudáveis e o consumo de suplementos alimentares. Apesar dessa expansão de mercado, pequenas academias e estúdios frequentemente enfrentam gargalos operacionais devido à ausência de ferramentas automatizadas de gestão. O uso de processos manuais ou planilhas descentralizadas limita a eficiência administrativa, prejudica a retenção de alunos e compromete o acompanhamento financeiro e operacional do negócio. 
Diante desta demanda, o presente projeto propõe o desenvolvimento de um Sistema de Gestão para Pequenas Academias (SGPA), oferecendo uma solução computacional acessível e integrada para otimizar os processos operacionais e administrativos desses estabelecimentos.


## 1. OBJETIVOS

### 1.1. Objetivo Geral 
Desenvolver uma aplicação web estruturada para o gerenciamento operacional de pequenas academias, abrangendo o cadastro de usuários, gestão de modalidades e controle de matrículas. 

### 1.2. Objetivos Específicos 
- Prover uma interface web intuitiva e responsiva para administradores e instrutores; 
- Automatizar a gestão de cadastros de alunos, instrutores e personal trainers; 
- Organizar a oferta de modalidades esportivas e aulas (musculação, calistenia, pilates, crossfit, etc.); 
- Gerenciar as matrículas e a vinculação de alunos às respectivas turmas/aulas; 
- Arquitetar a aplicação de forma modular para permitir expansões futuras (módulos financeiros, acesso móvel e integrações de hardware). 


## 2. Escopo

### 2.1. Escopo Mínimo Viável (MVP - Fase Inicial) 
- O produto entregável na primeira etapa contemplará uma interface web contendo as seguintes funcionalidades centrais: 
- Módulo de Gestão de Pessoas: Cadastro, edição, consulta e inativação de alunos, instrutores e personal trainers. 
- Módulo de Gestão de Aulas e Modalidades: Cadastro e gerenciamento de modalidades (Musculação, Calistenia, Pilates, Crossfit, entre outras) e horários das turmas. 
- Módulo de Matrículas: Associação entre alunos e modalidades/aulas, com controle de status da matrícula (ativa, trancada, cancelada). 

### 2.2. Escopo Futuro Planejado (Evoluções Previstas) 
Para manter a sustentabilidade e escalabilidade da arquitetura do software, o projeto prevê os seguintes módulos para fases subsequentes: 
#### Fase 2 (Segundo Momento): 
- Gestão de Estoque e Vendas: Cadastro e comercialização de produtos 
(suplementos, acessórios e bebidas); 
- Módulo Financeiro: Gestão de Contas a Pagar e Contas a Receber; 
- Módulo Analítico: Relatórios operacionais e dashboards com indicadores de desempenho (KPIs); 
- Prescrição de Treinos: Montagem e acompanhamento de planos de treinamento individualizados. 
#### Fase 3 (Longo Prazo / Próximos Semestres): 
- Aplicação Mobile: Acesso dedicado para alunos (pagamento de mensalidades via aplicativo e consulta interativa ao plano de treino); 
- Integração com Sistemas Externos: Módulo de faturamento automatizado 
(emissão de Nota Fiscal de Serviços Eletrônica - NFS-e); 
- Integração com Periféricos de Hardware: Comunicação com catracas de acesso, leitores biométricos e esteiras inteligentes. 

### 2.3. Fora do Escopo (Limitações Iniciais) 
Não fazem parte das entregas da versão inicial do projeto: 
Processamento nativo de pagamentos por cartão ou PIX dentro do sistema; 
Aplicativo nativo baixável em lojas (Android/iOS); 
Integração física com hardware de controle de acesso (catracas). 


## 3. Requisitos de sistema

### 3.1. Requisitos Funcionais
- RF01: O sistema deve permitir o cadastro de usuários com perfis diferenciados (Administrador, Instrutor, Aluno). 
- RF02: O sistema deve permitir a criação e parametrização de modalidades esportivas e suas respectivas capacidades máximas por turma. 
- RF03: O sistema deve realizar a matrícula de alunos em uma ou mais modalidades disponíveis. 
- RF04: O sistema deve emitir listagens de alunos matriculados por modalidade/horário.

### 3.2. Requisitos não funcionais
- RNF01 (Usabilidade): A interface web deve ser responsiva, permitindo acesso via navegadores desktop e dispositivos móveis. 
- RNF02 (Segurança): O acesso às funcionalidades do sistema deve ser protegido por autenticação (login e senha) com criptografia das credenciais. 
- RNF03 (Desempenho): As consultas do sistema devem retornar resultados em um tempo inferior a 2 segundos em condições normais de uso. 


## 4. METODOLOGIA
O desenvolvimento do projeto adotará metodologias ágeis (como Scrum ou Kanban) para o acompanhamento das entregas. A documentação e modelagem do sistema utilizarão notações padrão da Engenharia de Software (Diagrama de Casos de Uso, Diagrama de Entidade-Relacionamento e Diagrama de Classes da UML). 
