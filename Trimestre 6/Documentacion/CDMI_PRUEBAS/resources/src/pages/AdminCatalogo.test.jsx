import React from 'react';
import { render, screen, waitFor, fireEvent } from '@testing-library/react';
import { MemoryRouter } from 'react-router-dom';
import AdminCatalogo from './AdminCatalogo';
import axios from 'axios';
import { TextEncoder, TextDecoder } from 'util';

global.TextEncoder = TextEncoder;
global.TextDecoder = TextDecoder;

// Mock de useNavigate
const mockNavigate = jest.fn();
jest.mock('react-router-dom', () => ({
  ...jest.requireActual('react-router-dom'),
  useNavigate: () => mockNavigate,
}));

// Mock de axios
jest.mock('axios');

// Mock de localStorage
beforeEach(() => {
  localStorage.setItem('auth-token', 'fake-token');
  localStorage.setItem('rol', 'administrador');
  jest.clearAllMocks();
});

test('debe renderizar correctamente los productos desde la API', async () => {
  const inventariosMock = [
    {
      id: 1,
      nombre: 'Artesanía 1',
      descripcion: 'Hecha a mano',
      precio: 50000,
      imagen: 'artesania1.jpg',
    },
  ];

  axios.get.mockResolvedValueOnce({ data: inventariosMock });

  render(
    <MemoryRouter>
      <AdminCatalogo />
    </MemoryRouter>
  );

  expect(screen.getByText(/cargando productos/i)).toBeInTheDocument();

  await waitFor(() => {
    expect(screen.getByText(/artesanía 1/i)).toBeInTheDocument();
    expect(screen.getByText(/hecha a mano/i)).toBeInTheDocument();
    expect(screen.getByText(/\$50000/i)).toBeInTheDocument();
  });
});

test('redirige al login si no hay token o el rol no es administrador', () => {
  localStorage.removeItem('auth-token');
  localStorage.setItem('rol', 'usuario');

  render(
    <MemoryRouter>
      <AdminCatalogo />
    </MemoryRouter>
  );

  expect(mockNavigate).toHaveBeenCalledWith('/login');
});