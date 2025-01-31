import React, { useEffect, useState } from 'react';

const VehicleList = () => {
  const [veiculos, setVeiculos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState('');
  const [locadoraFiltro, setLocadoraFiltro] = useState('');
  const [categoriaFiltro, setCategoriaFiltro] = useState('');
  const [ordenacao, setOrdenacao] = useState('nome-asc');

  useEffect(() => {
    fetch('http://localhost:8000/api/pesquisa')
      .then(response => response.json())
      .then(data => {
        setVeiculos(data.veiculos);
        setLoading(false);
      })
      .catch(error => {
        console.error('Erro ao carregar os veículos:', error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div>Carregando...</div>;
  }

  // Obter lista única de locadoras e categorias para os filtros
  const locadorasUnicas = [...new Set(veiculos.map(v => v.locadora.nome))];
  const categoriasUnicas = [...new Set(veiculos.map(v => v.categoria))];

  // Função para formatar o preço em moeda
  const formatarPreco = (preco) => {
    return new Intl.NumberFormat('pt-BR', {
      style: 'currency',
      currency: 'BRL',
    }).format(preco);
  };

  // Aplicar filtros
  const veiculosFiltrados = veiculos
    .filter(v => v.nome.toLowerCase().includes(search.toLowerCase()))
    .filter(v => (locadoraFiltro ? v.locadora.nome === locadoraFiltro : true))
    .filter(v => (categoriaFiltro ? v.categoria === categoriaFiltro : true))
    .sort((a, b) => {
      if (ordenacao === 'nome-asc') return a.nome.localeCompare(b.nome);
      if (ordenacao === 'nome-desc') return b.nome.localeCompare(a.nome);
      if (ordenacao === 'preco-asc') return a.preco - b.preco;
      if (ordenacao === 'preco-desc') return b.preco - a.preco;
      return 0;
    });

  return (
    <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif' }}>
      <h1>Lista de Veículos</h1>

      {/* Filtros */}
      <div style={{ marginBottom: '20px' }}>
        <input
          type="text"
          placeholder="Pesquisar veículo..."
          value={search}
          onChange={e => setSearch(e.target.value)}
          style={{ padding: '8px', marginRight: '10px' }}
        />

        <select value={locadoraFiltro} onChange={e => setLocadoraFiltro(e.target.value)} style={{ padding: '8px', marginRight: '10px' }}>
          <option value="">Todas as Locadoras</option>
          {locadorasUnicas.map(loc => (
            <option key={loc} value={loc}>{loc}</option>
          ))}
        </select>

        <select value={categoriaFiltro} onChange={e => setCategoriaFiltro(e.target.value)} style={{ padding: '8px', marginRight: '10px' }}>
          <option value="">Todas as Categorias</option>
          {categoriasUnicas.map(cat => (
            <option key={cat} value={cat}>{cat}</option>
          ))}
        </select>

        <select value={ordenacao} onChange={e => setOrdenacao(e.target.value)} style={{ padding: '8px' }}>
          <option value="nome-asc">Nome (A-Z)</option>
          <option value="nome-desc">Nome (Z-A)</option>
          <option value="preco-asc">Preço (Menor → Maior)</option>
          <option value="preco-desc">Preço (Maior → Menor)</option>
        </select>
      </div>

      {/* Listagem de Veículos */}
      <div style={{
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fill, minmax(250px, 1fr))', // Definir a quantidade de colunas
        gap: '20px', // Espaço entre as caixas
      }}>
        {veiculosFiltrados.length > 0 ? (
          veiculosFiltrados.map((veiculo, index) => (
            <div key={`${veiculo.id}-${index}`} style={{
              border: '1px solid #ddd',
              padding: '15px',
              borderRadius: '8px',
              boxShadow: '2px 2px 10px rgba(0,0,0,0.1)',
              background: '#fff',
            }}>
              <h3>{veiculo.nome}</h3>
              <p>Categoria: {veiculo.categoria}</p>
              <p>Locadora: {veiculo.locadora.nome}</p>
              <p>Preço: {formatarPreco(veiculo.preco)}</p> {/* Usando a função formatarPreco */}
            </div>
          ))
        ) : (
          <p>Nenhum veículo encontrado.</p>
        )}
      </div>
    </div>
  );
};

export default VehicleList;
