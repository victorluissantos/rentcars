# Usar a imagem oficial do Node.js
FROM node:18-alpine

# Criar e definir o diretório de trabalho
WORKDIR /app

# Copiar o package.json e o package-lock.json para o contêiner antes de montar o volume
COPY frontend/package*.json ./

# Instalar dependências
RUN npm install

# Copiar o restante dos arquivos do frontend para o contêiner
COPY frontend/ ./

# Expor a porta padrão do React (caso precise rodar um servidor depois)
EXPOSE 3000

# Comando para iniciar o servidor React
CMD ["npm", "start"]
