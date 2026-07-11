# Dizimo API

API para gestão de dizimistas, escalas de colaboradores e registro de pagamentos de dízimos.

## Stack

- **Laravel 13** + PHP 8.4
- **PostgreSQL** 17
- **Sanctum** (token Bearer para autenticação)
- **Docker** + Docker Compose

## Modelagem

| Modelo      | Tabela        | Descrição                                             |
| ----------- | ------------- | ----------------------------------------------------- |
| `Agent`     | `agents`      | Colaboradores que fazem login e administram o sistema |
| `Tither`    | `tithers`     | Dizimistas (membros da igreja)                        |
| `Community` | `communities` | Comunidades onde as escalas acontecem                 |
| `Rotation`  | `rotations`   | Escala fixa mensal de cada agente                     |
| `Payment`   | `payments`    | Registro de pagamentos dos dizimistas                 |

### Regras de negócio

- **Agent** é o usuário autenticado. Todo agent tem `is_admin` para acesso a rotas administrativas.
- **Tither** representa o dizimista. Não tem autenticação — é apenas um registro.
- **Rotation** define uma escala recorrente mensal usando `day_of_week` (0=Dom), `week_occurrence` (1-5) e `time` (HH:MM). Exemplo: `day_of_week=0, week_occurrence=3, time="19:00"` = 3º domingo do mês às 19h. Cada rotation está vinculada a um agent + community.
- **Payment** registra cada mês de referência em uma linha separada. Se um dizimista paga 3 meses de uma vez, são criadas 3 linhas com o mesmo `payment_date`. O `payment_time` é opcional e vem da escala do agent que recebeu o pagamento. Se não houver escala (evento especial), o campo fica nulo.

## Setup com Docker

```bash
# Subir os serviços
docker compose up -d

# A API estará disponível em http://localhost:8000

# Logs
docker compose logs -f app

# Executar comandos no container
docker compose exec app php artisan route:list
docker compose exec app php artisan tinker

# Acessar o banco
docker compose exec db psql -U dizimo -d dizimo

# Parar e destruir volumes (zera o banco)
docker compose down -v && docker compose up -d
```

Na primeira execução o `start.sh` automaticamente:

1. Aguarda o PostgreSQL ficar pronto
2. Gera a `APP_KEY`
3. Executa as migrations
4. Popula o banco com o agent admin
