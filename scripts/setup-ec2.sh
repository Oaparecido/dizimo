#!/bin/bash
# =============================================
# Setup inicial da instância EC2
# Execute UMA VEZ ao criar a instância
# =============================================
set -e

echo "==> Atualizando sistema..."
sudo apt update && sudo apt upgrade -y

echo "==> Instalando Docker..."
curl -fsSL https://get.docker.com | sh
sudo usermod -aG docker "$USER"
newgrp docker <<EOF
echo "Docker installed. User added to docker group."
EOF

echo "==> Criando diretório da aplicação..."
mkdir -p ~/app
cd ~/app

echo "==> Baixando docker-compose.prod.yml..."
curl -O https://raw.githubusercontent.com/SEU_USUARIO/dizimo/main/docker-compose.prod.yml

echo "==> Criando arquivo .env..."
cat > .env << 'ENVEOF'
# Preencha com os valores reais
APP_KEY=
APP_URL=https://seudominio.com
DB_URL=postgresql://usuario:senha@host:5432/dizimo
ENVEOF

echo ""
echo "============================================"
echo "Setup concluido!"
echo ""
echo "Proximos passos:"
echo "  1. Edite ~/app/.env com os valores reais"
echo "  2. Configure as secrets no GitHub:"
echo "     - EC2_HOST (IP ou DNS da instancia)"
echo "     - EC2_USER (ubuntu)"
echo "     - EC2_SSH_KEY (chave privada)"
echo "     - APP_KEY (php artisan key:generate --show)"
echo "     - APP_URL"
echo "     - DB_URL"
echo "  3. Faca push na main para testar o deploy"
echo "============================================"
